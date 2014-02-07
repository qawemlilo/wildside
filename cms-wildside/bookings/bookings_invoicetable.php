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

<div class="containerdb">
<table width="925" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="34%" valign="middle"><h2>Bookings by Edition</h2></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr class="cellnorghtborderblue" style="text-align: right;">
<td width="60%"></td>
<td>
<?php
$query = "SELECT DISTINCT edition FROM w_orders 
		 ORDER by order_date DESC
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 
{
    $id=$row["edition"]; 
    $options.="<OPTION VALUE=\"$id\">".$id. '</option>';
}
?>
<form name="form" action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="get"  style="vertical-align:middle; ">
<select name="q" class="myInput" style="font-size:14px;">        
<?=$options?>                 
</select>
<input name="Submit" type="submit" class="myButton" value="Search" style="font-size:11px; padding:3px 6px 5px 6px;"/>
</form> 
</td>
</tr>
</table>
<?php


  // Get the search variable from URL
  

  $var = @$_GET['q'] ;
  $trimmed = trim($var); //trim whitespace from the stored variable

// rows to return
$limit=50; 

// check for an empty string and display a message.
if ($trimmed == "")
  {
  echo "<p>Please enter a search...</p>";
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

If($linksearch!=='')


// Build SQL Query  

$query = "SELECT w_orders.company_id, w_orders.order_id, w_company.company_name, w_orders.edition,  w_orders.product_description, w_orders.order_price_subtotal, w_orders.product_advertorial, w_orders.total, w_orders.vat_total, w_orders.agency_id
FROM w_orders,w_company 
WHERE  w_orders.company_id =  w_company.company_id AND w_orders.edition LIKE '".$trimmed."%'
ORDER BY w_company.company_name 
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


?>

<table width="80%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>Order_id</td>
    <td>Edition</td>
    <td>Company_Name</td>
    <td>Authorisation</td>
    <td>Tel/Fax</td>
    <td>Email</td>
    <td>product description</td>
    <td>Order price sub total</td>
    <td>Vat</td>
    <td>Total</td>
  </tr>

<?php

// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
while ($row= mysql_fetch_array($result)) 

{
?>

<tr>
<td  valign="top"><?php echo $row['order_id']; ?></td>
<td  valign="top"><?php echo $row['edition']; ?></td>
<td  valign="top">
    
    <?php $callid = $row['company_id'];

$query1 = " SELECT * FROM w_company WHERE w_company.company_id ='$callid'" ;
$result1 = mysql_query ($query1) or die('Error in query: $query. ' . mysql_error() ) ;
$rowcompany = mysql_fetch_array ($result1);
?>	

<?php
if ($row['agency_id'] == '0')
{
$query2 = " SELECT * FROM w_people WHERE w_people.company_id ='$callid'" ;
$result2 = mysql_query ($query2) or die('Error in query: $query. ' . mysql_error() ) ;
$rowpeople = mysql_fetch_array ($result2);
}
else
{
$query2 = " SELECT * FROM w_people WHERE w_people.company_id ='$agencyyes'" ;
$result2 = mysql_query ($query2) or die('Error in query: $query. ' . mysql_error() ) ;
$rowpeople = mysql_fetch_array ($result2);
}
?>
	
	
	<?php if ($row['agency_id'] == '0') 
	
	{ 
	
	echo $row['company_name']. '</br>';
	 echo $rowpeople['name_first'].' '.$rowpeople['name_last'] . '</br>';
    
	if( $rowcompany['b_address_1'] =='') { } else { echo $rowcompany['b_address_1'].'</br>';}
	if( $rowcompany['b_address_2'] =='') { } else { echo $rowcompany['b_address_2'].'</br>';}
	if( $rowcompany['b_city_town_area'] =='') { } else { echo $rowcompany['b_city_town_area'].'</br>';}
	if( $rowcompany['b_province_state'] =='') { } else { echo $rowcompany['b_province_state'].'</br>';}
	if( $rowcompany['b_postalcode'] =='') { } else { echo $rowcompany['b_postalcode'].'</br>';}
	if( $rowcompany['b_country'] =='') { } else { echo $rowcompany['b_country'].'</br>';}
	if( $rowcompany['vat'] =='') { } else { echo 'Vat: ' . $rowcompany['vat'];}
 
	} 
	else  
	
	{ 
	
	echo $rowagency['company_name']. '</br>';
    echo $rowpeople['name_first'].' '.$rowpeople['name_last'] . '</br>';
	if( $rowagency['b_address_1'] =='') { } else { echo $rowagency['b_address_1'].'</br>';}
	if( $rowagency['b_address_2'] =='') { } else { echo $rowagency['b_address_2'].'</br>';}
	if( $rowagency['b_city_town_area'] =='') { } else { echo $rowagency['b_city_town_area'].'</br>';}
	if( $rowagency['b_province_state'] =='') { } else { echo $rowagency['b_province_state'].'</br>';}
	if( $rowagency['b_postalcode'] =='') { } else { echo $rowagency['b_postalcode'].'</br>';}
	if( $rowagency['b_country'] =='') { } else { echo $rowagency['b_country'].'</br>';}
	if( $rowcompany['vat'] =='') { } else { echo 'Vat: ' . $rowcompany['vat'];}
	
	
	
	} 
	?> </td>
    <td  valign="top"><?php echo $rowpeople['name_first'].' '.$rowpeople['name_last'] ?>
    <? if( $row['ci_number'] =='') { } else { echo 'Number: '. $row['ci_number'];} ?></br>
    </td>
    <td  valign="top">
	<?
    if( $rowpeople['b_tel'] =='') { } else { echo 'Tel: '. $rowpeople['b_tel'].'</br>';}
	if( $rowpeople['b_fax'] =='') { } else { echo 'Fax: '. $rowpeople['b_fax'].'</br>';}
	if( $rowpeople['b_cell'] =='') { } else { echo 'Cell: '. $rowpeople['b_cell'].'</br>';}
    ?>
    </td>
    <td  valign="top">
	<?
    if( $rowpeople['b_email'] =='') { } else { echo $rowpeople['b_email'].'</br>';}
    ?>
    </td>
    
    <td  valign="top"><?php echo $row['product_description']; ?></br><?php echo $row['product_advertorial']; ?></td>
    <td  valign="top"><?php echo $row['order_price_subtotal']; ?></td>
    <td  valign="top"><? echo number_format($row['vat_total'], 2, '.',' ') ?></td>
    <td  valign="top"><?php echo $row['total']; ?></td>
</tr>



	
<?php			
	

$count++; 

} 


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
	   
else 

{
echo '<body></br></br><div class="containerdb"><h2>&nbsp;&nbsp;Please, <a href="../home.php">login</a> and come back later!</h2>' ;
}
?>
</body>
</html>
