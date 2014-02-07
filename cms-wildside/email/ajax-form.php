<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title>Ajax / PHP Form Example</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="This is an example form that uses Ajax to submit data, and PHP to retrieve it."/>
	<meta name="keywords" content="ajax, form, example, php" />
	<!-- JQUERY -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    
	<script type="text/javascript">
	// JQUERY: Plugin "autoSumbit"
	(function($) {
		$.fn.autoSubmit = function(options) {
			return $.each(this, function() {
				// VARIABLES: Input-specific
				var input = $(this);
				var column = input.attr('name');
	
				// VARIABLES: Form-specific
				var form = input.parents('form');
				var method = form.attr('method');
				var action = form.attr('action');

				// VARIABLES: Where to update in database
				var where_val = form.find('#where').val();
				var where_col = form.find('#where').attr('name');
	
				// ONBLUR: Dynamic value send through Ajax
				input.bind('blur', function(event) {
					// Get latest value
					var value = input.val();
					// AJAX: Send values
					$.ajax({
						url: action,
						type: method,
						data: {
							val: value,
							col: column,
							w_col: where_col,
							w_val: where_val
						},
						cache: false,
						timeout: 10000,
						success: function(data) {
							// Alert if update failed
							if (data) {
								alert(data);
							}
							// Load output into a P
							else {
								$('#notice').text('Updated');
								$('#notice').fadeOut().fadeIn();
							}
						}
					});
					// Prevent normal submission of form
					return false;
				})
			});
		}
	})(jQuery);
	// JQUERY: Run .autoSubmit() on all INPUT fields within form
	$(function(){
		$('#ajax-form INPUT').autoSubmit();
	});
	</script>
	<!-- STYLE -->
</head>
<body>
<div class="container">
<!-- CONTENT -->

<?php
define('INCLUDE_CHECK',true);

require '../connect.php';

?>

<?php

$var =  mysql_real_escape_string(@$_GET['v']) ;
$trimmed = trim($var); //trim whitespace from the stored variable


$result = mysql_query("SELECT * FROM w_people WHERE people_id
		 LIKE '".$trimmed."' ");
$row = mysql_fetch_assoc($result);
?>
<div class="span 6">
<form class="form-horizontal" id="ajax-form" class="autosubmit" method="POST" action="./ajax-update.php">
	<fieldset>
		<legend>Update User Record</legend>
<br/>
<div class="control-group">
<label class="control-label">First Name:</label>
<div class="controls">
<input type="text" name="name_first" value="<?php echo $row['name_first'] ?>" />
</div></div>
<div class="control-group">
<label class="control-label"> Surname Name:</label>
<div class="controls">
<input type="text" name="name_last" value="<?php echo $row['name_last'] ?>" />
</div></div>
<div class="control-group">
<label class="control-label">E-mail:</label>
<div class="controls">
<input type="text" name="email" value="<?php echo $row['email'] ?>" />
</div></div>

		<input id="where" type="hidden" name="people_id" value="<?php echo $row['people_id'] ?>" />
	</fieldset>
</form>
<p id="notice"></p>
</div>
</div>


    <script src="bootstrap/js/bootstrap.js"></script>
</body>
</html>