<?php
if( !$_POST['submit'])
{
?>
<form name="forgot" method="post" action="<?= $_SERVER['PHP_SELF']?>">
<h1>Forgot Your Password?</h1>
<p>Type in your email address and we will send you your password</p>
<input name="login" type="text" value="" size="30"/> <br/><br/>

<input type="submit" name="submit" value="submit"/>

<input type="reset" name="reset" value="reset"/> </form>

<?php

}
else
{
	
	
	//Include database connection details
	require_once('config.php');
	
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['login']);
	
	//Input Validations
	if($login == '') {
		echo 'You need to type in a valid email address';
		exit();
	}
	
	
	//Create query
	$qry="SELECT * FROM w_members WHERE login='$login'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			
	 $row=mysql_fetch_row($result);	

     $password=$row[4];

     $email= $row[3];
	 
	 
	 // To send HTML mail, the Content-type header must be set

    $headers = 'From: info@wildsidesa.co.za' . "\r\n" .
               'Reply-To: webmaster@wildsidesa.co.za' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
	 $headers = "MIME-Version: 1.0\n" ;
     $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
	 
	 
	 $subject="Wildside Magazine Online - your password";

	 $message = '
<html>
<head>
  <title>Wildside Online Mag Reminder</title>
</head>
<body>
<p></p>
  <p>Your Wildside Magazine Online password is <strong>'. $password . '</strong></p>
  <p><a href="http://www.wildsidesa.co.za/ipad/login/login-form.php"> Wildside Mage Online </a></p>

</body>
</html>
';


mail( $email,  $subject, $message, $headers);

echo "You have been sent an email with information to assist you to logon. <br/><br/>";	 

echo $email;	
	
	 exit();
	 
		}else {
			
			//Login failed
			echo "Sorry - You don't seem to have your email on file. <br/><br/>";
			
			echo "Why don\'t you sign-up now";
			
			exit();
		}
	}else {
		die("Query failed");
	}
}
?>