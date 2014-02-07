<?php
	require_once('../auth.php');
	require_once('../config.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://www.wildsidesa.co.za/fonts/stylesheet.css" type="text/css" charset="utf-8" media="screen">
<link rel="stylesheet" href="../css/mag.css" type="text/css" charset="utf-8" media="screen">
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
<?php $path = $_GET["edition"]; 
$path = $_GET["edition"];
?>

<?php

	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {die('Failed to connect to server: ' . mysql_error());}
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {die("Unable to select database");}
?>



<?php
// Get the search variable from URL
// rows to return
$limit=2; 

// check for an empty string and display a message.



	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {die('Failed to connect to server: ' . mysql_error());}
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {die("Unable to select database");}


If($linksearch!=='')


// Build SQL Query  
$query = "SELECT * FROM $path"; 
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
 
  
// workout odd even number  
  if (is_odd($s)) {
 $s = $s;
 
 
} else {
   $s = $s-1;  
}

 if ($s == -1)
   {$s = 0;}

   

  
// get results
  $query .= " 
  limit $s, $limit";
  

$result = mysql_query($query) or die("Couldn't execute query");



// begin to show results set
$count = 1 + $s ;

	
$querysize = "SELECT * FROM $path"; 
$result_size=mysql_query($querysize) ;
$row_size=mysql_fetch_array($result_size);	
?>
<div id="hoverleft">
<img src="../css/wildside.png"  style="margin-top:0px; margin-bottom:4px; float:left; clear:none; margin-left:15px;"/>
<div id="menubox">
<div><img id="line" src="../css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
<div id="link" style="margin-left:10px;"> <a href="http://www.wildsidesa.co.za/ipad/member-profile.php">ONLINE SUBSCRIPTIONS</a></div><div><img id="line" src="../css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
<div id="link"><a id="displayTextsearch" href="javascript:toggle1();">Show Search</a></div><div><img id="line" src="../css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
<div id="link"><a id="displayText" href="javascript:toggle();">Show Contents</a></div>
<div><img id="line" src="../css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
<?php
//break before paging
  // next we need to do the links to other results
  if ($s>=1) { // bypass PREV link if s is 0
  $prevs=($s-$limit);
  echo '<div id="link"><a href='.$PHP_SELF.'?s='.$prevs.'&q='.$var.'><img src="../css/back.png"  style=" margin-top:-16px; float:left; clear:none; margin-left:15px;" /></a></div>';
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
 echo '<div id="link"><a href='.$PHP_SELF.'?s='.$news.'&edition='.$path.'><img src="../css/forward.png"  style=" margin-top:-16px; float:left; clear:none; "/></a></div>';
  ?>
<div><img id="line" src="../css/vert_line.png" alt="" name="line" width="2" height="40" /></div>
</div>
</div>

<div id="toggleTextsearch" style="display: none">
<div id="pointer"></div>
<?php include 'search2.html' ;?>
</div>

<div id="mainimagewrapper">
<div id="mainimageside">
<img class="align-left" name="" src="../css/bg_side.png" width="1" height="250px" alt="" />
<a id="displayText" href="javascript:toggle();"><img class="align-left" name="" src="../css/contents.png" alt="" style="margin-right:10px;"/></a>
</div>

<div id="mainimage">  
<?php
// now you can display the results returned
while ($row= mysql_fetch_array($result)) 

{
?>

<img name="" src="../<?php echo $path;?>/<?php echo $row['page']; ?>" width="50%" alt="" style="background-color:#FFF;float:left;clear:none;"/>


<?php

$count++; 

} 
?>
</div>
<div id="mainimagesideright">
<img name="" src="../css/bg_side.png" width="1" height="250px" alt="" class="align-right" />
<?php echo '<a href='.$PHP_SELF.'?s='.$news.'&edition='.$path.'><img class="align-right" name="" src="../css/next.png" alt=""  "/> </a>'; ?>
</div>
</div>
<?php
$currPage = (($s/$limit) + 1);

  
  }   
?>




<?php
//////* SEARCH CONTENT *////////////////	
function is_odd($num) {
  if ($num % 2 == 0) {
  return false;
 } else {
    return true;
  }
}
?>

<div id="toggleText" style="display: none">
<?php


$query_indexcover = "SELECT * FROM $path WHERE id=1"; 
$result_indexcover = mysql_query($query_indexcover) or die("Couldn't execute query");
while ($row_indexcover= mysql_fetch_array($result_indexcover)) 
{
?>
<a href="mag2.php?s=<?php echo htmlspecialchars($row_indexcover['id']-1)?>&edition=<?php echo $path;?>"><p><img name="" src="../<?php echo $path;?>/JPEG/<?php echo $row_indexcover['thumb'];?>" width="175" height="237" alt=""/></p></a>

<?php

}


$query_index = "SELECT * FROM $path WHERE id>1 ORDER BY id ASC"; 
$result_index = mysql_query($query_index) or die("Couldn't execute query");


while ($row_index= mysql_fetch_array($result_index)) 

{
	
	
/* ODD EVEN NUMBERS */	
$num = ($row_index['id']);


if($num&1) {
?>
<a href="mag2.php?s=<?php echo htmlspecialchars($row_index['id']-1)?>&edition=<?php echo $path;?>"><img id="imagethumbeven" name="" src="../<?php echo $path;?>/JPEG/<?php echo $row_index['thumb'];?>" width="175" height="237" alt="" /></a>
<?
} 

else {
?>
<a href="mag2.php?s=<?php echo htmlspecialchars($row_index['id']-1)?>&edition=<?php echo $path;?>"><img id="imagethumb" name="" src="../<?php echo $path;?>/JPEG/<?php echo $row_index['thumb'];?>" width="175" height="237" alt="" /></a>
<?
}
	
}
//////* END SEARCH CONTENT *////////////////	
?>
</div>

<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-20360503-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); })();
</script>


</body>
</html>
