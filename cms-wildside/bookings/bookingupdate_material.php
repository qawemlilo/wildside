<?php
define('INCLUDE_CHECK',true);

require '../connect.php';
require '../functions.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>


<?php
include '../maststrip.php'; 
if($_SESSION['id'])
{
include '../menu.php'; 
?>


<div class="containerdbbox" style=" background:none; ">

<div class="containerdbfloat" style="background-color:#67b0fc; margin-left:0px;">

<div class="div960backgroundnone">
<div class="div960blue" style=" border:none; "><strong style="font-size:17px; color: #FEFEFE; padding-left:15px;">MATERIAL PLACED UPDATE &nbsp;&nbsp;</strong></div>
</div>




<?

if(!$_POST['submit'])
{

If ((!isset ($_GET['id']) || trim ($_GET['id']) == "")) 

{ 
die ('Missing Record id'); 
}


$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

$id = $_GET['id'];


$query = "SELECT * FROM w_orders
		  WHERE order_id = '$id'" ; 
		  
$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;

if(mysql_num_rows($result) > 0)
{
	
while($row = mysql_fetch_row($result))
{
echo '<p style="padding-left: 15px; color: #FFF;"> This Material Update is associated with : <strong>'.$row[1].' '.$row[3]. '</strong></p>';

echo '<p style="padding-left: 15px; color: #FFF;"> Edition : '. $row[10]. '</p>';

$edition= $row[10];

}

if (!$_POST ['submit'])
{


?>	

<form method="post" action=""  class="iform">

<input name='id' type='hidden' value="<?php echo $id; ?>" /> 
<?
$query = "SELECT * FROM w_orders
		  WHERE order_id = '$id'" ; 
		  
$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;

while($rowname = mysql_fetch_array($result))
{
	
$edition = $rowname['edition'];	

?>	
<input name='edition' type='hidden' value="<?php echo $edition; ?>" /> 
<ul>

<fieldset>
<legend>Material Placed</legend>
<li>
<select name="order_mat_placed"  class="iselect" style="font-size:14px;"> 
<option value="<? echo $rowname['order_mat_placed'] ?>" selected="selected"><? echo $rowname['order_mat_placed'] ?> </option> 
<option value="NO">NO</option>  
<option value="Yes">Yes</option>                          
</select>
</li>
</fieldset>
<li></li>
<fieldset>
<legend>Studio Memo</legend>
<li><textarea name="order_memo" id="textarea" cols="45" rows="5" ><? echo $rowname['order_memo'] ?></textarea></li>
</fieldset>
<li></li>
<li></li>
<li><input class="ibutton" type="Submit" name="submit" value="Update this record" /></li>
</ul>
</form>

<?
}

}
else
{	
echo 'Your record could not be located';
}

}
else
{
	// form submitted
}


}
else
{


$errorList = array ();

$id = $_POST['id'];
$company_id = $_POST['company_id'];




If ((!isset ($_POST['id']) || trim ($_POST['id']) == "")) 

{ 
die ('Missing Record id'); 
}


// ORDER MAT PLACED validation

$order_mat_placed = $_POST['order_mat_placed'];
if (trim ($_POST['order_mat_placed']) =='')
{
 $errorList[] = 'Invalid entry for : order_mat_placed ';
}
$order_id = $_POST['order_id'];

$edition = $_POST['edition'];
if (trim ($_POST['edition']) =='')
{
 $errorList[] = 'Invalid entry for : edition ';
}

$order_memo = $_POST['order_memo'];
if (trim ($_POST['order_memo']) =='')
{
 $errorList[] = 'Invalid entry for : order_memo ';
}



if (sizeof($errorList) == 0)

{

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


$query = "UPDATE w_orders SET 
order_mat_placed='$order_mat_placed',
order_memo='$order_memo'
WHERE order_id = '$id' 
";




$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

$editiontouse = 'q='.$_POST['edition'].'&Submit=Search';


echo '<p></br></br>Update successful.</br></br><a href="bookings_edition_studio.php?'.$editiontouse.'" style="color:#FFF;">Display the record </a> </p>';
	
mysql_close($connection);

}

else
{
	?>

<div class="div960backgroundnone">
<a href="<?php echo $_SERVER['../search/http_referrer']; ?>" style="padding-left:15px;"><img name="" src="../css/linkback.png" width="40" height="40" alt=""/></a>
<a href="<?php echo $_SERVER['../search/http_referrer']; ?>"><i style="color:#FFF; padding-left:5px;">GO BACK TO FORM ENTRY</i></a></td></br></br
></div>

<?


{   echo '<div>';
	echo '</br><p> The following errors were encountered :';
	echo '</br>';
	echo '<ul>';
	for ($x=0; $x<sizeof($errorList); $x++)
	echo "<li>$errorList[$x]";
	echo '</ul></p>';
	echo '</div>'; 
{  
}
}
   
}
}


}



else 


{
	echo '<h1>&nbsp;&nbsp;Please, <a href="index.php">login</a> and come back later!</h1>';
    	
}

?>


   
</br>

</div>
</div>

</body>
</html>