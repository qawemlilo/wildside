<!DOCTYPE html>
<html>
<head>
<title> SimpleModal Contact Form </title>
<meta name='author' content='Eric Martin' />
<meta name='copyright' content='2010 - Eric Martin' />

<!-- Page styles -->
<link type='text/css' href='css/demo.css' rel='stylesheet' media='screen' />

<!-- Contact Form CSS files -->
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />

<!-- JS files are loaded at the bottom of the page -->
</head>
<body>
<div id='container'>
	<div id='logo'>
		<h1>Simple<span>Modal</span></h1>
		<span class='title'>A Modal Dialog Framework Plugin for jQuery</span>
        <?php $title = 'book giveaway'; ?>
	</div>
	<div id='content'>
		<div id='contact-form'>
			<input type='button' name='contact' value='Demo' class='contact demo'/> or <a href='#' class='contact'>Demo</a>
		</div>
		<!-- preload the images -->
		<div style='display:none'>
			<img src='img/contact/loading.gif' alt='' />
		</div>
	</div>
	<div id='footer'>
		&copy; 2010 Eric Martin | <a href='http://www.ericmmartin.com/'>ericmmartin.com</a> | <a href='http://twitter.com/ericmmartin'>@ericmmartin</a> | <a href='http://twitter.com/simplemodal'>@simplemodal</a>
	</div>
</div>
<!-- Load JavaScript files -->
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/contact.js'></script>
</body>
</html>