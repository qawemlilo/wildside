<?php
define('INCLUDE_CHECK',true);
require_once 'content/connect.php';
require 'content/functions.php';
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
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="content/assets/css/bootstrap.css" rel="stylesheet">
    <link href="content/assets/js/google-code-prettify/prettify.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="content/assets/css/style.css" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
        <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../favicon.ico">


</head>

<body>

<?php include("content/navbar.html"); ?>    


<div class="container_14">     
  <!-- Header logo
================================================== -->      
<div class="container_960">    
<div class="span12">   
<img src="content/img/wildside_logo.png" />  
</div>     
</div>  
  
   
    
 <!-- Menu
================================================== -->   
<div class="container_960">    
<div class="span12">
   <? include('content/menu.php');?> 
</div>    
</div>    
    



<!-- Container
================================================== -->
<div class="container">
<br/>


<div class="row"><!-- Begin tab row content -->
<ul class="nav nav-tabs">
<li href="#Wildside" data-toggle="tab"><div style="width:220px; height:170px; margin-left:20px; background-image:url(http://www.wildsidesa.co.za/admin/upload/server/php/files/competition_button.jpg); background-position:top center;background-repeat:no-repeat; cursor:pointer;"></li>
<li href="#travel" data-toggle="tab"><div style="width:220px; height:170px;  margin-left:20px; background-image:url(http://www.wildsidesa.co.za/admin/upload/server/php/files/travelandadventure_button.jpg); background-position:top center;background-repeat:no-repeat; cursor:pointer;"></li>
<li href="#news" data-toggle="tab"><div style="width:220px; height:170px; margin-left:20px; background-image:url(http://www.wildsidesa.co.za/admin/upload/server/php/files/wildsidenews_button.jpg); background-position:top center;background-repeat:no-repeat; cursor:pointer;"></li>
<li href="#warrior" data-toggle="tab"><div style="width:220px; height:170px; margin-left:20px; background-image:url(http://www.wildsidesa.co.za/admin/upload/server/php/files/wildsideqwarrior_button.jpg); background-position:top center;background-repeat:no-repeat; cursor:pointer;"></li>
</ul>

<!-- Begin tab content -->

<div class="tab-content">

<div class="tab-pane" id="Wildside">
<div class="span12">
<div id="mygrid_grey"><h3 class="white">Enter <span class="grey">Competitions</span></h3></div>
</div>
 <?php
$sqlcomp ="SELECT @row := @row + 1 as row, active, title, story, image1, category, id
FROM w_content, (SELECT @row := 0) r
WHERE active='yes' AND category='competitions' ORDER by category, datecreated DESC
";
$resultcomp = mysql_query ($sqlcomp) or die('Error in query: $query. ' . mysql_error() ) ;

while ($rowcomp= mysql_fetch_array($resultcomp)) 
{
echo '<div class="span3">';
echo '<div id="mygrid">';
echo '<img name="" src="http://www.wildsidesa.co.za/admin/upload/server/php/thumbnails/'. $rowcomp['image1'].'" width="198"  alt="" />';
echo '<h5>'.$rowcomp['category']. '</h5>';
echo '<h3>'. $rowcomp['title']. '</h3>';
echo '<p >'. substr(($rowcomp['story']),0,100). '... <br/> <a class="btn btn-small" style="margin-top:5px;"  href="http://www.wildsidesa.co.za/content/body_detail.php?id='.$rowcomp['id'].'">Enter now</a></p>';	
echo '</div>'; 	
echo '</div>'; 
if ($rowcomp['row'] =="4")
{echo ' <div class="span12"><hr /></div>'; } 	
}	
?>      
</div>




<div class="tab-pane" id="travel">
<div class="span12">
<div id="mygrid_grey"><h3 class="white">Travel <span class="grey"> & ADVENTURE</span></h3></div> 
</div>
<?php
$sqlcomp ="SELECT @row := @row + 1 as row, active, title, story, image1, category, id
FROM w_content, (SELECT @row := 0) r
WHERE active='yes' AND category='travel' ORDER by category, datecreated DESC
";
$resultcomp = mysql_query ($sqlcomp) or die('Error in query: $query. ' . mysql_error() ) ;
while ($rowcomp= mysql_fetch_array($resultcomp)) 
{
echo '<div class="span3">';
echo '<div id="mygrid">';
echo '<img name="" src="http://www.wildsidesa.co.za/admin/upload/server/php/thumbnails/'. $rowcomp['image1'].'" width="198"  alt="" />';
echo '<h5>'.$rowcomp['category']. '</h5>';
echo '<h3>'. $rowcomp['title']. '</h3>';
echo '<p >'. substr(($rowcomp['story']),0,100). ' ... <br/><a class="btn btn-small" style="margin-top:5px;"   href="http://www.wildsidesa.co.za/content/body_detail.php?id='.$rowcomp['id'].'"> Read more</a></p>';	
echo '</div>'; 	
echo '</div>';
if ($rowcomp['row'] =="4")
{echo ' <div class="span12"><hr /></div>'; } 	
}	
?> 
</div>



