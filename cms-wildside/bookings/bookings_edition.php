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
if (!isset($_POST['submit']) || !$_POST['submit'])
{
?>
<?php
$query = "SELECT DISTINCT edition FROM w_orders 
		  ORDER by order_date DESC
	      ";
$result = mysql_query($query);
$options = "";
while ($row = mysql_fetch_array($result)) 
{
    $id=$row["edition"]; 
    $options.="<OPTION VALUE=\"$id\">".$id. '</option>';
}
?>
<h2>Bookings by Edition</h2>
<div class="row">
<div class="span12">

<div class="row">
<div class="span8">
<form class="form-inline" name="form" action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="get"  >
<select name="q" class="myInput" style="font-size:14px;">        
<?=$options?>                 
</select>
<label class="checkbox inline">
  <input type="checkbox" name="ord" value="w_company.company_name"> Company Name
</label>

<label class="checkbox inline">
  <input type="checkbox" name="ord" value="w_orders.feature"> Feature Area
</label>

<label class="checkbox inline">
  <input type="checkbox" name="ord" value="w_orders.agent"> Agent   
</label>


<button type="submit" class="btn">  Search</button>
</form>
</div></div>

<?php

// Get the search variable from URL
$var = @$_GET['q'] ;
$trimmed = mysql_real_escape_string(trim($var)); //trim whitespace from the stored variable

// filter
$var_ord = @$_GET['ord'] ;
$trimmed_ord = mysql_real_escape_string(trim($var_ord)); //trim whitespace from the stored variable


// rows to return
$limit=50; 

// check for an empty string and display a message.
if ($trimmed == "")
  {
  echo "<p>Please enter a search...</p>";
  exit;
  }
  
  // check for an empty string and display a message.
if ($trimmed_ord == "")
  {
  echo "<p>Please Filter your list...</p>";
  exit;
  }

// check for a search parameter
if (!isset($var))
  {
  echo "<p>We dont seem to have a search parameter!</p>";
  exit;
  }

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

//If($linksearch!=='')


// Build SQL Query  
$query = "SELECT w_orders.company_id AS ID, w_orders.order_id  AS INVOICE, w_company.company_name AS COMPANY, w_orders.edition AS EDITION,  w_orders.product_description_id AS SIZE , w_orders.order_price_subtotal AS PRICEXVAT, w_orders.order_mat_placed AS STUDIO, w_orders.agent AS AGENT, w_orders.feature AS Feature 
FROM w_orders,w_company 
WHERE  w_orders.company_id =  w_company.company_id AND w_orders.edition LIKE '".$trimmed."%'
ORDER BY $trimmed_ord ASC
"; 
$numresults=mysql_query($query) ;
$numrows=mysql_num_rows($numresults);


// If we have no results, offer a google search as an alternative

if ($numrows == 0)

  {
 
  }

$s= @$_GET['s'];

// next determine if s has been passed to script, if not use 0
  if (empty($s)) {
  $s=0;
  }

// get results
  $query .= " 
  limit $s, $limit";
  
  $result = mysql_query($query) or die("Couldn't execute query");


// display what the person searched for
echo '<h3><span style="color:#008FE7;">' . $var."&nbsp;</span> has " . $numrows. " bookings</h3>";
echo '</div></div>';

// EDIT HERE and specify your table and field names for the SQL query
echo '<table class="table table-condensed"> ';
echo'<thead>';
echo'<tr>';
echo'<th>' . ucwords(mysql_field_name($result, 1)). '</th>';
echo'<th>' . ucwords( mysql_field_name($result, 2)) . '</th>';
echo'<th>' . ucwords( mysql_field_name($result, 3)) . '</th>';
echo'<th>' . ucwords( mysql_field_name($result, 8)) . '</th>';
echo'<th>' . ucwords(mysql_field_name($result, 4)). '</th>';
echo'<th style=\"text-align: right;\">' . ucwords(mysql_field_name($result, 5)). '</th>';
echo'<th>'. ucwords(mysql_field_name($result, 7)).'</th>';
echo'<th></th>';
echo'<th></th>';
echo'</tr>';
echo'</thead>';



echo'<tbody>';

// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
while ($row= mysql_fetch_array($result)) 

{
	
$querysize = "SELECT size FROM w_product_description
WHERE  product_id = ".$row[4]."
"; 
$result_size=mysql_query($querysize) ;
$row_size=mysql_fetch_array($result_size);	



echo'<tr>';
echo'<td >'. $row[1]. '</td>';
echo'<td >' . $row[2] . '</td>';
echo'<td >' . $row[3] . '</td>';
echo'<td >' . $row[8] . '</td>';
echo'<td >'. $row_size['size'].'</td>';
echo'<td  style="text-align: right">R '.number_format( $row[5] ,2, '.',' '). '</td>';
echo'<td >' . $row[7] . '</td>';
echo '<td  align="right"><a href="bookingsdisplayplain.php?id='.$row[1].'"</a><i class="icon-print"></i>
  </td>';
echo '<td  align="right"><a href="bookingupdate_simple.php?id='.$row[1].'"</a><i class="icon-edit"></i></td>';
echo'</tr>';



$count++; 


} 

echo'</tbody>';
echo '</table>';



// CREATE GRAND TOTAL
$query = "SELECT SUM(w_orders.order_price_subtotal)
FROM w_orders,w_company 
WHERE  w_orders.company_id = w_company.company_id AND w_orders.edition LIKE '".$trimmed."%'
GROUP BY w_orders.edition 
"; 

$numresults=mysql_query($query) ;
$numrows=mysql_num_rows($numresults);
$result = mysql_query($query) or die("Couldn't execute query");
while ($row= mysql_fetch_array($result))  
{
echo '<table class="table table-bordered"> ';
echo'<tr class="success">'; 		
echo'<td><strong>TOTAL TURNOVER</strong></td>';
echo'<td><strong>R '.number_format( $row[0] ,2, '.',' '). '</strong></td>';
echo '</tr>';
}

// PAGINATION ADVERTS RESULTS

$query="SELECT SUM(size) AS pagsum
FROM w_product_description, w_orders
WHERE product_id = w_orders.product_description_id 
AND w_orders.edition LIKE '".$trimmed."%'
";

$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) 
{
echo'<tr class="info">';
echo'<td ><strong>ADVERTISING TOTAL</strong></td>';
echo'<td><strong>'.$ads=($row['pagsum']).' </strong>pages of adverts&nbsp;|&nbsp;<strong>'. $pageads= number_format((($row['pagsum'] / 76) * 100),2, '.',' '). '</strong> % of <strong>76</strong> pager <strong>';
echo '</tr>';
}

