<?php 
error_reporting(E_ALL ^ E_NOTICE);
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
echo '<div id="head">'. strtoupper($row_head['category']). '</div>'; 
echo '<div class="lineredlarge"></div>';
while ($row= mysql_fetch_array($result)) 
{	

echo '<p class="author">POST BY: '. ($row['person']). ' on ' . date("F j, Y, g:i a",strtotime( $row['datecreated'])).'</p>'; 

echo '<div id="title">'. $row['title']. '</div>';
$comp_name = $row['title']; 



if ($row['button'] =="")
{
}	
else{
	
if ($row_head['category'] =="Competitions")	
{
echo '<div class="link" onclick="TINY.box.show({url:\'http://www.wildsidesa.co.za/content/email/form_competitions.php\',post:\'id='. ($row['title']).'\',width:450,height:550,maskid:\'bluemask\',maskopacity:40,topsplit:3})">'.($row['button']).'</div><div class="clearline"></div>';
}

else{
	if ($row_head['category'] =="Travel")	
{
echo '<div class="link" onclick="TINY.box.show({url:\'http://www.wildsidesa.co.za/content/email/form_travel_enquiry.php\',post:\'id='. ($row['title']).'\',width:450,height:550,maskid:\'bluemask\',maskopacity:40,topsplit:3})">'.($row['button']).'</div><div class="clearline"></div>';
}
else{
	
	echo '<div class="link"><a href="'.($row['link']).'">'.($row['button']).'</a></div><div class="clearline"></div>';
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

echo '<p>'. nl2br($row['story']). '</p>';

echo '<br /><div class="linered"></div>';
} 
echo '</div>'; 
?>






<?php include("http://www.wildsidesa.co.za/content/email/form_warriorletter.php"); ?>
<?php include("http://www.wildsidesa.co.za/content/email/form_warriorletter_friend.php"); ?>
