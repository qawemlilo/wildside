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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<title>Databse Records</title>
<link href="../css/db.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/form.css" type="text/css" />
</head>





<body style="background-color:#559FFF;">

<div class="containerdbbox" style=" background:none; ">

<div class="containerdbfloat" style="background-color:#67b0fc;">

<div class="div960backgroundnone">
<div class="div960blue" style=" border:none; "><strong style="font-size:17px; color: #FEFEFE; padding-left:15px;">UPDATE PERSON</strong></div>
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
$company_id = $_GET['company_id'];


$query = "SELECT company_name FROM w_company
		  WHERE company_id = '$company_id'
		  " ; 
		  
$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;

if(mysql_num_rows($result) > 0)
{
	
while($row = mysql_fetch_row($result))

echo '<p style="padding-left: 15px; color: #FFF;"> This person is associated with: </br><strong> '.$row[0]. '</strong></p>';



$query = "SELECT * FROM w_people
		  WHERE people_id = '$id'" ; 

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;




if (!$_POST ['submit'])
{
?> 
<form method="post" action=""  class="iform">
<input name='id' type='hidden' value="<?php echo $id; ?>" /> 
<input name='company_id' type='hidden' value="<?php echo $company_id ?>" /> 
<?php
while($rowname = mysql_fetch_array($result))
{
echo '<ul>';
echo '<strong style="color: #FFF; ">CONTACT DETAILS</strong>';
echo '<div class="hr" ></div></br>';
echo '<li><label for="name_first">First Name</label><input class="itext" type="text"  id="name_first" name="name_first" value="'.$rowname['name_first']. '" /></li>';
echo '<li><label for="name_last">Last Name</label><input class="itext" type="text" id="name_last" name="name_last" value="'.$rowname['name_last'].'"/></li>';
echo '<li><label for="tel">Tel</label><input class="itext" type="text" id="tel" name="tel" value="'.$rowname['tel']. '" /></li>';
echo '<li><label for="fax">Fax</label><input class="itext" type="text" id="fax" name="fax" value="'.$rowname['fax'].'" /></li>';
echo '<li><label for="cell">Cell</label><input class="itext" type="text" id="cell" name="cell" value="'. $rowname['cell'].'" /></li>';
echo '<li><label for="email">Email</label><input class="itext" type="text" id="email" name="email" value="'.$rowname['email'].'"/></li>';
}
?>
<li><label>&nbsp;</label><input class="ibutton" type="Submit" name="submit" value="Update" />&nbsp;&nbsp;&nbsp;<input class="ibutton" type="cancel" name="cancel" value="Delete this record" onclick="window.location = 'deletepeople.php?id=<?php echo $id; ?>' " /></li>
</ul></form>



<?php
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


// PEOPLE form validation


$name_first = $_POST['name_first'];
if (trim ($_POST['name_first']) =='')
{
 $errorList[] = 'Invalid entry for : First Name ';
}
$name_last = $_POST['name_last'];
if (trim ($_POST['name_last']) =='')
{
 $errorList[] = 'Invalid entry for : Name Last ';
}
$tel = $_POST['tel'];

$cell = $_POST['cell'];

$email = $_POST['email'];

$fax = $_POST['fax'];




if (sizeof($errorList) == 0)

{

$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


$query = "UPDATE w_people SET 
name_first ='$name_first',
name_last ='$name_last',
tel ='$tel',
cell ='$cell',
fax ='$fax',
email ='$email',
dateupdated = NOW()
WHERE people_id = '$id' ";





$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());



echo '<p></br></br>Update successful.</br></br><a href=index.php style="color:#FFF;">Go back to Record List </a>&nbsp; or &nbsp; <a href=display.php?id='.$company_id.' style="color:#FFF;">Display the record </a> </p>';
	
mysql_close($connection);

}

else
{
	?>

<div class="div960backgroundnone">
<a href="<?php echo $_SERVER['http_referrer']; ?>" style="padding-left:15px;"><img name="" src="../css/linkback.png" width="40" height="40" alt=""/></a>
<a href="<?php echo $_SERVER['http_referrer']; ?>"><i style="color:#FFF; padding-left:5px;">GO BACK TO FORM ENTRY</i></a></td></br></br
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