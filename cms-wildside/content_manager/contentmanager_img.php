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
<?php include("http://www.wildsidesa.co.za/content/img/thumbnail.php"); ?>
<?  
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
