
<div class="containerdb">
<table width="925" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="34%" valign="middle"><h2>Company - People - Agency</h2></td>
    <td width="66%" style="font-size:95%;">
<a href="./?q=A" class="alpha">A</a>
<a href="./?q=B" class="alpha">B</a>
<a href="./?q=C" class="alpha">C</a>
<a href="./?q=D" class="alpha">D</a>
<a href="./?q=E" class="alpha">E</a>
<a href="./?q=F" class="alpha">F</a>
<a href="./?q=G" class="alpha">G</a>
<a href="./?q=H" class="alpha">H</a>
<a href="./?q=I" class="alpha">I</a>
<a href="./?q=J" class="alpha">J</a>
<a href="./?q=K" class="alpha">K</a>
<a href="./?q=L" class="alpha">L</a>
<a href="./?q=M" class="alpha">M</a>
<a href="./?q=N" class="alpha">N</a>
<a href="./?q=O" class="alpha">O</a>
<a href="./?q=P" class="alpha">P</a>
<a href="./?q=Q" class="alpha">Q</a>
<a href="./?q=R" class="alpha">R</a>
<a href="./?q=S" class="alpha">S</a>
<a href="./?q=T" class="alpha">T</a>
<a href="./?q=U" class="alpha">U</a>
<a href="./?q=V" class="alpha">V</a>
<a href="./?q=W" class="alpha">W</a>
<a href="./?q=X" class="alpha">X</a>
<a href="./?q=Y" class="alpha">Y</a>
<a href="./?q=Z" class="alpha">Z</a>
</td>
    </tr>
    </tr>
</table>
<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="cellnorghtborderblue">
<form name="form" action="listing.php" method="get" >
<input name="q" type="text" class="myInput" />
<input name="Submit" type="submit" class="myButton" value="Search" />
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
$query = "SELECT DISTINCT w_company.company_id, company_name, name_first, name_last, tel, cell, email
FROM w_company INNER JOIN people ON w_company.company_id = w_people.company_id
WHERE 
(
SUBSTRING( company_name, 1, 1 ) =  '".$trimmed."'
)
GROUP BY company_id
ORDER BY company_name ASC 
"; 



 $numresults=mysql_query($query) or die('Error in query: $query. ' . mysql_error() ) ;
 $numrows=mysql_num_rows($numresults);

// If we have no results, offer a google search as an alternative

if ($numrows == 0)

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
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 1)). '</th>';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 2)) . '</th>';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 3)) . '</th>';
echo'<th class="cellnorghtborder">' . ucwords( mysql_field_name($result, 5)) . '</th>';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 8)). '</th>';
echo'<th class="cellnorghtborder">' . ucwords(mysql_field_name($result, 0)) . '</th>';
'</tr>
';



// display what the person searched for
echo "</br><p>You searched for : &quot;" . $var . "&quot; &nbsp;&nbsp; Your search found &nbsp; <strong>" . $numrows. " </strong>&nbsp;entry</p>";

// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
while ($row= mysql_fetch_row($result)) 

{
echo'<tr>';
echo'<td class="tdborderbottom">'. $row[1]. '</td>';
echo'<td class="tdborderbottom">'. $row[2]. '</td>';
echo'<td class="tdborderbottom">'. $row[3] . '</td>';
echo'<td class="tdborderbottom">' . $row[5] . '</td>';
echo'<td class="tdborderbottom">' . $row[8] . '</td>';
echo'<td class="tdborderbottom"><a href="display.php?id='.$row[0].'"</a>'.$row[0].'</td>';


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
  
  
?>  
