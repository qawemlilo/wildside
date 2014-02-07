<?php
$q=$_GET["q"];

echo 'You have searched for: ' . $q;

define('INCLUDE_CHECK',true);

require 'connect.php';



$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

$sql = "SELECT * FROM w_mag_1of42012 WHERE MATCH (text) AGAINST ('$q') ORDER BY pageno ASC LIMIT 20" ; 
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
<table border="0" cellspacing="0" cellpadding="0">
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
<td width="154" height="192"><a href="http://www.wildsidesa.co.za/ipad/mag.php?s=<?php echo htmlspecialchars($row['id']-1);?>"><img id="imagethumbsearch" name="" src="http://www.wildsidesa.co.za/ipad/ws1of42012/ws1of42012/JPEG/<?php echo $row['thumb'];?>" width="130" height="173" alt="" /></a>	</td>
<td width="10">&nbsp;</td>
<td width="304" valign="top"><a href="http://www.wildsidesa.co.za/ipad/mag.php?s=<?php echo htmlspecialchars($row['id']-1);?>"><?php echo'<span id="bold"> Page Number ' . ($row['id']-1);?></span></a><br/><?php echo $string ;?> <a href="http://www.wildsidesa.co.za/ipad/mag.php?s=<?php echo htmlspecialchars($row['id']-1);?>"><?php echo'<span id="bold"> ...read more' ; ?></span></a></td>
<?
}
?>
</tr>
</table>
<?
mysql_close($connection);
?>