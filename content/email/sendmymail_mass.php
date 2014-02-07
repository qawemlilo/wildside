<?php
define('INCLUDE_CHECK',true);

require 'connect.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

include '../maststrip.php'; 
?>
<style type="text/css">
.margin {
	margin-top: 20px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 15px;
	color: #FDFDFD;
}
</style>

<br />
<br />
<div class="containerdb">
<br />
<h2 class="margin"><strong>FLYING EMAILS</strong> - Sugar Journal</h2>
<br />

    
    
    
<?php
	
	
if($_SESSION['id'])
{

include("ch19_include.php");

if (!$_POST) {
	//haven't seen the form, so display it
	echo "<html>
	<head>
	<title>Send a Newsletter</title>
	</head>
	<body>
	<p><strong>Send a Newsletter</strong><p>
	<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
	<p><strong>Subject:</strong><br/>
	<input type=\"text\" name=\"subject\" size=\"40\"></p>
	<p><strong>From:</strong><br/>
	<input type=\"text\" name=\"from\" size=\"40\"></p>";

	// Select Category 
$query = "SELECT category FROM sj_marketing GROUP BY category ORDER BY category DESC";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

{
	$cat=$row["category"]; 
    $options.="<OPTION VALUE=\"$cat\">".$cat.'</option>';
}
	
echo "	
<p><select name=\"category\">      
<?=$options?>                 
</select></p>
		
	<p><strong>Mail Body Link:</strong><br/>
	<textarea name=\"link\" cols=\"70\"></textarea>
	<p><input type=\"submit\" name=\"submit\" value=\"Send It\"></p>
	</form>
	<br />
<br />
	</body>
	</html>";
	

} else if ($_POST) {
	//want to send form, so check for required fields
	if (($_POST["subject"] == "") || ($_POST["link"] == "")) {
		echo "Please fill in the <strong>Subject</strong> and the <strong>Link</strong> to the web page that you wanto to send";
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
		$sql = "SELECT email FROM sj_marketing WHERE category='".$category."'";
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

}
else 

{
	echo '<h1>&nbsp;&nbsp;Please, <a href="home.php">login</a> and come back later!</h1>';
    	
}

?>
</div>