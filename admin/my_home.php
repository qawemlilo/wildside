<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>people</title>
<style type="text/css"> @import url("css.css"); </style> 
</head>
<body>
<?php
define('INCLUDE_CHECK',true);

require 'connect.php';

include 'maststrip.php'; 
if($_SESSION['id'])
{
echo 'hello World';
}
?>
</body>
</html>