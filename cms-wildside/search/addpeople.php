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
if (!$_POST ['submit'])
{
?>

<?php
$id = $_GET['company_id'];

if($id!='')
{
$query = "SELECT DISTINCT company_id, company_name FROM w_company WHERE company_id='$id' ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 
{
    $id=$row["company_id"]; 
    $thing=$row["company_name"]; 
    $options.="<OPTION VALUE=\"$id\">".$thing.'</option>';
} 
}
else
{
	
	$query = "SELECT DISTINCT company_id, company_name FROM w_company 
			  ORDER by company_name ASC
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 
{
    $id=$row["company_id"]; 
	$thing=$row["company_name"]; 
    $options.="<OPTION VALUE=\"$id\">".$thing. '</option>';
}
}
?> 

<body>

<div class="containerdbbox" style=" background:none;">

<div class="containerdbfloat" style="background-color:#67b0fc;">

<div class="div960backgroundnone">

<div class="div960blue" style=" border:none; "><strong style="font-size:17px; color: #FEFEFE; padding-left:15px;">ADD A NEW CONTACT PERSON</strong></div>
</div>
<div class="div960backgroundnone">

<form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="post" class="iform">




<ul>
<li class="ilabel">SELECT COMPANY TO MATCH PERSON</br></li>

<li>
<select name="company_id" class="iselect" >        
<?=$options?>                 
</select>
</li> 

<li>&nbsp;&nbsp;
</li>

<li><label for="name_first">First Name</label><input class="itext" type="text" name="name_first"/></li> 
<li><label for="name_last">Last Name</label><input class="itext" type="text" name="name_last"/></li> 
<li><label for="tel">Tel</label><input class="itext" type="text" name="tel"/></li> 
<li><label for="cell">Cell</label><input class="itext" type="text" name="cell"/></li> 
<li><label for="email">Email</label><input class="itext" type="text" name="email"/></li> 
<li><label for="fax">Fax</label><input class="itext" type="text" name="fax"/></li> 
<li><label>&nbsp;</label><input class="ibutton" type="Submit" name="submit" value="Add Person" /></li>
</ul>



</form>


<?php
}
else
{
	

$errorList = array ();


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

$fax = $_POST['fax'];

$email = $_POST['email'];


$company_id = $_POST[ 'company_id'];
if ((trim ($_POST[ 'company_id' ]) =='') or (trim ($_POST[ 'company_id' ] == '')))
{
 $errorList[] = 'Please make a valid selection for : Company ';
 
 echo $_POST[ 'company_id'];
}


if (sizeof($errorList) == 0)

{
	
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


$query = "INSERT INTO
w_people (
company_id,
name_first,
name_last,
tel,
cell,
email,
fax,
dateadded
)

VALUES (

'$company_id',

'$name_first',

'$name_last',

'$tel',

'$cell',

'$email',

'$fax',
now()
)";



$id = $_POST['company_id'];


$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());


?>
<div class="containerdbbox" style=" background:none; ">
<div class="containerdbfloat" style="background-color:#67b0fc;">
<div class="div960backgroundnone">
</br>
<p>
Record added successfully. </br>
</br>
<a href="display.php?id=<?php echo $_POST['company_id'] ?>" class="whitelink"><strong>GO TO THE COMPANY DETAIL RECORD</strong></a> 
</br>
or
</br>
<a href="listingcompany.php" class="whitelink">Go back to main menu</a>
</p>
</p>
</div>
</div>
</div>

<?
	
mysql_close($connection);

}

else

{   echo '<div class="containerdbbox">';
	echo '<p> The following errors were encountered :';
	echo '</br>';
	echo '<ul>';
	for ($x=0; $x<sizeof($errorList); $x++)
{
    echo "<li>$errorList[$x]";
}
    echo '</ul></p></div>';
}
}


}
else 

{
	echo '<h1>&nbsp;&nbsp;Please, <a href="demo.php">login</a> and come back later!</h1>';
    	
}
?>



   
</br>
</div>
</div>


</body>
</html>