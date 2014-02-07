<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Wildside Send</title>
      <link rel="STYLESHEET" type="text/css" href="http://www.wildsidesa.co.za/content/email/contact.css" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php
if (isset($_POST['Submit'])) {



//define the sender name of the email 
$sendername = $_POST['visitorname']; 
//define the sender name of the email 
$senderemail = $_POST['visitoremail']; 
//define the receiver of the email 
$to = 'rod@lightship.co.za'; 
//define the subject of the email 
$subject = 'A petition against the poaching of Africa\'s Rhino'; 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash 
$random_hash = md5(date('r', time())); 
//define the headers we want passed. Note that they are separated with \r\n 
$headers = "From: info@wildsidesa.co.za\r\nReply-To: info@wildsidesa.co.za"; 
//add boundary string and mime type specification 
$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 
//read the atachment file contents into a string,
//encode it with MIME base64,
//define the body of the message. 
ob_start(); //Turn on output buffering 
?> 
--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>" 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<!-- HTML here -->

<?php include("http://www.wildsidesa.co.za/cms/bookings/pdfbookings.php?id=SJ%20532"); ?>

<!-- HTML End -->       


<!-- Do mysql ----------------------------------------------------------->   
<?php 
define('INCLUDE_CHECK',true);
require '../connect.php';
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
?>

<?php
$query = " INSERT INTO lig_wildside.w_webvisitor (visitor_category, full_name, email, subscribe, date_entered) VALUES ('Panda Campaign', '$sendername', '$senderemail', 'yes', 'NOW()')" ;
$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;
mysql_close($connection);
?>
<!-- endmysql ----------------------------------------------------------->  




<?php 
//copy current buffer contents into $message variable and delete current output buffer 
$message = ob_get_clean(); 
//send the email 
$mail_sent = @mail( $to, $subject, $message, $headers ); 
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
?>
<div class='container'>
<?php echo $mail_sent ? 
'
<div id="wrappermain">
<form id="contactus">
<fieldset >
<legend><h2>Thank You</h2>
<p>Your Email has been sent.</p></legend>
<INPUT TYPE="BUTTON" VALUE="Return to your page" 
ONCLICK="history.go(-1)">
</fieldset >
</form>
</div>
'

: "Mail failed"; ?>
</div>
<?php
}
?>

<?php 
if (!$_POST ['Submit'])
{
?>
<!--------------------------FORM --------------------------------------->


<form id='contactus' action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Support the War against the poaching of Africa's Rhino</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div class='short_explanation'>* required fields</div>

<div class='container'>
<span id="sprytextfield1">
<label for='name' >Your Full Name*: </label><br/>
<input type='text' name='visitorname' id='visitorname' value='' maxlength="50" /><br/>
<span class="textfieldRequiredMsg">A value is required.</span></span>
</div>
<div class='container'>
<span id="sprytextfield2">
<label for='email' >Email Address*:</label><br/>
<input type='text' name='visitoremail' id='visitoremail' value='' maxlength="50" /><br/>
<span class="textfieldRequiredMsg">A value is required.</span></span>
</div>
<div class='container'>
  <input type='submit' name='Submit' value='Submit' /> 
</div>

</fieldset>
</form>	

<?php
}
?>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>