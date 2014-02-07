<?php
define('INCLUDE_CHECK',true);

require '../connect.php';
require '../functions.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CMS</title>

<link href="./css/db.css" rel="stylesheet" type="text/css" />
<link href="../css/db.css" rel="stylesheet" type="text/css" />
<link href="../css/dbprint.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php

if($_SESSION['id'])
{
?>


<?

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
$id = mysql_real_escape_string($_GET['id']);

$query = " SELECT * FROM w_orders WHERE order_id = '$id' " ;
$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;
$row = mysql_fetch_array ($result);
$callid = mysql_real_escape_string($row['company_id']);
$edition_date = mysql_real_escape_string($row['edition_id']);
?>

<?php
$query1 = " SELECT * FROM w_company WHERE w_company.company_id ='$callid'" ;
$result1 = mysql_query ($query1) or die('Error in query: $query. ' . mysql_error() ) ;
$rowcompany = mysql_fetch_array ($result1);
?>

<?php
$query_edtion = " SELECT booking, material, delivery FROM w_product_edition_dates 
WHERE edition_id='$edition_date'
" ;
$result_edtion = mysql_query ($query_edtion) or die('Error in query: $query. ' . mysql_error() ) ;
$row_edtion = mysql_fetch_array ($result_edtion);
?>
<? $row['id'] ?> 
	<? $row['order_id'] ?> 
	<? $row['company_id'] ?> 
	<? $row['company_name'] ?> 
	<? $row['agency_id'] ?>
    <? $row['vat_status'] ?> 
    <? $agencyyes= $row['agency_id'] ?>
    <?php
$queryagency = " SELECT * FROM w_company WHERE w_company.company_id ='$agencyyes'";
$resultagency = mysql_query ($queryagency) or die('Error in query: $query. ' . mysql_error() ) ;
$rowagency = mysql_fetch_array ($resultagency);
?>

<?php
if ($row['agency_id'] == '0')
{
$query2 = " SELECT * FROM w_people WHERE w_people.company_id ='$callid'" ;
$result2 = mysql_query ($query2) or die('Error in query: $query. ' . mysql_error() ) ;
}
else
{
$query2 = " SELECT * FROM w_people WHERE w_people.company_id ='$agencyyes'" ;
$result2 = mysql_query ($query2) or die('Error in query: $query. ' . mysql_error() ) ;
}
?>
<div class="containerdb" style="border:none;">
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr class="cellbdnobackground">
    <td colspan="4" style="margin:0px; padding:0px; border-collapse:collapse; background-image:url(../css/sjmastlogo.jpg); height:149px;"> <p>&nbsp;</p></td>
    </tr>
  <tr>
    <td colspan="4" class="cellbd">
	<?php echo '<a href="bookingupdate_simple.php?id='.$id.'"><span style="font-size:11px;">UPDATE THIS BOOKING</span></a>';?>&nbsp;&nbsp;|&nbsp;&nbsp;
    <?php echo '<a href="bookings_edition.php?q='.$row['edition'] .'"><span style="font-size:11px;">BOOKING LIST</span></a>';?>&nbsp;&nbsp;|&nbsp;&nbsp;
   <?php
  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
  echo "<a href='$url'><span style=\"font-size:11px;\">Go Back</span></a>"; 
?>
    
    </td>
    </tr>
  <tr>
    <td colspan="2" class="cellbd">Billing Company&nbsp; &nbsp;</td>
    <td width="315" class="cellbd">Company being Advertised</td>
    <td width="296" class="cellbdnobackground">
    <?php echo $row['company_name'] ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" rowspan="3" class="cellbdnobackground">
	
	<?php if ($row['agency_id'] == '0') 
	
	{ 
	
	echo $rowcompany['company_name']. '<br />';
	while ($rowpeople= mysql_fetch_array($result2))  
{ 
	if( $rowpeople['b_name_last'] =='') { } else { echo $rowpeople['b_name_first'].' '.$rowpeople['b_name_last']. '<br />';}
}
	if( $rowcompany['b_address_1'] =='') { } else { echo $rowcompany['b_address_1'].'<br />';}
	if( $rowcompany['b_address_2'] =='') { } else { echo $rowcompany['b_address_2'].'<br />';}
	if( $rowcompany['b_city_town_area'] =='') { } else { echo $rowcompany['b_city_town_area'].'<br />';}
	if( $rowcompany['b_province_state'] =='') { } else { echo $rowcompany['b_province_state'].'<br />';}
	if( $rowcompany['b_postalcode'] =='') { } else { echo $rowcompany['b_postalcode'].'<br />';}
	if( $rowcompany['b_country'] =='') { } else { echo $rowcompany['b_country'].'<br />';}
	echo '<br/><a href=" http://www.wildsidesa.co.za/cms-wildside/search/updatecompany.php?id='.$callid.'">update company</a>';
 
	} 
	else  
	
	{ 
	
	echo $rowagency['company_name']. '</br>';
    echo $rowpeople['b_name_first'].' '.$rowpeople['b_name_last']. '<br />';
	if( $rowagency['b_address_1'] =='') { } else { echo $rowagency['b_address_1'].'<br />';}
	if( $rowagency['b_address_2'] =='') { } else { echo $rowagency['b_address_2'].'<br />';}
	if( $rowagency['b_city_town_area'] =='') { } else { echo $rowagency['b_city_town_area'].'<br />';}
	if( $rowagency['b_province_state'] =='') { } else { echo $rowagency['b_province_state'].'<br />';}
	if( $rowagency['b_postalcode'] =='') { } else { echo $rowagency['b_postalcode'].'<br />';}
	if( $rowagency['b_country'] =='') { } else { echo $rowagency['b_country'].'<br />';}
	echo '<br/><a href=" http://www.wildsidesa.co.za/cms-wildside/search/updatecompany.php?id='.$callid.'">update company</a>';
	
	
	
	} 
	?>
    

	</td>
    <td class="cellbd">REF No</td>
    <td class="cellbdnobackground"><?php echo $row['order_id'] ?></td>
  </tr>
  <tr>
    <td class="cellbd">Authorisation</td>
    <td class="cellbdnobackground">
	 
    <?php mysql_data_seek($result2, 0);
	$rowpeople = mysql_fetch_array($result2); 
	?>
    
	<?php echo $rowpeople['name_first'].' '.$rowpeople['name_last'] ?></br>
    <? if( $row['ci_number'] =='') { } else { echo 'Number: '. $row['ci_number'];} ?>
	</td>
  </tr>
  <tr>
    <td class="cellbd">Contact Details</td>
    <td class="cellbdnobackground">
      <?
	  mysql_data_seek($result2, 0);
	  while ($rowpeople= mysql_fetch_array($result2))  
{ 
if( $rowpeople['b_tel'] =='') { } else {  echo 'Tel: '. $rowpeople['b_tel'].'</br>';}
if( $rowpeople['b_fax'] =='') { } else { echo 'Fax: '. $rowpeople['b_fax'].'</br>';}
if( $rowpeople['b_cell'] =='') { } else { echo 'Cell: '. $rowpeople['b_cell'].'</br>';}
if( $rowpeople['b_email'] =='') { } else { echo 'Email: '. $rowpeople['b_email'].'</br>';}
}
    ?>
    </td>
  </tr>
  <tr>
    <td width="109" class="cellbd">Order Date </td>
    <td width="240" class="cellbd">Edition</td>
    <td class="cellbd">DESCRIPTION</td>
    <td align="right" class="cellbd" style="padding-right:20px;">PRICE</td>
  </tr>
  <tr>
    <td class="cellbdnobackground"><? echo $row['order_date'] ?></td>
    <td class="cellbdnobackground"><? echo $row['edition'] ?></td>
    <td class="cellbdnobackground"><? echo $row['product_description'] ?></td>
    <td align="right" class="cellbdnobackground" style="padding-right:20px;">R <? echo number_format($row['order_price'], 2, '.',' ') ?></td>
  </tr>
  <tr>
    <td colspan="3" class="cellbd">Advertorial Instructions</td>
    <td class="cellbdnobackground">&nbsp;</td>
  </tr>
  <tr class="cellbdnobackground">
    <td colspan="3"><? echo 'Advertorial : '. $row['product_advertorial'] ?></td>
    <td class="cellbdnobackground">&nbsp;</td>
  </tr>
 <? if( $row['rate_other'] =='No') 
  {
  }
	else 
	{
	?>
  <tr>
    <td colspan="3" class="cellbd">Rate Other Applied</td>
    <td class="cellbdnobackground">&nbsp;</td>
  </tr>
  <tr class="cellbdnobackground">
    <td colspan="3"><? echo 'Discount : '. $row['discount_percentage']. '  %' ?></td>
    <td align="right" class="cellbdnobackground" style="padding-right:20px;">R <? echo number_format($row['discount_value'], 2, '.',' ') ?></td>
  </tr>
  
<?	  
  }
  ?><tr> 
    <td colspan="2" rowspan="3" class="cellbdnobackground">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-left:-15px;">
  <tr>
    <td width="45%">Booking deadline:&nbsp;</td>
    <td width="55%"><? echo date('D d M Y', strtotime($row_edtion['booking'])) ?></td>
  </tr>
  <tr>
    <td>Material deadline:&nbsp;</td>
    <td><? echo date('D d M Y', strtotime($row_edtion['material']))?></td>
  </tr>
  <tr>
    <td>Published date:&nbsp;</td>
    <td><? echo date('F Y', strtotime($row_edtion['delivery'])) ?></td>
  </tr>
</table></td>
    <td width="315" class="cellbd">SUB TOTAL</td>
    <td align="right" class="cellbdnobackground" style="padding-right:20px;">R <? echo number_format($row['order_price_subtotal'], 2, '.',' ') ?></td>
  </tr>
  <tr>
    <td class="cellbd">VAT</td>
    <td align="right" class="cellbdnobackground" style="padding-right:20px;">R <? echo number_format($row['vat_total'], 2, '.',' ') ?></td>
  </tr>
  <tr>
    <td class="cellbd">TOTAL</td>
    <td align="right" class="cellbdnobackground" style="padding-right:20px;"><strong>R <? echo number_format($row['total'], 2, '.',' ') ?></strong></td>
  </tr>
  <tr>
    <td colspan="4" class="cellbd"><strong>Order Instructions</strong></td>
    </tr>
  <tr>
    <td colspan="4" class="cellbdnobackground">Place the advert with the: <? echo $row['feature'] ?>&nbsp;&nbsp;|&nbsp;&nbsp;<? echo $row['order_instructions'] ?></td>
    </tr>
  <tr>
    <td colspan="4" class="cellbd"><strong>T</strong><strong>ERMS OF ORDER</strong></td>
    </tr>
  <tr>
    <td colspan="2" class="cellbdnobackgroundsmall"><strong>BANKING AND ELECTRONIC FUND TRANSFER INFO</strong><br />
      Standard Bank, <br>
      Umhlanga Ridge<br>
      Branch Code: 057829<br>
      AC No: 05 238 1641          <br>
      SWIFT Code: SBZAZAJJ</td>
    <td colspan="2" class="cellbdnobackgroundsmall"><p><strong>PAYMENT TERMS AND CONDITIONS</strong><br />
      All acounts are on a 30 day basis from the date of invoice reflected on the Sugar Journal SA invoice and not from the date of statement.<br />
      WILDSIDE PUBLISHING cc.  VAT No: 4040215974, P O Box 2292, Prestondale, 4320 <br>
      Account queries: Ph: 082 329 1739 - Email: editor@wildsidesa.co.za   <br>
      Sales queries: Ph: 082 376 9115 - Email: tora@wildsidesa.co.za </p></td>
    </tr>

    <tr>
      <td colspan="2" class="cellbd">Signature of Authorising Person</td>
      <td colspan="2" class="cellbdnobackgroundsmall">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="cellbd">Date of Signature</td>
      <td colspan="2" class="cellbdnobackgroundsmall">&nbsp;</td>
    </tr>
    <td colspan="4" class="cellbdnobackgroundsmall"><strong>GENERAL TERMS</strong><br />
1. This is deemed to be a firm order and is not subject to cancellation.<br />
2. Wildside Publishing cc reserves the right to design artwork if not supplied in time for publication deadline and to charge the Advertiser for any additional expense involved in such a contingency.  <br />
3. Wildside Publishing cc will not be liable for any loss or damage consequential or otherwise occasioned by error, late publication or the failure of an advertisement to appear from any cause whatsoever.<br />
4. In the absence of agreed credit facilities the Advertiser accepts to pay all costs on presentation of an invoice.<br />
5. The Advertiser indemnifies Wildside Publishing cc against any damage and/or loss or expense which Wildside Publishing cc may incur as a direct or indirect consequence of the Advertiser's announcement.<br />
6. Where the Advertiser has undertaken to supply inserts which have been accepted and approved by Wildside Publishing cc, Wildside Publishing cc reserves the right to charge the agreed rate if they fail to arrive at the agreed time and place for insertion.<br />
7. Production materials, artwork, photographs and other work prepared on behalf of Advertisers will be charged for.<br />
8. All colour reproduction will be undertaken with the Printer's standard colour control. Final colour representation will be based on the principle of what is best for the overall standard of the publication.
9. In the event of an advertisement not appearing by reason of the fault of Wildside Publishing cc, the advertiser is entitled to ask for all charges and or monies to be refunded.<br />
10. The charges and rates for advertising are set out on the <a href="http://www.wildsidesa.co.za/homepagegraphics/2012PDFS/WildsideMagazine2012RateCardFASTFACTS.pdf" target="_new">WILDSIDE MAGAZINE RATE CARD</a>, a copy of which the Advertiser accepts he/she has read and understood.<br />
11. Adverts that are not presented according to specifications will be resized by Wildside Publisher's Agency.</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
</div>




<?
}

else 

{
echo '<body><div class="containerdb"><h2>&nbsp;&nbsp;Please, <a href="../home.php">login</a> and come back later!</h2>' ;
}
?>

</body>
</html>

















