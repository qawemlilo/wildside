<div id="banner">
<!-- start Basic Jquery Slider -->
<ul class="bjqs">
<?php
$querybanner = " SELECT * FROM w_content  WHERE active_home ='yes' ORDER BY RAND() " ;
$resultbanner = mysql_query ($querybanner) or die('Error in query: $query. ' . mysql_error() ) ;

while ($row= mysql_fetch_array($resultbanner)) 
{	

if ($row['image2'] !=="")
{
$page_widthbanner = $row['page_width'];
if ($page_widthbanner =='')
{

$text1 = '<div class=\'bjqs-caption-banner text_style_banner \'><h2>'.$row['title'].'</h2>';	

echo '<li><img style="overflow:hidden;" src="'.$docRoot.'/admin/uploadbanner/server/php/files/banner985/' . $row['image2'].'" alt=""   title="<a href='.$docRoot.'/content/body_detail.php?id='.$row['id'].'>'. substr( $text1 ,0,100).'</a></div>"/></li>';	
}
else
{
$text1 = '<div class=\'bjqs-caption-banner text_style_banner \'><h2>'.$row['title'].'</h2>';	

echo '<li><img style="overflow:hidden;" src="'.$docRoot.'/admin/uploadbanner/server/php/files/banner985/' . $row['image2'].'" alt=""   title="<a href='.$docRoot.'/content/body_detail_full.php?id='.$row['id'].'>'. substr( $text1 ,0,100).'</a></div>"/></li>';	
	
}

	
}
else{
	

if ($page_widthbanner =='')
{
	
	
$text2 = '<div class=\'bjqs-caption text_style readmore\' ><h1>'.$row['title'].'</h1><p>'.$row['storyintro'];	

echo '<li><img style="overflow:hidden;" src="'.$docRoot.'/admin/upload/server/php/files/banner445/' . $row['image1'].'" alt=""  title="'. substr( $text2 ,0,400).'...<br/><a href='.$docRoot.'/content/body_detail.php?id='.$row['id'].'>Read more</a></p></div>"/></li>';

}
else
{
	
$text2 = '<div class=\'bjqs-caption text_style readmore\' ><h1>'.$row['title'].'</h1><p>'.$row['storyintro'];	

echo '<li><img style="overflow:hidden;" src="'.$docRoot.'/admin/upload/server/php/files/banner445/' . $row['image1'].'" alt=""  title="'. substr( $text2 ,0,400).'...<br/><a href='.$docRoot.'/content/body_detail_full.php?id='.$row['id'].'>Read more</a></p></div>"/></li>';	
	
}



}
}
?>
</ul>
<!-- end Basic jQuery Slider -->
</div>