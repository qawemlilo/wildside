<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Wildside Subscriptions</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/bootstrap-theme.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
    
    
    <script type="text/javascript">
/**
  * Basic jQuery Validation Form Demo Code
  * Copyright Sam Deering 2012
  * Licence: http://www.jquery4u.com/license/
  */
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#register-form").validate({
                rules: {
                    delivery_firstname: "required",
                    delivery_lastname: "required",
					delivery_street_address: "required",
					tel: "required",
					delivery_suburb: "required",
					delivery_city: "required",
					delivery_postcode: "required",
					delivery_state: "required",
					delivery_country: "required",
					
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    agree: "required"
                },
                messages: {
                    delivery_firstname: "Please enter your firstname",
                    delivery_lastname: "Please enter your lastname",
					tel: "Please enter your telephone or cellphone",
					delivery_street_address: "Please enter your 1st street address",
					delivery_suburb: "Please enter your 2nd streetaddress",
					delivery_city: "Please enter your city or town",
					delivery_postcode: "Please enter your postal code",
					delivery_state: "Please enter your province or state",
					delivery_country: "Please enter your country",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    email: "Please enter a valid email address",
                    agree: "Please accept our policy"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script>

    
    
  </head>
  
  

<body class="bs-docs-home" data-spy="scroll" data-offset="50" data-target="#navbar">
  
  
 <!-- Background Image -->
 <div class="container-fluid">
 <div class="row-fluid">
 <div class="bg-holder" style='background:url(http://www.wildsidesa.co.za/subscribe/img/wildsidecover.jpg); background-size: cover;  background-repeat:no-repeat; min-height:760px;'>
                 
 </div>
 </div>
 </div>  
  
  

<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top bs-docs-nav" id="navbar">
      <div class="container navbar_style">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="font-size:18px;"><img name="" src="http://www.wildsidesa.co.za/subscribe/img/africa.png" width="40"  alt="" style="margin-top:-14px;"> <strong>  WILDSIDE</strong> MAGAZINE</a>
        </div>
        <div class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right" style="min-height:60px;">
          <li class="active"><a href="#subscribe" style="min-height:60px;">PLEASE ENTER YOUR ADDRESS DETAILS</a></li>
          <li><a href="index.php">HOME</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    

<div class="container" style="height:1200px;">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="col-xs-4 ">
	  </div>
      
      <div class="col-xs-6 ">
      
      <script src="simpleCart.js"></script>


<?php
  $to = 'rod@lightship.co.za';
  $subject = 'Simple Cart Order';
  $content = $_POST;
  $body = '';
  for($i=1; $i < $content['itemCount'] + 1; $i++) {
  $name = 'item_name_'.$i;
  $quantity =  'item_quantity_'.$i;
  $price = 'item_price_'.$i;
  $body .= 'item #'.$i.': ';
  $body .= $content[$name].' '.$content[$quantity].' '.$content[$price];
  }
  ?>
     

      <?php include 'subscriber_details.php' ; ?>


       
       
      </div>
      
</div>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="simpleCart.js" </script>

  </body>
</html>
