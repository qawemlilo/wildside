<?php
define('INCLUDE_CHECK',true);
require_once 'connect.php';
require 'functions.php';
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
    <title>Wildside</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../favicon.ico">

  </head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">

<?php include("navbar.html"); ?>    


<div class="container_14">     
  <!-- Header logo
================================================== -->      
<div class="container_960">    
<div class="span12">   
<img src="img/wildside_logo.png" />  
</div>     
</div>  
  
   
    
 <!-- Menu
================================================== -->   
<div class="container_960">    
<div class="span12">
   <? include('menu.php');?> 
</div>    
</div>    
    



<!-- Container
================================================== -->
<div class="container">



<!--Body_detail
================================================== -->
<div class="row"> 
<div class="span8">
<?php $_POST['id']; ?>

<?php 
define('INCLUDE_CHECK',true);
require 'connect.php';
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
?>

<?php
if (isset($_POST['Submit'])) {

 $visitor_category = $_POST['visitor_category'];
 $full_name = mysql_real_escape_string($_POST['full_name']);
 $cell = mysql_real_escape_string($_POST['cell']);
 $visitor_activity = mysql_real_escape_string($_POST['visitor_activity']);
 $visitor_place = mysql_real_escape_string($_POST['visitor_place']);
 $comp_name = mysql_real_escape_string($_POST['comp_name']);
 $comp_answer = mysql_real_escape_string($_POST['comp_answer']);
 $email = mysql_real_escape_string($_POST['email']);
 $cell = mysql_real_escape_string($_POST['cell']);
 $subscribe = mysql_real_escape_string($_POST['subscribe']);
 

//define the sender name of the email 
$full_name = $full_name; 
//define the receiver of the email 
$to = $email; 
//define the subject of the email 
$subject = 'Wildside Competition Entry'; 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash 
$random_hash = md5(date('r', time())); 
//define the headers we want passed. Note that they are separated with \r\n 
$headers = "From: info@wildsidesa.co.za\r\nReply-To: info@wildsidesa.co.za"; 
//add boundary string and mime type specification 
$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 
//read the atachment file contents into a string,
//encode it with MIME base64,
//and split it into smaller chunks
//define the body of the message. 
ob_start(); //Turn on output buffering 
?> 
--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>" 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<!-- HTML here -->

<?php include("http://www.wildsidesa.co.za/content/email/2012/airmail/html/wildsidewarrior_comp.html"); ?>
        
<!-- HTML End -->       

--PHP-alt-<?php echo $random_hash; ?>-- 

--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: name="attachment.jpg"  
Content-Transfer-Encoding: base64  
Content-Disposition: attachment  

<?php echo $attachment; ?> 
--PHP-mixed-<?php echo $random_hash; ?>-- 

<!-- Do mysql ----------------------------------------------------------->   

<?php
$query = " INSERT INTO lig_wildside.w_webvisitor (visitor_category, full_name, cell, visitor_activity, visitor_place, comp_name, comp_answer, email, subscribe, date_entered) VALUES ('$visitor_category', '$full_name', '$cell', '$visitor_activity', '$visitor_place', '$comp_name', '$comp_answer','$email', '$subscribe', 'NOW()')" ;
$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;
mysql_close($connection);
?>
<!-- endmysql ----------------------------------------------------------->  




<?php 
//copy current buffer contents into $message variable and delete current output buffer 
$message = ob_get_clean(); 
//send the email 
$mail_sent = @mail( $to, $subject, $message, $headers ); 
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
?>
<div class='container'>
<?php echo $mail_sent ? '

<div class="span5"> 
<br/><br/><br/>
<form id="contactus">
<fieldset >
<legend><h2>Thank You</h2>
<p>Your entry has been recorded</p></legend>
</fieldset >
</form>
</div>


' : "Mail failed"; ?>
</div>
<?php
}
?>

<?php 
if (!$_POST ['Submit'])
{
?>
<!--------------------------FORM --------------------------------------->


<br/><br/>
<form  id='contactus' action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>

<legend>Wildside Competitions</legend> 
<h2 style="margin-left:-15px;"><?php echo $_GET['comp_name']; ?></h2>
<input type='hidden' name='comp_name' id='comp_name' value='<?php echo $_GET['comp_name']; ?>'/>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='subscribe' id='subcribe' value='yes'/>
<input type='hidden' name='visitor_category' id='visitor_category' value='competition'/>
<div class='short_explanation'>* required fields</div>
<br/>

<label for='Comp Answer' >Your Answer</label>
<input type='text' name='comp_answer' id='comp_answer' value='' maxlength="50"  placeholder="Your Answer"/>
<span class="help-block"></span>
<label for='name' >Your Full Name*: </label>
<input type='text' name='full_name' id='full_name' value='' maxlength="50" placeholder="Full Name" />

<span class="help-block"></span>

<label for='email' >Email Address*:</label>
<input type='text' name='email' id='email' value='' maxlength="50" placeholder="Email" />
<span class="help-block"></span>

<label for='cell' >Cell:</label>
<input type='text' name='cell' id='cell' value='' maxlength="50" placeholder="Cell" />
<span class="help-block"></span>
<label for='What is your favourite place to visit' >What is your favourite place to visit:</label>
<input type='text' name='visitor_place' id='visitor_place' value='' maxlength="50" placeholder="Favourite place" />
<span class="help-block"></span>
<label for='What is your outdoor activity' >What is your favourite outdoor activity:</label>
<input type='text' name='visitor_activity' id='visitor_activity' value='' maxlength="50" placeholder="Favourite activity" />

<span class="help-block"></span>
<button type='submit' name='Submit' value='Submit' class="btn">Submit</button>


</form>	

<?php
}
?>




</div>


<!-- Sidebar
================================================== -->
<div class="span4"> 
<?php include("http://www.wildsidesa.co.za/content/sidebar.php"); ?>
<br/>
<div>
<?php include("http://www.wildsidesa.co.za/shop/sponsorship.html"); ?>
</div>
</div>

<!-- End Rowr --></div>













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
    <script src="assets/js/jquery.js"></script>
    <script src="assets/slider/js/bjqs-1.3.js"></script>
    <script src="assets/js/google-code-prettify/prettify.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script src="assets/js/bootstrap-affix.js"></script>
    <script src="assets/js/application.js"></script>
    
     <!--  Attach the plug-in to the slider parent element and adjust the settings as required -->
    <script>
      $(document).ready(function() {
        
        $('#banner').bjqs({
          'animation' : 'fade',
          'width' : 980,
          'height' : 250,
		  'useCaptions' : true,
          'keyboardNav' : true,
		  'nexttext' : '<img src="assets/slider/img/forward.png" width="61px" height="50px" /> ', // Text for 'next' button (can use HTML)
          'prevtext' : '<img src="assets/slider/img/back.png" width="61px" height="50px" />', // Text for 'previous' button (can use HTML)
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