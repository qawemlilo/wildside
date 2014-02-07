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
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#'.$row['category'].'">'.$row['category'].'</a>
                  </div>
				  ';
	
$query2 = "SELECT category, id, title, storyorder FROM w_content WHERE category ='".$row['category']."' AND active  ='yes' ORDER BY datecreated DESC";
$result2 = mysql_query($query2);

echo '<div id="'.$row['category'].'" class="accordion-body collapse">
                    <div class="accordion-inner">';
while($row2 = mysql_fetch_array($result2))
{
echo ' <a  href="http://www.wildsidesa.co.za/content/body_detail.php?id='.$row2['id'].'">'.$row2['title'].'</a><hr/ class="navigation">';
} 
echo ' </div>
         </div>
          </div>';
}
?> 
</div>