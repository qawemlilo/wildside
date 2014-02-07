<?php
define('INCLUDE_CHECK',true);
require_once 'connect.php';
require 'functions.php';
?>
<?php 
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Wildside Magazine - The Magazine that takes you there</title>
    <meta charset="utf-8">
    <title>Wildside</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../favicon.ico">
</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">

<?php include("navbar.html"); ?>    


<div class="container_14">     
  <!-- Header logo
================================================== -->      
<div class="container_960">    
<div class="span12">   
<img src="img/wildside_logo.png" />  
</div>     
</div>  
  
   
    
 <!-- Menu
================================================== -->   
<div class="container_960">    
<div class="span12">
   <? include('menu.php');?> 
</div>    
</div>    
    

<!-- Banner
================================================== -->
<div class="container_960">
<div class="span12">
<? include('banner_news_1.php');?>
<div class="bottombar_slide"></div>
<div class="span12">
</div>
</div> 
</div> 


<!-- Container
================================================== -->
<div class="container">


<!--Body ================================================== -->

<?php $id = mysql_real_escape_string($_GET['category']);?>

<div class="row">
<div class="span8">
<?php
$querybody = "SELECT * FROM w_content  WHERE active ='yes' and category LIKE '%$id%' ORDER by category, datecreated DESC " ;
$resultbody = mysql_query ($querybody) or die('Error in query: $query. ' . mysql_error(). 'cannot connect to server' ) ;

while ($rowbody= mysql_fetch_array($resultbody)) 
{
echo '<section class="indexclear"><br/>';
if ($rowbody['image1'] =="")
{}
else{
echo '<section class="indexclear">
<img name="'. $rowbody['image1'].'" src="http://www.wildsidesa.co.za/admin/upload/server/php/thumbnails/'. $rowbody['image1']. '"   alt="'.$rowbody['image1'].'" width="200" id="indeximage" />';
}
echo '<div id="indextextupper">'. $rowbody['category']. '</div>';
echo '<h3>'. $rowbody['title']. '</h3>';

$page_width1 = $rowbody['page_width'];

if ($page_width1 =='')
{
echo '<div id="indextext">'. substr(($rowbody['story']),0,200). ' <a class="btn btn-small" href="http://www.wildsidesa.co.za/content/body_detail.php?id='.$rowbody['id'].'">...read more</a></div>';
}
else
{
echo '<div id="indextext">'. substr(($rowbody['story']),0,200). ' <a class="btn btn-small"  href="http://www.wildsidesa.co.za/content/body_detail_full.php?id='.$rowbody['id'].'">... read more</a></div>';	
}


echo '</section>';
} 
?>
</div>



<!-- Sidebar
================================================== -->
<div class="span4"> 
<?php include("http://www.wildsidesa.co.za/content/sidebar.php"); ?>
</div>

<!-- End Rowr --></div>




<!-- End container --></div>
<!-- End container_14 --></div>




    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/slider/js/bjqs-1.3.js"></script>
    <script src="assets/js/google-code-prettify/prettify.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script src="assets/js/bootstrap-affix.js"></script>
    <script src="assets/js/application.js"></script>
    
     <!--  Attach the plug-in to the slider parent element and adjust the settings as required -->
    <script>
      $(document).ready(function() {
        
        $('#banner').bjqs({
          'animation' : 'fade',
          'width' : 980,
          'height' : 250,
		  'useCaptions' : true,
          'keyboardNav' : true,
		  'nexttext' : '<img src="assets/slider/img/forward.png" width="61px" height="50px" /> ', // Text for 'next' button (can use HTML)
          'prevtext' : '<img src="assets/slider/img/back.png" width="61px" height="50px" />', // Text for 'previous' button (can use HTML)
        });
        
      });
    </script>
    
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
  <script>
     function hide(ele) {
         var srcElement = document.getElementById(ele);
         if(srcElement != null) {
	   if(srcElement.style.display == "block") {
     		  srcElement.style.display= 'none';
			  clearTimeout(ele);
   	    }
            else {
                   srcElement.style.display='block';
            }
            return false;
       }
  }
  </script>  
  
  <script>
$('#clicknews').click(function() {
  $('#news').slideToggle('slow',function() {
    // Animation complete.
  });
});
</script>
<script>
$('#clicktravel').click(function() {
  $('#travel').slideToggle('slow', function() {
    // Animation complete.
  });
});
</script>

<script>
$('#clickcompetition').click(function() {
  $('#competition').slideToggle('slow', function() {
    // Animation complete.
  });
});
</script>
<script>
$('#clickwildside').click(function() {
  $('#wildside').slideToggle('slow', function() {
    // Animation complete.
  });
});
</script>

<script>
$('#clickall').click(function() {
  $('#all').slideToggle('slow', function() {
    // Animation complete.
  });
});
</script>
<script>
$('.dropdown-toggle').dropdown()
</script>


    <!-- Footer
    ================================================== -->
<?php include("http://www.wildsidesa.co.za/content/footer.php"); ?> 
</body>
</html>