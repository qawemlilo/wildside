<?php
	require_once('auth.php');
	require_once('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Member Index</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://www.wildsidesa.co.za/fonts/stylesheet.css" type="text/css" charset="utf-8" media="screen">
</head>
<body>

<br/><br/><br/><br/>
<div id="wrapper">
<div id="container">
<div id="left_box">
<div id="logo"></div>
</div>
<div id="right_box">
<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
<a href="member-profile.php">My Profile</a> | <a href="logout.php">Logout</a>
<p>This is a password protected area only accessible to members. </p>
</div>
</div>
</div>
</body>
</html>
