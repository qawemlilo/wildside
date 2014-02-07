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
include '../menu.php'; ?>

<div class="containerdb">

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr class="cellnorghtborderblue">
<td>
<form name="form" action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="get" >
<input name="q" type="text" class="myInput" />
<input name="Submit" type="submit" class="myButton" value="Search" />
</form>
</td>
<td>
</td>
<td>


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

$resultcount = mysql_query("SELECT * FROM w_email_list"); 
$num_rowscount = mysql_num_rows($resultcount); 





// Build SQL Query  
$query = "SELECT campaign AS CAMPAIGN, clicks AS CLCIKTHROUGHS, SUM(open) AS OPENED
FROM  w_email_report
GROUP BY campaign
"; 

$numresults=mysql_query($query);
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
echo '<table width="930"  border="0" cellspacing="0" cellpadding="0"> ';
echo'<tr class="cellnorghtborder">';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 0)). '</th>';
echo'<th class="cellnorghtborder">' . ucwords( mysql_field_name($result, 1)) . '</th>';
echo'<th class="cellnorghtborder">' . ucwords( mysql_field_name($result, 2)) . '</th>';
echo'<th class="cellnorghtborder">EMAILS SENT</th>';
echo'<th class="cellnorghtborder"></th>';

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
echo'<td class="tdborderbottom">'. $row[0]. '</td>';
echo'<td class="tdborderbottom">' . $row[1] . '</td>';
echo'<td class="tdborderbottom">' . $row[2] . '</td>';
echo'<td class="tdborderbottom">' . $num_rowscount. '</td>';
;


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
</body>
</html>
