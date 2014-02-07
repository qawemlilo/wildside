<div class="container">
<div class="container">
<h1>hello</h1>
</div>
<div class="tabbable"> <!-- Only required for left/right tabs -->
<div class="navbar">
  <div class="navbar-inner">
  <ul class="nav">
 <li><a href="#tab1" data-toggle="tab" style="font-size:13px;">SEARCH</a></li>
    <li><a href="#tab2" data-toggle="tab" style="font-size:13px;">ADD RECORDS</a></li>
    <li><a href="#tab3" data-toggle="tab" style="font-size:13px;">BOOKINGS</a></li>
    <li><a href="#tab4" data-toggle="tab" style="font-size:13px;">STUDIO</a></li>
	<li><a href="#tab5" data-toggle="tab" style="font-size:13px;">REPORTS</a></li>
    <li><a href="#tab6" data-toggle="tab" style="font-size:13px;">SUBSCRIBERS</a></li>
    <li><a href="#tab7" data-toggle="tab" style="font-size:13px;">HOME</a></li>
  </ul>
  </div>
  </div>
<div class="tab-content" style="font-size:13px;">
<div class="tab-pane" id="tab1">
    <div class="span5">
    <form class="form-inline" id="quick-search" action="/cms-wildside/search/listingcompany.php" method="get" >
<input class="span3"  id="qsearch" type="text" name="q" onKeyUp="liveSearch()" />
  <button class="btn" type="submit">Company Search</button>
</form>
<ul id="searchResults" class="nav nav-tabs nav-stacked"></ul>
</div>
   <div class="span5 offset1" >
<form class="form-inline" id="quick-search" action="/cms-wildside/search/listingpeople.php" method="get" >
<input class="span3"  id="qsearch1" type="text" name="q" onKeyUp="liveSearch1()" />
  <button class="btn" type="submit">People Search</button>
</form>
<ul id="searchResults1" class="nav nav-tabs nav-stacked"></ul>
</div>
</div>
    
    <div class="tab-pane" id="tab2">
      	<a href="../search/addcompany.php">ADD Company</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../search/addpeople.php">ADD Contact Person</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../search/addpeoplebilling.php">ADD Billing Person</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
    </div>
    
     <div class="tab-pane" id="tab3">
      <a href="../bookings/bookings_edition.php?q=WS 1 of 4 April 2014&Submit=Search&ord=w_orders.feature">WS 1 of 4 April 2014</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition.php?q=WS 2 of 4 July 2014&Submit=Search&ord=w_orders.feature">WS 2 of 4 July 2014</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition.php?q=WS 3 of 4 October 2014&Submit=Search&ord=w_orders.feature">WS 3 of 4 October 2014</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition.php?q=WS 4 of 4 December 2014&Submit=Search&ord=w_orders.feature">WS 4 of 4 December 2014</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookingadd.php">ADD A NEW BOOKING</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
    </div>
    
     <div class="tab-pane" id="tab4">
      <a href="../bookings/bookings_edition_studio.php?q=WS 1 of 4 April 2014&Submit=Search">WS 1 of 4 April 2014</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition_studio.php?q=WS 2 of 4 July 2014&Submit=Search">WS 2 of 4 July 2014</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition_studio.php?q=WS 3 of 4 October 2014&Submit=Search">WS 3 of 4 October 2014</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
        <a href="../bookings/bookings_edition_studio.php?q=WS 4 of 4 December 2014&Submit=Search">WS 4 of 4 December 2014</a>&nbsp;&nbsp;<span style="color:#b1dbfc;">|</span>&nbsp;&nbsp;
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