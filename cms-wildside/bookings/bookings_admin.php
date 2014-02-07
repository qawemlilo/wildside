<?php
define('INCLUDE_CHECK',true);

require '../connect.php';
require '../functions.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<?php
	include '../maststrip.php'; 
if($_SESSION['id'])
{
include '../menu.php'; 
?>

<h1>Wildside Mag - Bookings Admin</h1><hr/>


<?php
$query = "SELECT w_product_edition.edition, w_product_edition_dates.booking, w_product_edition_dates.material
FROM w_product_edition, w_product_edition_dates
WHERE  w_product_edition.edition_id = w_product_edition_dates.edition_id
	      ";
$result = mysql_query($query); 
while ($row = mysql_fetch_array($result)) 
{
	
$startDate = mktime();  	

if ($startDate < strtotime($row['booking']))
{	
echo '<div class="row">
<div class="span12"><h2>'.$row['edition'].'</h2></div>';

	
$endDate = strtotime(date($row['booking']));
$endDate1 = strtotime(date($row['material']));;

$interval = $endDate - $startDate;
$daysb = floor($interval / (60 * 60 * 24));

echo '<div class="span5"><div class="alert alert-error">';
echo '<h4>Booking Deadline: '. $row['booking'].'</h4>';
echo strftime("%a %d %B %Y", strtotime($row['booking'])).'<br/>
<h1 style="margin-bottom:-7px;">'. $daysb . '</h1>
<h4>days until booking deadline closes</h4> 
</div></div>';

$interval = $endDate1 - $startDate;
$daysm = floor($interval / (60 * 60 * 24));

echo '<div class="span5"><div class="alert alert-success" >';
echo '<h4>Material Deadline: '. $row['material'].'</h4>';
echo strftime("%a %d %B %Y", strtotime($row['material'])).'<br/>
<h1 style="margin-bottom:-7px;">'. $daysm . '</h1>
<h4>days until material deadline closes</h4> 
</div></div><div class="span12">';


// CREATE GRAND TOTAL
$querytotal = "SELECT SUM(w_orders.order_price_subtotal)
FROM w_orders 
WHERE  w_orders.edition LIKE '".$row['edition']."'
"; 
$resulttotal = mysql_query($querytotal) or die("Couldn't execute query");
while ($rowtotal= mysql_fetch_array($resulttotal))  
{
echo '<table class="table table-bordered"> ';
echo'<tr class="success">'; 		
echo'<td><strong>TOTAL TURNOVER</strong></td>';
echo'<td><strong>R '.number_format( $rowtotal[0] ,2, '.',' '). '</strong></td>';
echo '</tr>';
}

// PAGINATION ADVERTS RESULTS

$querypag="SELECT SUM(size) AS pagsum
FROM w_product_description, w_orders
WHERE product_id = w_orders.product_description_id 
AND w_orders.edition LIKE '".$row['edition']."'
";

$resultpag = mysql_query($querypag);
while ($rowpag = mysql_fetch_assoc($resultpag)) 
{
echo'<tr class="info">';
echo'<td ><strong>ADVERTISING TOTAL</strong></td>';
echo'<td><strong>'.$ads=($rowpag['pagsum']).' </strong>pages of adverts&nbsp;|&nbsp;<strong>'. $pageads= number_format((($rowpag['pagsum'] / 76) * 100),2, '.',' '). '</strong> % of <strong>76</strong> pager <strong>';
echo '</tr>';
}

// PAGINATION ADVERTORIAL RESULTS

$query="SELECT SUM(size) AS advertorialsum
FROM  w_product_advertorial, w_orders
WHERE product_id = w_orders.product_advertorial_id 
AND w_orders.edition LIKE '".$row['edition']."'
";

$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) 
{

echo'<tr class="warning">';
echo'<td ><strong>ADVERTORIAL TOTAL</strong></td>';


echo'<td><strong>'.$advertorial=($row['advertorialsum']).' </strong>pages of advertorial&nbsp;|&nbsp;<strong>'. $pageadvertorial= number_format((($row['advertorialsum'] / 76) * 100),2, '.',' '). '</strong> % of <strong>76</strong> pager <strong> ';
echo '</tr>';

}

$totalpages = number_format((($ads + $advertorial)),2, '.',' ');

echo'<tr class="alert alert-error">';
echo'<td><strong>TOTAL PAGINATION</strong></td>';
echo'<td><strong>' .$totalpages.' </strong>pages booked &nbsp;|&nbsp;<strong>'. $pagetotal= number_format((($totalpages / 76) * 100),2, '.',' '). '</strong> % of <strong>76</strong> pager <strong> ';
echo '</tr>';
echo '</table>';






echo '</div></div><hr/>';
}


}
?>




<?
}
else 

{
echo '<h2>&nbsp;&nbsp;Please, <a href="../home.php">login</a> and come back later!</h2>' ;
}
?>