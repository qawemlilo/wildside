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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    



<!-- Container
================================================== -->
<div class="container">



<!--Body_detail
================================================== -->
<div class="row"> 
<div class="span9">


<?php 
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
?>

<?php $id = mysql_real_escape_string($_GET['id']); ?>

<?php
$query = " SELECT * FROM w_content WHERE active  ='yes' AND id='$id' " ;
$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;
?>

<?php 
$result_head = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;
$row_head = mysql_fetch_array ($result_head); ?>

<?php
echo '<div id="content">';
echo '<p><div id="head">'. strtoupper($row_head['category']). '</div></p>'; 
echo '<p><div class="lineredlarge"></div></p>';
while ($row= mysql_fetch_array($result)) 
{	

echo '<div class="author">POST BY: '. ($row['person']). ' on ' . date("F j, Y, g:i a",strtotime( $row['datecreated'])).'</div>'; 

echo '<p><div id="title">'. $row['title']. '</div></p>';
$comp_name = $row['title']; 



if ($row['button'] =="")
{
}	
else{
	
if ($row_head['category'] =="Competitions")	
{
echo '<p><div class="link" onclick="TINY.box.show({url:\'http://www.wildsidesa.co.za/content/email/form_competitions.php\',post:\'id='. ($row['title']).'\',width:450,height:550,maskid:\'bluemask\',maskopacity:40,topsplit:3})">'.($row['button']).'</div><div class="clearline"></div></p>';
}

else{
	if ($row_head['category'] =="Travel")	
{
echo '<p><div class="link" onclick="TINY.box.show({url:\'http://www.wildsidesa.co.za/content/email/form_travel_enquiry.php\',post:\'id='. ($row['title']).'\',width:450,height:550,maskid:\'bluemask\',maskopacity:40,topsplit:3})">'.($row['button']).'</div><div class="clearline"></div></p>';
}
else{
	
	echo '<p><div class="link"><a href="'.($row['link']).'">'.($row['button']).'</a></div><div class="clearline"></div></p>';
}
}	
}

if ($row['image1'] =="")
{}
else{
echo '<p class="image">'. '<img name="'. $row['image1'].'" src="http://www.wildsidesa.co.za/admin/upload/server/php/files/'. $row['image1']  .'" width="'.$row['img_width'] .'"   alt="'.$row['image1'].'" /></p>';
echo '<p class="caption">'. nl2br($row['caption']). '</p>';
}

echo '<p class="intro">'. nl2br($row['storyintro']). '</p>';

echo '<p>'. $row['story']. '</p>';

echo '<br /><div class="linered"></div>';
} 
echo '</div>'; 
?>
</div>



<!-- Sidebar
================================================== -->
<div class="span3"> 
<?php
$limitsearch = $id;
?>
<br />
<div class="accordion" id="accordion2">            
 <?php 
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
?>
<?php
$query_link = " SELECT * FROM w_content_cat ORDER BY category";
$result_link = mysql_query ($query_link) or die('Error in query: $query. ' . mysql_error() ) ;
?>
<?php 
while ($row= mysql_fetch_array($result_link)) 
{

echo '<div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle content" data-toggle="collapse" data-parent="#accordion2" href="#'.$row['category'].'">'.$row['category'].'</a>
                  </div>
				  ';
	
$query2 = "SELECT category, id, title, storyorder, page_width FROM w_content WHERE category ='".$row['category']."' AND active  ='yes' ORDER BY datecreated DESC";
$result2 = mysql_query($query2);

echo '<div id="'.$row['category'].'" class="accordion-body collapse">
                    <div class="accordion-inner">';
while($row2 = mysql_fetch_array($result2))
{
$page_width = $row2['page_width'];

if ($page_width =='')
{
echo ' <a class="content"  href="http://www.wildsidesa.co.za/content/body_detail.php?id='.$row2['id'].'">'.$row2['title'].'</a><hr/ class="navigation">';	
}

else
{	
echo ' <a class="content"  href="http://www.wildsidesa.co.za/content/body_detail_full.php?id='.$row2['id'].'">'.$row2['title'].'</a><hr/ class="navigation">';
}
} 
echo ' </div>
         </div>
          </div>';
}
?> 
</div>

<br/>
<div>
<?php include("http://www.wildsidesa.co.za/shop/sponsorship.html"); ?>
</div>
</div><!-- End span5 -->	
</div><!-- End row -->
<!-- EndSidebar -->













</div>
<!-- End container
================================================== -->
</div>

  
<!-- End container_14
================================================== -->
</div>




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