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

<div class="containerdbfloat" style="background-color:#67b0fc;">

<div class="div960backgroundnone">

<div class="div960blue" style=" border:none; "><strong style="font-size:17px; color: #FEFEFE; padding-left:15px;">UPDATE COMPANY&nbsp;&nbsp;&nbsp;&nbsp;</strong></div>
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



$query = "DELETE FROM w_people
		  WHERE people_id = '$id'" ; 

$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;


mysql_close($connection);


echo '<p></br></br>Deletion of Person successful.</p>';
   
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