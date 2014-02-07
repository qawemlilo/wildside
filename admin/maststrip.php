<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="http://www.wildsidesa.co.za/admin/admin.css" media="screen" />
<link type="text/css" rel="stylesheet" href="css/style.css" media="all" />
<title></title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
<!--
/****************************************************
     Author: Eric King
     Url: http://redrival.com/eak/index.shtml
     This script is free to use as long as this info is left in
     Featured on Dynamic Drive script library (http://www.dynamicdrive.com)
****************************************************/
var win=null;
function NewWindow(mypage,myname,w,h,scroll,pos){
if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}
if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}
else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}
settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
win=window.open(mypage,myname,settings);}
// -->
</script>
<script src="login_panel/js/slide.js" type="text/javascript"></script>
    <script>
     function show(ele) {
         var srcElement = document.getElementById(ele);
         if(srcElement != null) {
	   if(srcElement.style.display == "block") {
     		  srcElement.style.display= 'none';
   	    }
            else {
                   srcElement.style.display='block';
            }
            return false;
       }
  }
  </script> 
</head>
<body>
<?php include 'my_sidebar.php';?>
<div class="content">
<?php
	if($_SESSION['id'])
	{
	echo 'Hello, '.$_SESSION['usr'].'&nbsp;&nbsp; You are registered and logged in!';
	}
	else 
	{echo 'Please, <a href="http://www.wildsidesa.co.za/admin/index.php">login</a> and come back later!';
	}
    ?>
   &nbsp;&nbsp;&nbsp;&nbsp;  <a  href="http://www.wildsidesa.co.za/admin/index.php">HOME</a>
</div>
</body>
</html>