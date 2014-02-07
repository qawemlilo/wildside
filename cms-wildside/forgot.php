<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if( !$_POST['submit'])
{
?>
<form name="forgot" method="post" action="<?= $_SERVER['PHP_SELF']?>">

<input name="usr" type="text" value="" size="20"/><br>

<input type="submit" name="submit" value="submit"/>

<input type="reset" name="reset" value="reset"/> </form>

<?php

}
else
{

$connection = mysql_connect('mysql55.pointinspace.com', 'LIG_lightship', 'lightinusa') or die ('Unable to connect to server');
 
mysql_select_db('lig_lightship') or die('Unable to select database');

$sql="SELECT pass, email FROM tz_members WHERE usr='".$_POST['usr']."'";
$r = mysql_query($sql);
if(!$r) {

    $err=mysql_error();

    print $err;

    exit();
}

if(mysql_affected_rows()==0){

    print "no such login in the system. please try again.";

    exit();
}
else {

    $row=mysql_fetch_row($r);

     $password=$row[0];

    $email= $row[3];

    $subject="your password";

    $header="from:rod@lightship.co.za";

    $message="your password is ". $password;
	

   mail( $email,  $subject, $message, $header);
	

	
	

    print "An email containing the password has been sent to you" . '</br>'; echo $email . '</br>' ;  echo $password ;

}
}
?>
</body>
</html>