<div class="tab-pane" id="news">
<div class="span12">
<div id="mygrid_grey"><h3 class="white">Current <span class="grey">News</span></h3></div>
</div>
<?php
$sqlcomp ="SELECT @row := @row + 1 as row, active, title, story, image1, category, id
FROM w_content, (SELECT @row := 0) r
WHERE active='yes' AND category='news' ORDER by category, datecreated DESC
";
$resultcomp = mysql_query ($sqlcomp) or die('Error in query: $query. ' . mysql_error() ) ;

while ($rowcomp= mysql_fetch_array($resultcomp)) 
{
echo '<div class="span3">';
echo '<div id="mygrid">';
echo '<img name="" src="http://www.wildsidesa.co.za/admin/upload/server/php/thumbnails/'. $rowcomp['image1'].'" width="198"  alt="" />';
echo '<h5>'.$rowcomp['category']. '</h5>';
echo '<h3>'. $rowcomp['title']. '</h3>';
echo '<p >'. substr(($rowcomp['story']),0,100). '... <br/> <a class="btn btn-small" style="margin-top:5px;"   href="http://www.wildsidesa.co.za/content/body_detail.php?id='.$rowcomp['id'].'"> Read more</a></p>';	
echo '</div>'; 	
echo '</div>'; 
if ($rowcomp['row'] =="4")
{echo ' <div class="span12"><hr /></div>'; } 	
}	
?>           
</div>



<div class="tab-pane" id="warrior">
<div class="span12">
<div id="mygrid_grey"><h3 class="white">Wildside <span class="grey">Warriors</span></h3></div>
</div>
 
<?php
$sqlcomp ="SELECT @row := @row + 1 as row, active, title, story, image1, category, id
FROM w_content, (SELECT @row := 0) r
WHERE active='yes' AND category='Wildside-Warriors' ORDER by category, datecreated DESC
";
$resultcomp = mysql_query ($sqlcomp) or die('Error in query: $query. ' . mysql_error() ) ;

while ($rowcomp= mysql_fetch_array($resultcomp)) 
{
echo '<div class="span3">';
echo '<div id="mygrid">';
echo '<img name="" src="http://www.wildsidesa.co.za/admin/upload/server/php/thumbnails/'. $rowcomp['image1'].'" width="198"  alt="" />';
echo '<h5>'.$rowcomp['category']. '</h5>';
echo '<h3>'. $rowcomp['title']. '</h3>';
echo '<p >'. substr(($rowcomp['story']),0,100). '... <br/> <a class="btn btn-small" style="margin-top:5px;"   href="http://www.wildsidesa.co.za/content/body_detail.php?id='.$rowcomp['id'].'"> Read more</a></p>';	
echo '</div>'; 	
echo '</div>'; 
if ($rowcomp['row']=="4")
{echo ' <div class="span12"><hr /></div>'; } 	
}	
?>             
</div>

</div><!-- End tab content -->
</div><!-- End row -->








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
    <script src="content/assets/js/jquery.js"></script>
    <script src="content/assets/slider/js/bjqs-1.3.js"></script>
    <script src="content/assets/js/google-code-prettify/prettify.js"></script>
    <script src="content/assets/js/bootstrap-transition.js"></script>
    <script src="content/assets/js/bootstrap-alert.js"></script>
    <script src="content/assets/js/bootstrap-modal.js"></script>
    <script src="content/assets/js/bootstrap-dropdown.js"></script>
    <script src="content/assets/js/bootstrap-scrollspy.js"></script>
    <script src="content/assets/js/bootstrap-tab.js"></script>
    <script src="content/assets/js/bootstrap-tooltip.js"></script>
    <script src="content/assets/js/bootstrap-popover.js"></script>
    <script src="content/assets/js/bootstrap-button.js"></script>
    <script src="content/assets/js/bootstrap-collapse.js"></script>
    <script src="content/assets/js/bootstrap-carousel.js"></script>
    <script src="content/assets/js/bootstrap-typeahead.js"></script>
    <script src="content/assets/js/bootstrap-affix.js"></script>
    <script src="content/assets/js/application.js"></script>
    
     <!--  Attach the plug-in to the slider parent element and adjust the settings as required -->
    <script>
      $(document).ready(function() {
        
        $('#banner').bjqs({
          'animation' : 'fade',
          'width' : 980,
          'height' : 250,
		  'useCaptions' : true,
          'keyboardNav' : true,
		  'nexttext' : '<img src="content/assets/slider/img/forward.png" width="61px" height="50px" /> ', // Text for 'next' button (can use HTML)
          'prevtext' : '<img src="content/assets/slider/img/back.png" width="61px" height="50px" />', // Text for 'previous' button (can use HTML)
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
</body>
</html>