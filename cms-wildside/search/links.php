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
{?>

<?php
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

// Select Company  
$query = "SELECT DISTINCT company_id, company_name FROM w_company 
          WHERE industry_category != 'agency'
		  ORDER by company_name ASC
	         ";
$result = mysql_query($query);
$num = mysql_num_rows($result);


if ($num != 0) {

 $file= fopen("links.xml", "w");

 $_xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n";

 $_xml .="<site>\r\n";

 while ($row = mysql_fetch_array($result)) {

 if ($row["company_name"]) {

 $_xml .="\t<page title=\"" . $row["company_name"] . "\">\r\n";

 $_xml .="\t\t<file>" . $row["company_name"] . "</file>\r\n";
$_xml .="\t</page>\r\n";
 } else {

 $_xml .="\t<page title=\"Nothing Returned\">\r\n";
$_xml .="\t\t<file>none</file>\r\n";

 $_xml .="\t</page>\r\n";
 } }

 $_xml .="</site>";

 fwrite($file, $_xml);

 fclose($file);

 echo "<br/><br/><br/><br/><br/><br/><br/><br/>XML has been written.  <a href=\"links.xml\">View the XML.</a>";

 } else {

 echo "No Records found";

 } 
}?>
</div>
</body></html>