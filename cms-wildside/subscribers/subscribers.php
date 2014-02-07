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


$one13= "2013-05-01" ;
$two13= "2013-07-02" ;
$three13= "2013-09-17" ;
$four13= "2013-12-10" ;
$one12= "2014-04-01" ;
$two12= "2014-07-02" ;
$three12= "2014-09-17" ;
$four12= "2014-12-10" ;


?>

<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" valign="middle"><h2>Subscribers</h2></td>
    <td width="80%" style="font-size:95%;">
    <div class="pagination pagination-small">
  <ul>
<li><a href="../subscribers/subscribers.php?q=<? echo $one13 ?>" class="alpha">1of4 2013</a></li>
<li><a href="../subscribers/subscribers.php?q=<? echo $two13 ?>" class="alpha">2of4 2013</a></li>
<li><a href="../subscribers/subscribers.php?q=<? echo $three13 ?>" class="alpha">3of4 2013</a></li>
<li><a href="../subscribers/subscribers.php?q=<? echo $four13 ?>" class="alpha">4of4 2013</a></li>
<li><a href="../subscribers/subscribers.php?q=<? echo $one14 ?>" class="alpha">1of4 2014</a></li>
<li><a href="../subscribers/subscribers.php?q=<? echo $two14 ?>" class="alpha">2of4 2014</a></li>
<li><a href="../subscribers/subscribers.php?q=<? echo $three14 ?>" class="alpha">3of4 2014</a></li>
<li><a href="../subscribers/subscribers.php?q=<? echo $four14 ?>" class="alpha">4of4 2014</a></li>
</ul>
</td>
    </tr>
    </tr>
</table>
<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="middle" class="cellnorghtborderblue">
<form class="form-inline" action="../subscribers/subscribers.php" method="get" >
<input name="q" type="text" class="myInput" />
<input name="Submit" type="submit" class="btn" value="Search" />
&nbsp;&nbsp; 
</form>
</td>
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
$query = "SELECT sub_id, date, delivery_firstname AS First, delivery_lastname AS Surname,  subscription_type AS Type
FROM w_subscribers
WHERE delivery_lastname LIKE '%".$trimmed."%' OR delivery_firstname LIKE '%".$trimmed."%' OR subscription_type LIKE '%".$trimmed."%' OR  date_add(date,interval 365 day) >= '".$trimmed."' OR date = '".$trimmed."'
ORDER BY date DESC
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


// EDIT HERE and specify your table and field names for the SQL query
echo '<table class="table table-condensed" style="font-size:11px;"> ';
echo'<tr >';
echo'<th >' . ucwords(mysql_field_name($result, 0)). '</th>';
echo'<th >' . ucwords(mysql_field_name($result, 1)) . '</th>';
echo'<th >' . ucwords(mysql_field_name($result, 2)) . '</th>';
echo'<th >' . ucwords( mysql_field_name($result, 3)) . '</th>';
echo'<th >' . ucwords( mysql_field_name($result, 4)) . '</th>';
echo'<th >1of4</br>2013</th>';
echo'<th >2of4</br>2013</th>';
echo'<th >3of4</br>2013</th>';
echo'<th >4of4</br>2013</th>';
echo'<th >1of4</br>2014</th>';
echo'<th >2of4</br>2014</th>';
echo'<th >3of4</br>2014</th>';
echo'<th >4of4</br>2014</th>';
echo'<th ></th>';
'</tr>
';



// display what the person searched for
echo "</br><p>You searched for : &quot;" . $var . "&quot; &nbsp;&nbsp; Your search found &nbsp; <strong>" . $numrows. " </strong>&nbsp;entries</p>";

// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
while ($row= mysql_fetch_array($result)) 
{

	
echo'<tr>';
echo'<td >'. $row[0]. '</td>';
echo'<td  nowrap="nowrap">'. $row[1]. '</td>';
echo'<td >'. $row[2] . '</td>';
echo'<td >' . $row[3] . '</td>';
echo'<td >' . $row[4] . '</td>';


$date = date($row[1]);
$newdate = strtotime ( '+365 day' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-j' , $newdate );

echo'<td >';
if($newdate >= date($one12) && date($date) <= date($one12))
{
echo 'Yes';
}
else
{
}
'</td>';

echo'<td >';
if($newdate >= date($two12) && date($date) <= date($two12))
{
echo 'Yes';
}
else
{
}
'</td>';
echo'<td >';
if($newdate >= date($three12) && date($date) <= date($three12))
{
echo 'Yes';
}
else
{
}
'</td>';
echo'<td >';
if($newdate >= date($four12) && date($date) <= date($four12))
{
echo 'Yes';
}
else
{
}
'</td>';
echo'<td >';
if($newdate >= date($one13) && date($date) <= date($one13))
{
echo 'Yes';
}
else
{
}
'</td>';

echo'<td >';
if($newdate >= date($two13) && date($date) <= date($two13))
{
echo 'Yes';
}
else
{
}
'</td>';
echo'<td >';
if($newdate >= date($three13) && date($date) <= date($three13))
{
echo 'Yes';
}
else
{
}
'</td>';
echo'<td >';
if($newdate >= date($four13) && date($date) <= date($four13))
{
echo 'Yes';
}
else
{
}
'</td>';
echo'<td  align="right"><a class="btn btn-small"  href="subscribers_update.php?id='.$row[0].'"><i class="icon-edit"></i></a> <a class="btn btn-small" href="#" onclick="Popup=window.open(\'subscriber_popup.php?id='.$row[0].'\',\'Popup\',\'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no, width=420,height=400,left=200,top=200\'); return false;"><i class="icon-fullscreen"></i></a></td>';



$count++; 

} 
  

  

echo   '</tr></table>';

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
<script>
function PopupCenter(pageURL, title,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
</script>
</body>
</html>