// PAGINATION ADVERTORIAL RESULTS

$query="SELECT SUM(size) AS advertorialsum
FROM  w_product_advertorial, w_orders
WHERE product_id = w_orders.product_advertorial_id 
AND w_orders.edition LIKE '".$trimmed."%'
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



$currPage = (($s/$limit) + 1);

//break before paging
echo "<br />";

echo "<p>";

  // next we need to do the links to other results
  if ($s>=1) { // bypass PREV link if s is 0
  $prevs=($s-$limit);
  print "&nbsp;<a href=\"$PHP_SELF?s=$prevs&q=$var\">&lt;&lt; 
  Prev" . $limit . "</a>&nbsp&nbsp;";
  }

// calculate number of pages needing links
  $pages=intval($numrows/$limit);

// $pages now contains int of pages needed unless there is a remainder from division

  if ($numrows%$limit) {
  // has remainder so add one page
  $pages++;
  }

// check to see if last page
  if (!((($s+$limit)/$limit)==$pages) && $pages!=1) {

  // not last page so give NEXT link
  $news=$s+$limit;

  echo '<a href='.$PHP_SELF.'?s='.$news.'&q='.$var.'>Next >>'. $limit .'</a>';
  }
  
echo '</p>';

$a = $s + ($limit) ;
  if ($a > $numrows) { $a = $numrows ; }
  $b = $s + 1 ;
  echo "<p>Showing results $b to $a of $numrows</p>";
  
  
}
}
	   
else 

{
echo '<h2>&nbsp;&nbsp;Please, <a href="../home.php">login</a> and come back later!</h2>' ;
}
?>

</div>


</body>
</html>
