<?php
define('INCLUDE_CHECK',true);

require '../connect.php';
require '../functions.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>


<html>
<head>
<title>Add New Record in MySQL Database</title>
</head>
<body>
<?php
if(isset($_POST['add']))
{

$conn = mysql_connect($db_host, $db_user, $db_pass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

if(! get_magic_quotes_gpc() )
{
   $description = addslashes ($_POST['description']);
   $product_id = addslashes ($_POST['product_id']);
}
else
{
   $description = $_POST['description'];
   $product_id = $_POST['product_id'];
}
$size = $_POST['size'];

$sql = "INSERT INTO w_product_description ".
       "(description,product_id, size) ".
       "VALUES ".
       "('$description','$product_id','$size')";
mysql_select_db('TUTORIALS');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "Entered data successfully\n";
mysql_close($conn);
}
else
{
?>
<form method="post" action="<?php $_PHP_SELF ?>">
<table width="600" border="0" cellspacing="1" cellpadding="2">
<tr>
<td width="250">Description</td>
<td>
<input name="description" type="text" id="description">
</td>
</tr>
<tr>
<td width="250">Product id</td>
<td>
<input name="product_id" type="text" id="product_id">
</td>
</tr>
<tr>
<td width="250">size</td>
<td>
<input name="size" type="text" id="size">
</td>
</tr>
<tr>
<td width="250"> </td>
<td> </td>
</tr>
<tr>
<td width="250"> </td>
<td>
<input name="add" type="submit" id="add" value="Add Tutorial">
</td>
</tr>
</table>
</form>
<?php
}
?>
</body>
</html>