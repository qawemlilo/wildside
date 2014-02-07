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
{
	
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

	
$s = $_REQUEST["s"];
$output = "";
$s = str_replace(" ", "%", $s);
$query = "SELECT DISTINCT company_id, company_name FROM w_company WHERE company_name LIKE '%" . $s . "%'";
$squery = mysql_query($query);
if((mysql_num_rows($squery) != 0) && ($s != "")){
while($sLookup = mysql_fetch_array($squery)){
$displayName = $sLookup["company_name"];
$output .= '<li onclick="sendToSearch(\'' . $displayName . '\')">' . $displayName . '</li>';
}
}	
echo $output;

}
?>