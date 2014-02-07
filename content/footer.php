<footer class="footer">
<div class="container">
      
<div class="row">
<div class="span12">
<div class="navbar">
<div class="navbar-inner">
<ul class="nav">
 <?php
define('INCLUDE_CHECK',true);
require 'connect.php';

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
$storage_menu ='';
$querymenu = " SELECT DISTINCT category FROM w_content WHERE active ='yes' " ;

if( $resultmenu = mysql_query ($querymenu))
{

echo '<li><a style="font-family: OpenSansRegular;" href="http://www.wildsidesa.co.za" id="current">Home</a></li>';

    while ($rowmenu= mysql_fetch_array($resultmenu)) 
    {	
      $menu ='<li><a style="font-family: OpenSansRegular;" href="/content/body.php?category='.$rowmenu['category'].'">'.$rowmenu['category'].'</a></li>';
	  $storage_menu .= $menu;
	  echo $menu;
    }
?>
<li><a style="font-family: OpenSansRegular;" href="http://www.wildsidesa.co.za/shop/">Subscription Shop</a></li>
<li><a href="#">Go to top <i class="icon-circle-arrow-up"></i></a></li>
<?


}
else
{
   echo 'Query has failed !';
}

?>
</ul>
</div>  
</div> 
</div>
</div>    
        
<div class="row">
<div class="span12">
<small>Wildside sponsors and assists the following Conservation Agencies</small><br/><br/>
</div>
</div>

<div class="row">
<div class="span12">
<?php include("sponsors.html"); ?>
</div>
</div>


</div>
</footer>