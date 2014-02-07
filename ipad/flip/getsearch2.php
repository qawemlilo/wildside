<?php
	require_once('../auth.php');
	require_once('../config.php');
?>

<?php

	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {die('Failed to connect to server: ' . mysql_error());}
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {die("Unable to select database");}
?>

<?php
// Process the submitted data
$t2lpostData = $_POST;
foreach ($t2lpostData as $k => $v) {$k = $v;}
?>

<?php
$q = $_POST["user"];
$path = $_POST["edition"];
$path;

echo '<p>You have searched for: ' . $q . '</p>';


$sql = "SELECT * FROM $path WHERE MATCH (text) AGAINST ('$q') ORDER BY pageno ASC LIMIT 20" ; 
$result = mysql_query($sql);
$numrows=mysql_num_rows($result);
if ($numrows == 0)

  {
 echo '<p>Sorry: Your Search did not match anything</p>';
  }
  
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
<div style="width:480px">
<table width="448px" border="0" cellpadding="0" cellspacing="0" style="max-width:450px">
<?    
while($row = mysql_fetch_array($result))
{	
// Key words
$string = htmlspecialchars_decode($row['text']) ; 
$string = substr($string,stripos($string,$q), 150);
$words = array($q);
$string =  highlightWords($string, $words);

?>
<tr>
<td width="109" height="149"><a href="http://www.wildsidesa.co.za/ipad/flip/mag2.php?s=<?php echo htmlspecialchars($row['id']-1);?>&edition=<?php echo $path;?>"><img id="imagethumbsearch" name="" src="http://www.wildsidesa.co.za/ipad/<?php echo $path;?>/JPEG/<?php echo $row['thumb'];?>" width="105" height="141" alt="" /></a>	</td>
<td width="16">&nbsp;</td>
<td width="373" valign="top"><a href="http://www.wildsidesa.co.za/ipad/flip/mag2.php?s=<?php echo htmlspecialchars($row['id']-1);?>&edition=<?php echo $path;?>"><?php echo'<span id="boldsearch"> Page Number ' . ($row['id']-1);?></span></a><br/><?php echo $string ;?> <a href="http://www.wildsidesa.co.za/ipad/flip/mag2.php?s=<?php echo htmlspecialchars($row['id']-1);?>&edition=<?php echo $path;?>"><?php echo'<span id="boldsearch"> ...read more' ; ?></span></a></td>
<?
}
?>
</tr>
</table>
</div>
<br/><br/><br/><br/>
<?
mysql_close($link);
?>