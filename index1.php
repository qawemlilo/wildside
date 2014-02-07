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
<div class="container" style="width:960px;">
<div class="row" style="margin-left:-10px;"> 

<?php
$sql ="SELECT @row := @row + 1 as row, active, title, story, image1, category, id
FROM w_content, (SELECT @row := 0) r
WHERE active='yes' ORDER by category
";
$result1 = mysql_query ($sql) or die('Error in query: $query. ' . mysql_error() ) ;
?>

<br/>
<div class="span3" id="clickcompetition">
   <div style="width:220px; height:170px; background-image:url(http://www.wildsidesa.co.za/homepagegraphics/competition_button.jpg); background-position:top center;background-repeat:no-repeat; cursor:pointer;">
   </div>
</div>

<div class="span3" id="clicktravel">
   <div style="width:220px; height:170px; background-image:url(http://www.wildsidesa.co.za/homepagegraphics/travelandadventure_button.jpg); background-position:top center;background-repeat:no-repeat; cursor:pointer;">
   </div>
</div>

<div class="span3" id="clicknews">
<div style="width:220px; height:170px; background-image:url(http://www.wildsidesa.co.za/homepagegraphics/wildsidenews_button.jpg); background-position:top center;background-repeat:no-repeat; cursor:pointer;">
   </div>
</div>

<div class="span3" id="clickwildside">
<div style="width:220px; height:170px; background-image:url(http://www.wildsidesa.co.za/homepagegraphics/wildsideqwarrior_button.jpg); background-position:top center;background-repeat:no-repeat; cursor:pointer;">
   </div>
   
<div class="clear"><br/></div>     
</div>

<div id="competition" style="display:none;">
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
<div class="span12">
<hr />
</div>
</div>

<div id="travel" style="display:none;"> 
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
<div class="span12">
<hr />
</div>     
</div>



<div id="news" style="display:none;">
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
<div class="span12"><hr /></div>
</div>


<div id="wildside" style="display:none;">
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
<div class="span12"><hr /></div>
</div>
   



<!--SPAN9 + SPAN 3
================================================== -->
<div class="row" style="margin-left:0px;">  
<div class="span9"> 
<div id="mygrid">  
<h1>HELP STOP THE BLOODY KILLING</h1>
<h2> Become a Wildside Warrior Today</h2>
<p><span class="bold">Wildside Warriors</span> is for people who want to contribute to anti-poaching efforts, who enjoy nature and travelling and will benefit from accommodation discounts. </p>
<p>Wildside will donate <span class="bold">R50 to Project Rhino KZN</span> for every Wildside Warrior. Project Rhino KZN is administered by the <span class="bold">African Conservation Trust</span> and solely for anti-poaching equipment and efforts.</p>
<p><a href="#"><img src="content/img/wswarriorclickmore.png" width="558" height="97" style="margin:5px 0px 10px 0px"/></a></p>
<p><a class="btn btn-info" href="http://www.wildsidesa.co.za/content/body_detail.php?id=44">SHOW ME THE PROJECT RHINO KZN - FOUNDING ORGANISATIONS</a></p> 
</div>
<div class="clear"></div> 


<div id="mygrid"> 
<p>
 <a href="http://issuu.com/wildside/docs/wildside_magazine_summer_2010?mode=embed&amp;layout=http%3A//skin.issuu.com/v/light/layout.xml&amp;showFlipBtn=true"><img src="content/img/2010-WS-4of4-Cover_opt.jpg" width="194" class="whiteframe"/></a></p>   
<h1>WILDSIDE MAGAZINE</h1>
<h2> The Magazine That Takes You There</h2>
<p>Start your exploration from the mountain heights of the uKhahlamba Drakensberg Park, a World Heritage Site. Discover the unique cultural history of the San People whilst you savour the panoramic vistas of the tropical savannahs of Zululand where the big five, elephant, rhino, lion, buffalo and leopard inhabit the Hluhluwe Imfolozi Park and onto the lakes and wetlands of the World Heritage Site of the Greater St Lucia Wetland Park, to end your journey swimming amongst the brilliant coral reefs of the Indian Ocean. Let Wildside Magazine take you to a real african experience in South Africa - KwaZulu-Natal.</p><p><a class="btn btn-info" href="http://issuu.com/wildside/docs/wildside_magazine_summer_2010?mode=embed&amp;layout=http%3A//skin.issuu.com/v/light/layout.xml&amp;showFlipBtn=true">Click here to view Online</a></p>   
</div>     
</div>

<div class="span3"> 
<div id="mygrid">
<div id="mygrid_grey" ><h3 class="white">Subscribe <span class="grey">Now</span></h3></div>
<a href="http://www.wildsidesa.co.za/shop/"><img src="admin/upload/server/php/files/subscribecover.png" width="189" height="216"></a>
<p>
Wildside Magazine, published quarterly, is a quality, exciting, ecotravel, adventure and conservation read. Its primary editorial focus is KwaZulu-Natal, South Africa including the East African Seaboard with select options in Africa.</p>
<p><a class="btn btn-inverse" style="margin-top:5px;"  href="http://www.wildsidesa.co.za/shop/">Subscribe now</a></p>
</div>
</div>

<!-- End row
================================================== -->
</div>
 


<div class="row" style="margin-left:0px;"> 
<div class="span4"> 
 <a href="http://www.atta.travel" target="_blank"><img src="http://www.wildsidesa.co.za/homepagegraphics/affiliates/atta-logo.png" width="135" height="78" /></a><h5>Advancing<br/>Tourism to Africa</h5>
 <p>ATTA creates the platform for buyers across Europe to meet suppliers of African tourism product at networking events and trade shows.</p>
</div>
<div class="span4"> 
<a href="http://www.wildlands.co.za" target="_blank"><img src="http://www.wildsidesa.co.za/homepagegraphics/affiliates/wildlandslogo.png" width="94" height="100"  /></a>
<h5>Wildlands <br/>conservation trust</h5>
<p>A leading South African community conservationist NGO. Wildside makes considerable donations in space to the Trust in order that its story is told.</p>
</div>
<div class="span4"> 
<a href="http://www.kznwildlife.com" target="_blank"><img src="http://www.wildsidesa.co.za/homepagegraphics/affiliates/kznwildlife.gif" width="98" height="93" /></a>
  <h5>EZEMVELO KZN WILDLIFE</h5>
 <p>A leading South African community conservationist NGO. Wildside makes considerable donations in space to the Trust in order that its story is told.</p>
</div>
<br/>
</div>



<!-- End row
================================================== -->
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
<?php include("http://www.wildsidesa.co.za/content/footer.php"); ?> 
</body>
</html>
