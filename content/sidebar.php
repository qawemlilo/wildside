<?php
define('INCLUDE_CHECK',true);
require_once 'connect.php';
require 'functions.php';
?>
<br />
<div class="accordion" id="accordion2">            
 <?php 
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');
?>
<?php
$query_link = " SELECT * FROM w_content_cat ORDER BY category";
$result_link = mysql_query ($query_link) or die('Error in query: $query. ' . mysql_error() ) ;
?>
<?php 
while ($row= mysql_fetch_array($result_link)) 
{

echo '<div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle content" data-toggle="collapse" data-parent="#accordion2" href="#'.$row['category'].'">'.$row['category'].'</a>
                  </div>
				  ';
	
$query2 = "SELECT category, id, title, storyorder, page_width FROM w_content WHERE category ='".$row['category']."' AND active  ='yes' ORDER BY datecreated DESC";
$result2 = mysql_query($query2);

echo '<div id="'.$row['category'].'" class="accordion-body collapse">
                    <div class="accordion-inner">';
while($row2 = mysql_fetch_array($result2))
{
$page_width = $row2['page_width'];

if ($page_width =='')
{
echo ' <a class="content"  href="http://www.wildsidesa.co.za/content/body_detail.php?id='.$row2['id'].'">'.$row2['title'].'</a><hr/ class="navigation">';	
}

else
{	
echo ' <a class="content"  href="http://www.wildsidesa.co.za/content/body_detail_full.php?id='.$row2['id'].'">'.$row2['title'].'</a><hr/ class="navigation">';
}
} 
echo ' </div>
         </div>
          </div>';
}
?> 
</div>


<?
if ($row['category'] =='competitions')
{
	?>
	<form>
  <legend>Legend</legend>
  <label>Label name</label>
  <input type="text" placeholder="Type something…">
  <span class="help-block">Example block-level help text here.</span>
  <label class="checkbox">
    <input type="checkbox"> Check me out
  </label>
  <button type="submit" class="btn">Submit</button>
</form>	
<?	
}
?>

