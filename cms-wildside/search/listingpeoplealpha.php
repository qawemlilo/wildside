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

<div class="row">
<div class="span3">
<h2>People Search</h2>
</div>
<div class="span9">
<div class="pull-right">
<div class="pagination pagination-mini" >
<ul>
<li><a href="listingpeoplealpha.php?q=A" class="alpha">A</a></li>
<li><a href="listingpeoplealpha.php?q=B" class="alpha">B</a></li>
<li><a href="listingpeoplealpha.php?q=C" class="alpha">C</a></li>
<li><a href="listingpeoplealpha.php?q=D" class="alpha">D</a></li>
<li><a href="listingpeoplealpha.php?q=E" class="alpha">E</a></li>
<li><a href="listingpeoplealpha.php?q=F" class="alpha">F</a></li>
<li><a href="listingpeoplealpha.php?q=G" class="alpha">G</a></li>
<li><a href="listingpeoplealpha.php?q=H" class="alpha">H</a></li>
<li><a href="listingpeoplealpha.php?q=I" class="alpha">I</a></li>
<li><a href="listingpeoplealpha.php?q=J" class="alpha">J</a></li>
<li><a href="listingpeoplealpha.php?q=K" class="alpha">K</a></li>
<li><a href="listingpeoplealpha.php?q=L" class="alpha">L</a></li>
<li><a href="listingpeoplealpha.php?q=M" class="alpha">M</a></li>
<li><a href="listingpeoplealpha.php?q=N" class="alpha">N</a></li>
<li><a href="listingpeoplealpha.php?q=O" class="alpha">O</a></li>
<li><a href="listingpeoplealpha.php?q=P" class="alpha">P</a></li>
<li><a href="listingpeoplealpha.php?q=Q" class="alpha">Q</a></li>
<li><a href="listingpeoplealpha.php?q=R" class="alpha">R</a></li>
<li><a href="listingpeoplealpha.php?q=S" class="alpha">S</a></li>
<li><a href="listingpeoplealpha.php?q=T" class="alpha">T</a></li>
<li><a href="listingpeoplealpha.php?q=U" class="alpha">U</a></li>
<li><a href="listingpeoplealpha.php?q=V" class="alpha">V</a></li>
<li><a href="listingpeoplealpha.php?q=W" class="alpha">W</a></li>
<li><a href="listingpeoplealpha.php?q=X" class="alpha">X</a></li>
<li><a href="listingpeoplealpha.php?q=Y" class="alpha">Y</a></li>
<li><a href="listingpeoplealpha.php?q=Z" class="alpha">Z</a></li>
</ul>
</div>
</div>
</div>

</div>


<?php



  // Get the search variable from URL
  

  $var = @$_GET['q'] ;
  $trimmed = trim($var); //trim whitespace from the stored variable

// rows to return
$limit=10; 

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
$query = "SELECT DISTINCT w_company.company_id, company_name, name_first, name_last, tel, cell, email
FROM w_people LEFT JOIN w_company ON w_company.company_id = w_people.company_id
WHERE  
SUBSTRING( name_last, 1, 1 ) =  '".$trimmed."'
ORDER BY company_name ASC 
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
echo '<table class="table  table-condensed"> ';
echo'<tr class="cellnorghtborder">';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 3)). '</th>';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 2)) . '</th>';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 4)) . '</th>';
echo'<th class="cellnorghtborder">' . ucwords( mysql_field_name($result, 1)) . '</th>';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 5)). '</th>';
echo'<th class="cellnorghtborder"></th>';
'</tr>
';



// display what the person searched for
echo "<div class=\"alert alert-info\">
  You searched for : &quot;" . $var."&quot; &nbsp;&nbsp; Your search found &nbsp; <strong>" . $numrows. " </strong>&nbsp;entries</div>";

// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
while ($row= mysql_fetch_array($result)) 

{
echo'<tr>';
echo'<td class="tdborderbottom">'. $row[3]. '</td>';
echo'<td class="tdborderbottom">'. $row[2]. '</td>';
echo'<td class="tdborderbottom">'. $row[4] . '</td>';
echo'<td class="tdborderbottom">' . $row[1] . '</td>';
echo'<td class="tdborderbottom">' . $row[5] . '</td>';
echo'<td class="tdborderbottom" align="right"><a href="display.php?id='.$row[0].'"</a><img name="go" src="../css/link.png" width="20" height="20" alt=""/></td>';


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
