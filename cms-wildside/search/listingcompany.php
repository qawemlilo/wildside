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

<?php
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

// Select Company  
$query = "SELECT DISTINCT company_id, company_name FROM w_company 
          WHERE industry_category != 'agency'
		  ORDER by company_name ASC
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 

{
	$com_id=$row["company_id"]; 
    $com_name=$row["company_name"]; 
    $options.="<OPTION VALUE=\"$com_id\" NAME=\"q\">".htmlentities($com_name). '</option>';
}

?>
<div class="row">
<div class="span3">
<h2>Company Search</h2>
</div>
<div class="span9">
<?php
$query = "SELECT type FROM w_category 
		 ORDER by type ASC
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 
{
    $id=$row["type"]; 
    $optionscat.="<OPTION VALUE=\"$id\">".$id. '</option>';
}
?>

 <form class="form-inline" name="form" action="listingcompany.php" method="get" >
<fieldset>
<label>Search by Industry type</label>
<select name="q">        
<?=$optionscat?>                 
</select>
<button type="submit" class="btn">Search</button>
</fieldset>
</form> 
</div>
</div>





<?php



  // Get the search variable from URL
  

  $var = @$_GET['q'] ;
  $trimmed = trim($var); //trim whitespace from the stored variable
  



// rows to return
$limit=10; 

// check for an empty string and display a message.
if ($trimmed == "" && $trimmedz == "" )
  {
  echo "<p>Please enter a search... ".$trimmedz."</p>";
  exit;
  }

// check for a search parameter
if (!isset($var) && !isset($varz))
  {
  echo "<p>We dont seem to have a search parameter!</p>";
  exit;
  }

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

If($linksearch!=='')


// Build SQL Query  
$query = "SELECT DISTINCT company_id, company_name, industry_category
FROM w_company 
WHERE company_name LIKE '%".$trimmed."%' OR  industry_category LIKE '".$trimmed."%' 
ORDER BY company_name ASC 
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


// EDIT HERE and specify your table and field names for the SQL query
echo '<table class="table table-condensed"> ';
echo'<tr class="cellnorghtborder">';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 1)). '</th>';
echo'<th class="cellnorghtborder">' . ucwords( mysql_field_name($result, 2)) . '</th>';
echo'<th class="cellnorghtborder"></th>';
'</tr>
';



// display what the person searched for

echo "<div class=\"alert alert-info\">
  You searched for : &quot;" . $var." ". $varz . "&quot; &nbsp;&nbsp; Your search found &nbsp; <strong>" . $numrows. " </strong>&nbsp;entries</div>";

// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
while ($row= mysql_fetch_array($result)) 

{
echo'<tr>';
echo'<td class="tdborderbottom">'. $row[1]. '</td>';
echo'<td class="tdborderbottom">' . $row[2] . '</td>';
echo'<td class="tdborderbottom" align="right"><a href="display.php?id='.$row[0].'"><i class="icon-circle-arrow-right"></i></a></td>';


$count++; 

} 
  

  

echo   '</tr></table>';

$currPage = (($s/$limit) + 1);

//break before paging
echo "<br />";

echo "<p><div class='pagination'>
<ul>";

  // next we need to do the links to other results
  if ($s>=1) { // bypass PREV link if s is 0
  $prevs=($s-$limit);
  print "<li><a href=\"$PHP_SELF?s=$prevs&q=$var\">&lt;&lt; Prev" . $limit . "</a></li>";
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
  	   

  echo '
  <li><a href='.$PHP_SELF.'?s='.$news.'&q='.$var.'>Next >>'. $limit .'</a></li> 
  </ul>
</div>';
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
