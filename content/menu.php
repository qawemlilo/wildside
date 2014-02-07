<?php
$storage_menu ='';
$querymenu = " SELECT DISTINCT category FROM w_content WHERE active ='yes' " ;

if( $resultmenu = mysql_query ($querymenu))
{

echo '<ul class="semiopaquemenu">';
echo '<li><i class="icon-leaf"></i><a style="font-family: OpenSansRegular;" href="http://www.wildsidesa.co.za" id="current">Home</a></li>';

    while ($rowmenu= mysql_fetch_array($resultmenu)) 
    {	
      $menu ='<li><a style="font-family: OpenSansRegular;" href="/content/body.php?category='.$rowmenu['category'].'">'.$rowmenu['category'].'</a></li>';
	  $storage_menu .= $menu;
	  echo $menu;
    }
?>
<li><a style="font-family: OpenSansRegular;" href="http://www.wildsidesa.co.za/subscribe/"><i class="icon-shopping-cart"></i> Subscribe Now</a></li>
<li><a style="font-family: OpenSansRegular;" href="http://www.wildsidesa.co.za/content/body.php"><button type="button" class="btn"><i class="icon-th-list"></i></button></a></li>
</ul>
<?


}
else
{
   echo 'Query has failed !';
}

?>
<div class="bottombar"></div>