<?php
define('INCLUDE_CHECK',true);

require 'connect.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://www.wildsidesa.co.za/ipad/css/mag.css" type="text/css" charset="utf-8" media="screen">
<title>Untitled Document</title>
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


<script type="text/javascript">
function formSubmit()
{
document.getElementById("form1").submit();
}

</script>
</head>
<body>

<p>Enter some text in the fields below, then press the "Submit form" button to submit the form.</p>


<form name="form1" action="" method="get">
<input name="z" type="text" class="myInput" />
<input type="button" onclick="formSubmit()" value="Submit form" />
</form>

<a id="displayTextsearch" href="javascript:toggle1();">Show Search</a></div>

<div id="toggleTextsearch" style="display: none">
Hello
Hello
Hello
</div>

<?php
// Get the search variable from URL

  
$var_search = @$_GET['z'] ;
$trimmed_search = trim($var_search); //trim whitespace from the stored variable


$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


If($linksearch!=='')

// Build SQL Query  
$query_search = "SELECT * FROM w_mag_1of42012 WHERE MATCH(text) AGAINST ('$trimmed_search') ORDER BY pageno ASC"; 


$result_search = mysql_query($query_search) or die("Couldn't execute query");
$numresults=mysql_query($query_search) ;
$numrows=mysql_num_rows($result_search);

// If we have no results, offer a google search as an alternative

if ($numrows == 0)

  {
 echo '<p>Sorry: Your Search did not match anything</p>';
  }

  
// Key words  
function highlightWords($text, $words)
{
        /*** loop of the array of words ***/
        foreach ($words as $word)
        {
                /*** quote the text for regex ***/
                $word = preg_quote($word);
                /*** highlight the words ***/
                $text = preg_replace("/\b($word)\b/i", '<span class="highlight_word">\1</span>', $text);
        }
        /*** return the text ***/
        return $text;
}

  
?>
<table border="0" cellspacing="0" cellpadding="0">
<?    
while ($row_search= mysql_fetch_array($result_search)) 

{	
// Key words
$string = htmlspecialchars_decode($row_search['text']) ; 
$string = substr($string,stripos($string,$trimmed_search), 150);
$words = array($trimmed_search);
$string =  highlightWords($string, $words);

?>
<tr>
<td width="154" height="192"><a href="http://www.wildsidesa.co.za/ipad/mag2.php?s=<?php echo htmlspecialchars($row_search['id']-1);?>"><img id="imagethumbsearch" name="" src="http://www.wildsidesa.co.za/ipad/ws1of42012/ws1of42012/JPEG/<?php echo $row_search['thumb'];?>" width="130" height="173" alt="" /></a>	</td>
<td width="10">&nbsp;</td>
<td width="304" valign="top"><a href="http://www.wildsidesa.co.za/ipad/mag2.php?s=<?php echo htmlspecialchars($row_search['id']-1);?>"><?php echo'<span id="bold"> Page Number ' . ($row_search['id']-1);?></span></a><br/><?php echo $string ;?></td>
<?
}
?>
</tr>
</table>
<?php

$count++; 

  ?>
 
</body>
</html>
