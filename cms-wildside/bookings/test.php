<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CMS</title>

<link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>

<div class="container">

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
 <li class="active"><a href="#tab1" data-toggle="tab">BOOKINGS</a></li>
    <li><a href="#tab2" data-toggle="tab">ADD RECORDS</a></li>
    <li><a href="#tab3" data-toggle="tab">SEARCH</a></li>
    <li><a href="#tab4" data-toggle="tab">STUDIO</a></li>
	<li><a href="#tab5" data-toggle="tab">REPORTS</a></li>
    <li><a href="#tab6" data-toggle="tab">SUBSCRIBERS</a></li>
    <li><a href="#tab7" data-toggle="tab">HOME</a></li>
  </ul>
 
  <div class="tab-content">
  
    <div class="tab-pane active" id="tab1">
        <a href="../bookings/bookings_edition.php?q=WS 1 of 4 April 2012&Submit=Search">WS 1 of 4 April 2012</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition.php?q=WS 2 of 4 July 2012&Submit=Search">WS 2 of 4 July 2012</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition.php?q=WS 3 of 4 October 2012&Submit=Search">WS 3 of 4 October 2012</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition.php?q=WS 4 of 4 December 2012&Submit=Search">WS 4 of 4 December 2012</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
    </div>
    
    <div class="tab-pane" id="tab2">
      	<a href="../search/addcompany.php">ADD Company</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../search/addpeople.php">ADD Contact Person</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../search/addpeoplebilling.php">ADD Billing Person</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookingadd.php">ADD A NEW BOOKING</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
    </div>
    
     <div class="tab-pane" id="tab3">
   	    <a href="../search/listingcompany.php">Company</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../search/listingpeople.php">People</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
    </div>
    
     <div class="tab-pane" id="tab4">
      	<a href="../bookings/bookings_edition_studio.php?q=WS 1 of 4 April 2012&Submit=Search">WS 1 of 4 April 2012</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition_studio.php?q=WS 2 of 4 July 2012&Submit=Search">WS 2 of 4 July 2012</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition_studio.php?q=WS 3 of 4 October 2012&Submit=Search">WS 3 of 4 October 2012</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition_studio.php?q=WS 4 of 4 December 2012&Submit=Search">WS 4 of 4 December 2012</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
    </div>
    
     <div class="tab-pane" id="tab5">
      	<a href="../reports/report_totalscustomer.php?q=%">Company Turnover </a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../reports/report_edition.php">Edition Turnover</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
    </div>
    
     <div class="tab-pane" id="tab6">
		<a href="../subscribers/subscribers.php?q=%">Show Subscribers </a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../subscribers/subscribers_add.php">Add a new Subscriber</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
	</div>
    
     <div class="tab-pane" id="tab7">
		<a href="../home.php">HOME</a>
	</div>
    
    
  </div>
</div>


</div>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="../css/bootstrap/js/bootstrap.js"></script>

</body>
</html>