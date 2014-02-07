<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CMS-Content</title>
<link rel="stylesheet" href="../../jquery-ui-1-1/css/ui-lightness/jquery-ui-1.8.13.custom.css">
<script src="../../jquery-ui-1-1/development-bundle/jquery-1.5.1.js"></script>
<script src="../../jquery-ui-1-1/development-bundle/ui/jquery.ui.core.js"></script>
<script src="../../jquery-ui-1-1/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="../../jquery-ui-1-1/development-bundle/ui/jquery.ui.tabs.js"></script>
<script>
$(function() {
		$( "#tabs" ).tabs();
	});
	</script>
    <SCRIPT language="JavaScript1.2">
function openwindow()
{
	window.open("http://www.wildsidesa.co.za/content/img/thumbnail","mywindow","menubar=1,resizable=1,width=490,height=700");
}
</SCRIPT>
<link rel="stylesheet" href="http://www.wildsidesa.co.za/fonts/stylesheet.css" type="text/css" charset="utf-8" media="screen">
<link href="css/db.css" rel="stylesheet" type="text/css" />
<link href="css/form.css" rel="stylesheet" type="text/css" />
</head>



<body>
<div class="strap">
<div class="header"><br/><strong style="color:#D6DDD6; font: 16px/16px 'OpenSansSemibold', Helvetica, Arial, sans-serif; padding-left:15px;"> WILDSIDE CONTENT MANGER &nbsp;&nbsp;&nbsp;&nbsp; </strong>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#A7B6B5"><?php
	if($_SESSION['id'])
	echo 'Hello, '.$_SESSION['usr'].'&nbsp;&nbsp; You are registered and logged in!';
	else echo 'Please, <a href="../home.php">login</a> and come back later!';
    ?></span>
    <!-- end .header --></div>
    </div>
 
<div class="container">  
<div class="sidebar">
    <ul class="nav">
      <li><a href="contentmanager.php?q=%">Content List</a></li>
      <li><a href="contentmanager_add.php">New Page</a></li>
      <li><a href="javascript: openwindow()">Import Picture</a></li>
      <li><a href="#">Link four</a></li>
    </ul>
<p></p>
<!-- end .sidebar1 --></div>  

</body>
</html>
