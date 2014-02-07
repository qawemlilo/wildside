<?php
define('INCLUDE_CHECK',true);

require 'connect.php';
require 'function.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
include 'maststrip.php'; 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Gallery</title>
<style type="text/css">
body{
	background-color:#3D3D3D;
	color:#E4E4E4;
}
div.img
  {
	margin:2px;
	border:1px solid silver;
	height:180px;
	width:auto;
	float:left;
	text-align:center;
	padding:10px;
	background-color:#F8F8F8;
  }
div.img img
  {
  display:inline;
  border:1px solid #ffffff;
  height:110px;
  width:150px;
    overflow:hidden;
  }

div.desc
  {
	text-align:center;
	font-weight:normal;
	font-size:11px;
	width:100px;
	margin-top: 2px;
	margin-right: 0px;
	margin-bottom: 2px;
	margin-left: 0px;
	color: #565656;
  }
  

</style>
</head>

<body>
<div class="content">
<h1 style="padding-bottom:25px;">Gallery: Banner</h1>
<?php
$handle = opendir(dirname(realpath(__FILE__)).'/uploadbanner/server/php/thumbnails/');
		while($file = readdir($handle)){
			if($file !== '.' && $file !== '..'){
				echo '<div class="img">
				
				<a href="http://www.wildsidesa.co.za/admin/uploadbanner/server/php/files/'.$file.'"><img src="/admin/uploadbanner/server/php/thumbnails/'.$file.'" border="0" /> </a>
				
				<div class="desc">' .$file.'</div>
				<div class="desc"><a href="http://www.wildsidesa.co.za/admin/uploadbanner/crop/demo-crop.php?image='.$file.'">banner985</a></div>
				</div>';
			}
		}
?>



</body>
</html>