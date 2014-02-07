<?php
	require_once('http://www.wildsidesa.co.za/ipad/login/auth.php');
	require_once('../ipad/login/config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://www.wildsidesa.co.za/fonts/stylesheet.css" type="text/css" charset="utf-8" media="screen">
<link rel="stylesheet" href="http://www.wildsidesa.co.za/ipad/css/mag.css" type="text/css" charset="utf-8" media="screen">
<title>WildMag</title>

<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "Show Contents";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Hide Contents";
	}
} 
</script>
<script language="javascript"> 
function toggle1() {
	var ele = document.getElementById("toggleTextsearch");
	var text = document.getElementById("displayTextsearch");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "Show Search";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Hide Search";
	}
} 
</script>
</head>

<body>

<div id="toggleText" style="display: none">
<?php
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

$query_indexcover = "SELECT * FROM w_mag_1of42012 WHERE id=1"; 
$result_indexcover = mysql_query($query_indexcover) or die("Couldn't execute query");
while ($row_indexcover= mysql_fetch_array($result_indexcover)) 
{
?>
<a href="http://www.wildsidesa.co.za/ipad/mag.php?s=<?php echo htmlspecialchars($row_indexcover['id']-1)?>"><p><img name="" src="http://www.wildsidesa.co.za/ipad/ws1of42012/JPEG/<?php echo $row_indexcover['thumb'];?>" width="175" height="237" alt=""/></p></a>

<?php
}


$query_index = "SELECT * FROM w_mag_1of42012 WHERE id>1 ORDER BY id ASC"; 
$result_index = mysql_query($query_index) or die("Couldn't execute query");


while ($row_index= mysql_fetch_array($result_index)) 

{
	
	
/* ODD EVEN NUMBERS */	
$num = ($row_index['id']);


if($num&1) {
?>
    <a href="http://www.wildsidesa.co.za/ipad/mag.php?s=<?php echo htmlspecialchars($row_index['id']-1)?>"><img id="imagethumbeven" name="" src="http://www.wildsidesa.co.za/ipad/ws1of42012/JPEG/<?php echo $row_index['thumb'];?>" width="175" height="237" alt="" /></a>
<?
} 

else {
?>
<a href="http://www.wildsidesa.co.za/ipad/mag.php?s=<?php echo htmlspecialchars($row_index['id']-1)?>"><img id="imagethumb" name="" src="http://www.wildsidesa.co.za/ipad/ws1of42012/JPEG/<?php echo $row_index['thumb'];?>" width="175" height="237" alt="" /></a>
<?
}
	
}
?>
</div>


<?php 

if($_SESSION['id'])
{

?>

<?php
// Get the search variable from URL
// rows to return
$limit=1; 

// check for an empty string and display a message.

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

If($linksearch!=='')


// Build SQL Query  
$query = "SELECT * FROM w_mag_1of42012"; 
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



// begin to show results set
$count = 1 + $s ;

// now you can display the results returned
while ($row= mysql_fetch_array($result)) 

{
	
$querysize = "SELECT * FROM w_mag_1of42012"; 
$result_size=mysql_query($querysize) ;
$row_size=mysql_fetch_array($result_size);	
?>
<div id="hoverleft">
<img src="css/wildside.png" width="99" height="25" style="margin-top:10px; margin-bottom:4px; float:left; clear:none; margin-left:15px;"/>
<div id="menubox">
<div><img id="line" src="css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
<div id="link" style="margin-left:10px;"> <a href="http://www.wildsidesa.co.za" target="_new">Wildside Magazine</a> - Autumn 2012</div><div><img id="line" src="css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
<div id="link"><a id="displayTextsearch" href="javascript:toggle1();">Show Search</a></div><div><img id="line" src="css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
<div id="link"><a id="displayText" href="javascript:toggle();">Show Contents</a></div>
<div><img id="line" src="css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
<?php
//break before paging
  // next we need to do the links to other results
  if ($s>=1) { // bypass PREV link if s is 0
  $prevs=($s-$limit);
  echo '<div id="link"><a href='.$PHP_SELF.'?s='.$prevs.'&q='.$var.'><img src="css/back.png" width="25" height="25" style=" margin-top:-6px; float:left; clear:none; margin-left:15px;" /></a></div>';
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
 echo '<div id="link"><a href='.$PHP_SELF.'?s='.$news.'&q='.$var.'><img src="css/forward.png" width="25" height="25" style=" margin-top:-6px; float:left; clear:none; margin-left:15px;"/></a></div>';
  ?>
<div><img id="line" src="css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
</div>
</div>
<div id="toggleTextsearch" style="display: none">
<?php include 'search.html' ;?>
</div>
<div id="mainimagewrapper">
<div id="mainimageside">
<img class="align-left" name="" src="http://www.wildsidesa.co.za/ipad/css/bg_side.png" width="1" height="250px" alt="" />
<a id="displayText" href="javascript:toggle();"><img class="align-left" name="" src="css/contents.png" alt="" style="margin-right:10px;"/></a>
</div>
<div id="mainimage">  
<img name="" src="http://www.wildsidesa.co.za/ipad/ws1of42012/<?php echo $row['page']; ?>" width="100%" alt="" style="background-color:#FFF;">
</div>
<div id="mainimagesideright">
<img name="" src="http://www.wildsidesa.co.za/ipad/css/bg_side.png" width="1" height="250px" alt="" class="align-right" />
<?php echo '<a href='.$PHP_SELF.'?s='.$news.'&q='.$var.'><img class="align-right" name="" src="css/next.png" alt="" style="margin-left:10px;"/> </a>'; ?>
</div>
</div>

<?php

$count++; 

} 

$currPage = (($s/$limit) + 1);

  
  }
  
}
	   
else 

{
echo '<body></br></br><div class="containerdb"><h2>&nbsp;&nbsp;Please, <a href="../home.php">login</a> and come back later!</h2>' ;
}
?>

</body>
</html>
