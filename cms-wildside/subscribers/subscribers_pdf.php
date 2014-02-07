<?php
define('INCLUDE_CHECK',true);

require '../connect.php';
require '../functions.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>

<?php include '../maststrip.php'; 
if($_SESSION['id'])
{
include '../menu.php'; 

$one12= "2012-04-01" ;
$two12= "2012-07-02" ;
$three12= "2012-09-17" ;
$four12= "2012-12-10" ;
$one13= "2013-04-01" ;
$two13= "2013-07-02" ;
$three13= "2013-09-17" ;
$four13= "2013-12-10" ;


?>

<div class="containerdb">
<table width="925" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="34%" valign="middle"><h2>Subscribers - PDF label</h2></td>
<td width="66%" style="font-size:95%;">
<a href="../subscribers/subscribers_pdf.php?q=<? echo $one12 ?>" class="alpha">1of4 2012</a>
<a href="../subscribers/subscribers_pdf.php?q=<? echo $two12 ?>" class="alpha">2of4 2012</a>
<a href="../subscribers/subscribers_pdf.php?q=<? echo $three12 ?>" class="alpha">3of4 2012</a>
<a href="../subscribers/subscribers_pdf.php?q=<? echo $four12 ?>" class="alpha">4of4 2012</a>
<a href="../subscribers/subscribers_pdf.php?q=<? echo $one13 ?>" class="alpha">1of4 2013</a>
<a href="../subscribers/subscribers_pdf.php?q=<? echo $two13 ?>" class="alpha">2of4 2013</a>
<a href="../subscribers/subscribers_pdf.php?q=<? echo $three13 ?>" class="alpha">3of4 2013</a>
<a href="../subscribers/subscribers_pdf.php?q=<? echo $four13 ?>" class="alpha">4of4 2013</a>
</td>
</tr>
</tr>
</table>

<?php



  // Get the search variable from URL
  

  $var = @$_GET['q'] ;
  $trimmed = trim($var); //trim whitespace from the stored variable

// rows to return
$limit=25; 

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
$query = "SELECT date, delivery_lastname, delivery_firstname, subscription_type, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country
FROM w_subscribers 
WHERE delivery_lastname LIKE '%".$trimmed."%' OR delivery_firstname LIKE '%".$trimmed."%' OR subscription_type LIKE '%".$trimmed."%' OR  date_add(date,interval 365 day) >= '".$trimmed."'
ORDER BY date ASC
";




 $numresults=mysql_query($query) or die('Error in query: $query. ' . mysql_error() ) ;
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


// begin to show results set
$count = 1 + $s ;

// now you can display the results returned


do { 
    $DueSweepDate = strftime('%d / %m / %Y',$row ['date']); 
     
    $data = $row['delivery_firstname'] ." "; 
    $data .=  $row['delivery_lastname'] ."\n"; 

    $query = ($data); 
     
    $text = sprintf($query);     
     
    $pdf->Add_Label($text); 
} while ($row = mysql_fetch_array($result)); 

$pdf->Output();  


	
	


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
echo '<body><div class="containerdb"><h2>&nbsp;&nbsp;Please, <a href="../home.php">login</a> and come back later!</h2>' ;
}
?>
</div>
</body>
</html>
