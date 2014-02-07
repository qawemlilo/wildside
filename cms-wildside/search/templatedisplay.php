
<?
$id = $_GET['id'];

$query = " SELECT * FROM w_company
		   WHERE company_id = '$id'
            " ;

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;

$row = mysql_fetch_array ($result);

if ($row)
{
?>

<div class="row">
<div class="span12">
<h2><?php echo $row['company_name'] ?></h2><hr/>
</div>


<div class="span6">
<strong class="muted">Industry Category: </strong> <?php echo $row['industry_category'] ?></br>
<strong class="muted">Advertiser Category: </strong><?php echo $row['advertiser_category'] ?></br>
<strong class="muted">Company Id: </strong><?php echo $row['company_id'] ?></br>
<strong class="muted">website: </strong><?php echo $row['website'] ?></br>
<strong class="muted">Vat: </strong> <?php echo $row['vat'] ?>

<?php echo '<p><a href="updatecompany.php?id='.$id.' " >update company</a>' ?></p>
</div>

<div class="span3">
<strong>ADDRESS</strong><hr/>
<?php	
echo '<p>';
if( $row['address_1'] != '' ) echo $row['address_1'].'</br>';
if( $row['address_2'] != '' ) echo $row['address_2'].'</br>';
if( $row['city_town_area'] != '' ) echo $row['city_town_area'].'</br>';
if( $row['province_state'] != '' ) echo $row['province_state'].'</br>';
if( $row['country'] != '' ) echo $row['country'].'</br>';
if( $row['postalcode'] != '' ) echo $row['postalcode'];
echo '</p>';
?>
</div>

<div class="span3"> 
<strong>BILLING ADDRESS</strong><hr/>
<?php	
echo '<p>';
if( $row['b_address_1'] != '' ) echo $row['b_address_1'].'</br>';
if( $row['b_address_2'] != '' ) echo $row['b_address_2'].'</br>';
if( $row['b_city_town_area'] != '' ) echo $row['b_city_town_area'].'</br>';
if( $row['b_province_state'] != '' ) echo $row['b_province_state'].'</br>';
if( $row['b_country'] != '' ) echo $row['b_country'].'</br>';
if( $row['b_postalcode'] != '' ) echo $row['b_postalcode'];
echo '</p>';
?>
</div>
</div>

<hr/>
<div class="row">
<div class="span6">
<strong>PEOPLE</strong><hr/>
<?php	
$company_id=$id;
	
$query = " SELECT * FROM w_people
           WHERE company_id = '$id'
		   " ;

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;




while($row = mysql_fetch_array($result))
{
echo '<p>';
{
if( $row ['name_first']!= '') echo'<strong>'.$row['name_first'].'&nbsp;'.$row['name_last']. '</strong></br>';
if( $row ['tel']!= '') echo'<strong class="muted">Tel:&nbsp;</strong>'.$row['tel']. '</br>';
if( $row ['cell']!= '') echo'<strong class="muted">Cell:&nbsp;</strong>'.$row['cell']. '</br>';
if( $row ['fax']!= '') echo'<strong class="muted">Fax:&nbsp;</strong>'.$row['fax']. '</br>';
if( $row ['email']!= '') echo'<strong class="muted">Email:&nbsp;</strong>'.$row['email']. '</br>';	
if(( $row ['name_first'])  !="" or ($row ['name_last']) !="") echo'<a href="updatepeoplecontacts.php?id='.$row['people_id'].'&company_id='.$company_id.' ">update people</a>';
}
echo '</p>';
}
?>
</div>


<div class="span6">
<strong>PERSON TO BE INVOICED</strong><hr/>

<? $result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;


while($row = mysql_fetch_array($result))
{
echo '<p>';
{
if( $row ['b_name_first']!= '') echo '<strong>'.$row['b_name_first'].'&nbsp;'.$row['b_name_last']. '</strong></br>';
if( $row ['b_tel'] != '') echo'<strong class="muted">Tel:&nbsp;</strong>'.$row['b_tel']. '</br>';
if( $row ['b_cell']!= '' ) echo'<strong class="muted">Cell:&nbsp;</strong>'.$row['b_cell']. '</br>';
if( $row ['b_fax'] != '') echo'<strong class="muted">Fax:&nbsp;</strong>'.$row['b_fax']. '</br>';
if( $row ['b_email'] != '' ) echo'<strong class="muted">Email:&nbsp;</strong>'.$row['b_email']. '</br>';	
if( ($row ['b_name_first']) != '' or ($row ['b_name_last']) != '')  echo'<a href="updatepeoplebilling.php?id='.$row['people_id'].'&company_id='.$company_id.' ">update person to receive invoice</a>';
}
echo '</p>';
}

?>
</div>
</div>
<div class="row">
<div class="span12">
<?
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

$id;

// Build SQL Query  
$query = "SELECT edition, order_price_subtotal, agent
FROM w_orders WHERE company_id = $id
"; 

 $result = mysql_query($query) or die("Couldn't execute query");


// EDIT HERE and specify your table and field names for the SQL query

echo '<br/><br/>  ';
echo '<table class="table table-bordered table-condensed"> ';
echo'<tr>';
echo'<th>Editions Booked todate</th>';
echo'<th>Agent</th>';
echo'<th  style=" text-align: right;"> Total to-date</th>';

'</tr>';

while ($row= mysql_fetch_array($result)) 

{
echo'<tr>';
echo'<td>' . $row[0] . '</td>';
echo'<td>' . $row[2] . '</td>';
echo'<td style=" text-align: right;">R ' . number_format($row[1], 2, '.',' ').  '</td>';
} 

echo'</tr>';
echo'</table>';

// Build SQL Query  
$query = "SELECT SUM(order_price_subtotal)
FROM w_orders WHERE company_id = $id
"; 

$result = mysql_query($query) or die("Couldn't execute query");

while ($row= mysql_fetch_array($result)) 

{ 
echo '<div class="alert alert-success"><h4>TOTAL BOOKED TO DATE - R' . number_format($row[0], 2, '.',' '). '</h4></div>';
}


?>


</div>
</div>


</div>
</div>
<?
}