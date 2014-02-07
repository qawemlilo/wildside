<?php
define('INCLUDE_CHECK',true);

require 'connect.php';
require 'function.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
include 'maststrip.php'; 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>people</title>
<style type="text/css"> @import url("css.css"); </style>
<link rel="stylesheet" type="text/css" media="screen"  href="jscalendar/calendar-system.css"> 
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/calendar-en.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
</head>
<body>
<div class="content">
<h1 style="padding-bottom:25px;">Upoad a Picture</h1>
<?php
if($_SESSION['id'])
{


/**
* Smart Image Uploader by @cafewebmaster.com
* Free for private use
* Please support us with donations or backlink
*/


$upload_image_limit = 5; // How many images you want to upload at once?
$upload_dir			= "../content/img/upload/"; // default script location, use relative or absolute path
$enable_thumbnails	= 1 ; // set 0 to disable thumbnail creation
$max_image_size		= 2024000 ; // max image size in bytes, default 1MB


##################### THUMBNAIL CREATER FROM GIF / JPG / PNG
	
function make_thumbnails($updir, $img){

	$thumbnail_width	= 200;
	$thumbnail_height	= 200;
	$thumb_preword		= "thumb_";
	$percent = 0.40;

	$arr_image_details	= GetImageSize("$updir"."$img");
	$original_width		= $arr_image_details[0];
	$original_height	= $arr_image_details[1];


		$new_width	= $original_width * $percent;
		$new_height	= $original_height * $percent;
	




	if($arr_image_details[2]==1) { $imgt = "ImageGIF"; $imgcreatefrom = "ImageCreateFromGIF";  }
	if($arr_image_details[2]==2) { $imgt = "ImageJPEG"; $imgcreatefrom = "ImageCreateFromJPEG";  }
	if($arr_image_details[2]==3) { $imgt = "ImagePNG"; $imgcreatefrom = "ImageCreateFromPNG";  }


	if( $imgt ) { 
		$old_image	= $imgcreatefrom("$updir"."$img");
		$new_image	= imagecreatetruecolor($new_width, $new_height);

		imageCopyResized($new_image,$old_image, 0,0,0,0, $new_width,$new_height,$original_width,$original_height);
		$imgt($new_image,"$updir"."$thumb_preword"."$img");
	}

}








################################# UPLOAD IMAGES
	
		foreach($_FILES as $k => $v){ 

			$img_type = "";

			### $htmo .= "$k => $v<hr />"; 	### print_r($_FILES);

			if( !$_FILES[$k]['error'] && preg_match("#^image/#i", $_FILES[$k]['type']) && $_FILES[$k]['size'] < $max_image_size ){

				$img_type = ($_FILES[$k]['type'] == "image/jpeg") ? ".jpg" : $img_type ;
				$img_type = ($_FILES[$k]['type'] == "image/gif") ? ".gif" : $img_type ;
				$img_type = ($_FILES[$k]['type'] == "image/png") ? ".png" : $img_type ;

				$img_rname = $_FILES[$k]['name'];
				$img_path = $upload_dir.$img_rname;

				copy( $_FILES[$k]['tmp_name'], $img_path ); 
				if($enable_thumbnails) make_thumbnails($upload_dir, $img_rname);
				$feedback .= "Image and thumbnail created $img_rname<br />";
				
define('INCLUDE_CHECK',true);
require_once '../admin/connect.php';
require '../admin/functions.php';

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
$queryimage = " INSERT INTO w_my_images (image_name, thumb)
VALUES ('$img_rname', 'thumb_$img_rname')";
$resultimage = mysql_query ($queryimage) or die('Error in query: $query. ' . mysql_error() ) ;


			}
		}






############################### HTML FORM
	while($i++ < $upload_image_limit){
		$form_img .= '<label>Image '.$i.': </label> <input type="file" name="uplimg'.$i.'"><br />';
	}

	$htmo .= '
		<p>'.$feedback.'</p>
		<form method="post" enctype="multipart/form-data">
			'.$form_img.' <br />
			<input type="submit" value="Upload Images!" style="margin-left: 50px;" />
		</form>
		';	

	echo $htmo;



}
?>
</div>
</body>
</html>
