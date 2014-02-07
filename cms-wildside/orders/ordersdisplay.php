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

If ((!isset ($_GET['id']) || trim ($_GET['id']) == "")) 
{ 
die ('Missing Record id'); 
}
?>
<?php 
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
?>

<?
$id = $_GET['id'];

$query = " SELECT * FROM w_orders
		   WHERE company_id = '$id'
            " ;

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;

$row = mysql_fetch_array ($result);

if ($row)
{
?>

<div class="containerdbbox">

<div class="containerdbfloat">

<div class="div960backgroundnone" style=" margin-bottom:10px; width:959px;">
<div class="div960blue"><strong style="font-size:17px; padding-left:15px;"><?php echo $row['company_name'] ?></strong></strong></div>

<div class="div30">
<p><strong>Industry Category: </strong> <?php echo $row['industry_category'] ?></br>
<strong>Advertiser Category: </strong><?php echo $row['advertiser_category'] ?>
</p></div>

<div class="div30col">
<p><strong>website: </strong><?php echo $row['website'] ?></br>
<strong>Vat: </strong> <?php echo $row['vat'] ?>
</p>
</div>
<div class="div30">
<p><?php echo '<a href="updatecompany.php?id='.$id.' " >update company</a>' ?></p>
</p></div>
<p></p>
</div>


<div class="div960backgroundnone">

<div class="div960bluenoborder">
<div class="div30"><p><strong>ADDRESS</strong></p></div> 
<div class="div30"><p><strong>ADDRESS BILLING</strong></p></div> 
<div class="div30"><p><strong>PEOPLE - CONTACTS</strong></p></div> 
</div>



<div class="div30">
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

<div class="div30col"> 

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


<div class="div30">
  
<?php	
$company_id=$id;
	
$query = " SELECT * FROM people
           WHERE company_id = '$id'
		   " ;

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;




while($row = mysql_fetch_array($result))
{
echo '<p>';
{
if( $row ['name_first']!= '') echo'<strong>'.$row['name_first'].'&nbsp;'.$row['name_last']. '</strong></br>';
if( $row ['tel']!= '') echo'<strong>Tel:&nbsp;</strong>'.$row['tel']. '</br>';
if( $row ['cell']!= '') echo'<strong>Cell:&nbsp;</strong>'.$row['cell']. '</br>';
if( $row ['fax']!= '') echo'<strong>Fax:&nbsp;</strong>'.$row['fax']. '</br>';
if( $row ['email']!= '') echo'<strong>Email:&nbsp;</strong>'.$row['email']. '</br>';	
if(( $row ['name_first'])  !="" or ($row ['name_last']) !="") echo'<a href="updatepeoplecontacts.php?id='.$row['people_id'].'&company_id='.$company_id.' ">update people</a>';
}
echo '</p>';
}
?>
</div>



<div class="div960backgroundnone">
<div class="div960bluenoborder">
<div style="width: 30%; float: left; clear: none; margin-right:1%;"><p><strong>PEOPLE - BILLING</strong></p></div> 
</div>

<div class="div275" style="border-left:thin solid #D5D5D5;"> 
<?


$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;


while($row = mysql_fetch_array($result))
{
echo '<p>';
{
if( $row ['b_name_first']!= '') echo '<strong>'.$row['b_name_first'].'&nbsp;'.$row['b_name_last']. '</strong></br>';
if( $row ['b_tel'] != '') echo'<strong>Tel:&nbsp;</strong>'.$row['b_tel']. '</br>';
if( $row ['b_cell']!= '' ) echo'<strong>Cell:&nbsp;</strong>'.$row['b_cell']. '</br>';
if( $row ['b_fax'] != '') echo'<strong>Fax:&nbsp;</strong>'.$row['b_fax']. '</br>';
if( $row ['b_email'] != '' ) echo'<strong>Email:&nbsp;</strong>'.$row['b_email']. '</br>';	
if( ($row ['b_name_first']) != '' or ($row ['b_name_last']) != '')  echo'<a href="updatepeoplebilling.php?id='.$row['people_id'].'&company_id='.$company_id.' ">update people</a>';
}
echo '</p>';
}

?>

</div>
</div>



</div>
</div>




<?
}
}
else 

{
echo '<body><div class="containerdb"><h2>&nbsp;&nbsp;Please, <a href="../home.php">login</a> and come back later!</h2>' ;
}
?>

</body>
</html>


















