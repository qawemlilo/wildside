<?php
define('INCLUDE_CHECK',true);

require '../connect.php';

?>
<?php 
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
?>

<link href="http://www.wildsidesa.co.za/content/email/contact.css" rel="stylesheet" type="text/css" />	
<div class="containerdb" style="border:none;">

<?php

include("ch19_include.php");

if (!$_POST) {
	//haven't seen the form, so display it
	echo "<html>
	<head>
	<title>Send a Newsletter</title>
	</head>
	<body>
	<h1>The Panda Campaign - A petition against the poaching of Africa's Rhino</h1>
	
	
	<form id='contactus' method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
	<legend>Support the War against the poaching of Africa's Rhino</legend>
	<fieldset>
	<p><strong>Subject:</strong><br/>
	<input type=\"hidden\" name=\"subject\" value='A petition against the poaching of Africa's Rhino' size=\"40\"></p>
	<p><strong>From:</strong><br/>
	<input type=\"text\" name=\"from\" size=\"40\"></p>";

	// Select Category 
$query = "SELECT category, id FROM w_email_list GROUP BY category ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

{
	$cat=$row["category"]; 
    $options.="<OPTION VALUE=\"$cat\">".$cat. '</option>';
}
	
echo "	
<p><select name=\"category\">      
<?=$options?>                 
</select></p>
		
	<p><strong>Mail Body Link:</strong><br/>
	<textarea name=\"link\" cols=\"100\"></textarea>
	<p><input type=\"submit\" name=\"submit\" value=\"Send It\"></p>
	</fieldset>
	</form>
	</body>
	</html>";
	

} else if ($_POST) {
	//want to send form, so check for required fields
	if (($_POST["subject"] == "") || ($_POST["link"] == "")) {
		header("Location: sendmymail.php");
		exit;
	}

	//connect to database
	doDB();

	if (mysqli_connect_errno()) {
		//if connection fails, stop script execution
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	} else {
		
		$subjectform= ($_POST["subject"]);
		$fromform=($_POST["from"]);
		$link=($_POST["link"]);
		$category=($_POST["category"]);
		
		echo $subjectform . ' </br> ' .
		$fromform . ' </br> ' .
		$link . ' </br> ' .
		$category. ' </br> ' ;

		
		//otherwise, get emails from subscribers list
		$sql = "SELECT email FROM w_email_list WHERE category='".$category."'";
		$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));


		//loop through results and send mail		
		
		while ($row = mysqli_fetch_array($result)) {
		 set_time_limit(0);
		 $to = $row["email"];
		 $from=$fromform;
         $namefrom=$fromform;
         $nameto = $row["name_first"];
         $subject = stripslashes($_POST["subject"]);
         $message = file_get_contents($link);
		 
	
		 
		 
         
		 // this is it, lets send that email!
         authgMail($from, $namefrom, $to, $nameto, $subject, $message);
		 echo "newsletter sent to: ".$to."<br/>";
	
		}
		mysqli_free_result($result);
		mysqli_close($mysqli);
	}
}


else 

{
	echo '<h1>&nbsp;&nbsp;Please, <a href="demo.php">login</a> and come back later!</h1>';
    	
}
?>
</div>