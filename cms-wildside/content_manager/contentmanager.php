<?php
define('INCLUDE_CHECK',true);

require '../connect.php';
require '../functions.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>

<?php 
include 'loginstrip.php'; 
if($_SESSION['id'])
{
?>
<div class="content">  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h3>Online Content Manager</h3></td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
<tr class="cellnorghtborderblue" style="text-align: right;">
<td width="60%"></td>
<td>

<form name="form" action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="get" >
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
$query = "SELECT id, active, category, title, storyorder, person, image1 
FROM w_content 
WHERE title LIKE '%".$trimmed."%' or category LIKE '%".$trimmed."%' or person LIKE '%".$trimmed."%'
ORDER BY category ASC, storyorder ASC "; 
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

<!--HTML BEGINS ----------------------------------------------------------------------------->

<table width="100%"  border="0" cellspacing="0" cellpadding="5">
<tr class="cellnorghtborder">
<th class="cellnorghtborder"><?php echo ucwords(mysql_field_name($result, 1)); ?></th>
<th class="cellnorghtborder"><?php echo ucwords(mysql_field_name($result, 2)); ?></th>
<th class="cellnorghtborder"><?php echo ucwords(mysql_field_name($result, 4)); ?></th>
<th class="cellnorghtborder"><?php echo ucwords(mysql_field_name($result, 3)); ?></th>
<th class="cellnorghtborder"><?php echo ucwords(mysql_field_name($result, 5)); ?></th>
<th class="cellnorghtborder"><?php echo ucwords(mysql_field_name($result, 6)); ?></th>
<th class="cellnorghtborder">Update</th>
</tr>


<?php
// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
while ($row= mysql_fetch_array($result)) 

{
?>

<tr>
<td class="tdborderbottom"><?php echo $row['active']; ?></td>
<td class="tdborderbottom"><?php echo $row['category']; ?></td>
<td class="tdborderbottom"><?php echo $row['storyorder']; ?></td>
<td class="tdborderbottom"><?php echo $row['title']; ?></td>
<td class="tdborderbottom"><?php echo $row['person']; ?></td>
<td class="tdborderbottom"><?php echo $row['image1']; ?></td>
<td class="tdborderbottom" align="right"><a href="contentmanager_update.php?id=<?php echo $row['id']; ?>"><img name="go" src="../css/link.png" width="20" height="20" alt=""/></a></td>
</tr>
<?php
$count++; 

} 
?>

</tr>
</table>
<!--HTML ENDS ----------------------------------------------------------------------------->

<?php

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
<!-- end .content --></div>
        <!-- end .container --></div>
</body>
</html>
