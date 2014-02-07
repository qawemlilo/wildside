<?php
$image = $_GET['image'];

if (isset($image)) {
   echo $image;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
	<title>Crop 2.0.0</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<script type="text/javascript" src="js/mootools-for-crop.js"> </script>
	<script type="text/javascript" src="js/UvumiCrop-compressed.js"> </script>
	
	<link rel="stylesheet" type="text/css" media="screen" href="css/crop.css" />
	<style type="text/css">
		body,html{
			background-color:#333;
			margin:0;
			padding:0;
			font-family:Trebuchet MS, Helvetica, sans-serif;
		}
		
		hr{
			margin:20px 0;
		}
		
		#main{
			margin:5%;
			position:relative;
			overflow:auto;
			color:#aaa;
			padding:20px;
			border:1px solid #888;
			background-color:#000;
			text-align:center;
		}

		#resize_coords{
			width:300px;
		}
		
		#previewExample3{
			margin:10px;
		}

		.yellowSelection{
			border: 2px dotted #FFB82F;
		}

		.blueMask{
			background-color:#00f;
			cursor:pointer;
		}
	</style>
	    <script type="text/javascript" >
new uvumiCropper('myImage',{
maskOpicity:0.3,
maskClassName:'blueMask',
resizerClassName:'yellowSelection',
mini:{
x:455,
y:250
},
handles:[
['top','left'],
['top','right'],
['bottom','left'],
['bottom','right']
],
coordinates:true,
saveButton:true,
});
</script>
    
</head>
<body>
	<div id="main">
		<div>
			<p>
				Click mask: Move resizer to that position<br/>
				Shift + Resize: Keep current selection's aspect ratio if not enabled by default<br/>
				Doubleclick on resizer: Maximize selection
			</p>
			<p><? echo '<img id="myImage" src="http://www.wildsidesa.co.za/admin/upload/server/php/files/'. $image .'" alt="cropping test"/>'; ?>
				
			</p>
		</div>
	</div>
<? 
}
else
{ 
die ('Image cannot be found'); 
echo $image;
}

?>
</body>
</html>
