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
          <li class="active"><a href="#subscribe" style="min-height:60px;">REST OF WORLD</a></li>
          <li><a href="index.php">SUBS HOME</a></li>
          <li><a href="http://www.wildsidesa.co.za">HOME</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<div class="container" style="height:1200px;">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="col-xs-4 ">
</div>
      <div class="col-xs-6 ">
      
        <h1 style="font-size:100px;text-shadow:0 1px 0 #333;">WILDSIDE</h1>
        <h2 style="text-shadow:0 1px 0 #333;">Subscribe today to the <br/>magazine that takes you there.</h2>
        
        <p><br/>
          <a class="btn btn-outline btn-lg" href="https://www.payfast.co.za/eng/process?cmd=_paynow&receiver=rod%40wildsidesa.co.za&item_name=Wildside+Subscriptions+South+Africa&item_description=Wildside+Magazine+brings+you+the+best+in+Ecotravel%2C+Outdoor+Adventure+and+Conservation+in+Africa.%0D%0AWildside+is+a+quarterly+publication.+You+will+receive+4+editions+starting+from+the+next+published+edition+after+your+date+of+subscribing.&amount=99.00&return_url=http%3A%2F%2Fwww.wildsidesa.co.za%2Fsubscribe%2Fsuccess.php&cancel_url=http%3A%2F%2Fwww.wildsidesa.co.za%2Fsubscribe%2Fcancel.php" >SOUTH AFRICAN SUBSCRIBERS - Pay Fast</a>
        </p>
         
        <p><br/>
          <a class="btn btn-outline btn-lg" href="#subscribe" >REST OF WORLD - PAYPAL</a>
        </p>
        
        <p><br/>
          <a class="btn btn-outline btn-lg" href="http://www.magzter.com/ZA/Wildside-Publishing-cc/Wildside-Africa/Lifestyle/28048" >DIGITAL SUBSCRIPTIONS</a>
        </p>
        
      </div>
    </div>
    
    
<!-- SHOPPING CART SUBSCRIBE -->
     <div class="container" id="subscribe" style="margin-top:50px;"><br/><br/><br/></div> <!-- /container fw -->

     
     <div class="container-fw">
      <div class="container" style="padding-top:40px;">
       <div class="row">
      
         <div class="col-xs-5">
          <img class="img-thumbnail" name="" src="img/wildsidecoverwinter2013.jpg" alt="" width="400">
         </div>
      
<div class="col-xs-5">

<script src="simpleCart.js"></script>
<script>
    simpleCart({
		
    checkout: { 
    type: "SendForm" , 
    url: "subscriber.php",
    method: "POST" , 
    success: "success.php" , 
    cancel: "cancel.php"
        }
		
    }); 
	
	simpleCart({
  taxRate:0
});


simpleCart.currency({
    code: "USD" ,
    name: "US Dollar" ,
    symbol: "$ " ,
    delimiter: " " , 
    decimal: "," , 
    after: false ,
    accuracy: 2
});


	

</script>



	<div class="panel panel-default">
 	 <div class="panel-heading">
   		 <h3 class="panel-title">Wildside Magazine</h3>
 			 </div>
   
  	 	<div class="panel-body">
     
	 		<div class="simpleCart_shelfItem">
     		<h4 class="item_name"> Rest of World Subscriptions </h4>
            <p> Quarterly (Summer Autumn Winter Spring) </p>
     		<input type="hidden" value="1" class="item_Quantity">
     		<span class="item_price">$ 29.99</span><br><br>
	 		<a class="item_add btn btn-default btn-info" href="javascript:;"> Add to Cart </a>
			 </div>
     
    	 </div>
     

	<ul class="list-group">
    <li class="list-group-item">SubTotal: <span class="simpleCart_total"></span> </li>
    <li class="list-group-item">Tax Rate: <span class="taxRate">0</span></li>
    <li class="list-group-item">Tax: <span class="simpleCart_tax"></span></li>
    <li class="list-group-item">Shipping: <span class="simpleCart_shipping"></span> </li>
	</ul>
    
     <div class="panel-footer">
     
    <a href="javascript:;" class="simpleCart_empty btn btn-default btn-danger">empty cart</a>
     
     </div>
	
	

 
    </div>



</div>

 <div class="col-xs-2">
 
  <div class="btn-group-vertical pull-right">
   <div class="btn-group">
    <button type="button" class="btn btn-default btn-lg" >
      <span class="glyphicon glyphicon-shopping-cart"></span>   
      <span class="simpleCart_quantity"></span> items</button>
      </div>
  <button type="button" class="btn btn-default "><span class="simpleCart_total"></span> </button>
  <button type="button" class="btn btn-primary ">TOTAL</button>
  <button type="button" class="btn btn-default "><span class="simpleCart_grandTotal"></span> </button>
  <a href="javascript:;" class="simpleCart_checkout btn  btn-success">Check out</a>
  </div>
 </div>
 

</div>

      </div> <!-- /end row -->
     </div> <!-- /end container -->
    </div> <!-- /end container fw -->
    
    
 

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script>  
$(function ()  
{ $("#example").popover();  
});  
</script> 

  </body>
</html>
