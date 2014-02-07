<?php
define('INCLUDE_CHECK',true);

require '../connect.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();
?>
<?php	include 'marketing_maststrip_bootstrap.php'; ?>
<div class="container">
<?php
if($_SESSION['id'])
{

include("ch19_include.php");

if (!$_POST) {
	
	
$query = "SELECT DISTINCT industry_category FROM w_company
		 ORDER by industry_category ASC
	         ";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) 
{
    $id=$row["industry_category"]; 
    $options.="<OPTION VALUE=\"$id\">".$id. '</option>';
}
?>
<div class="row">
<div class="span4">
  <form class="form-search" action="" method="get" >
  <select name="q"> 
  <option>category search</option>       
  <?=$options?>                 
  </select>
  <input name="Submit" type="submit" class="btn" value="Search"/>
  </form> 
</div>
<div class="span4">
<form action="" method="get">
<div class="input-append">
  <input class="span2" id="appendedInputButtons"  name="q" type="text" placeholder="company area contact or email">
  <button class="btn" type="submit" name="Submit" value="Search">Search</button>
</div>
</form> 
</div>
<div class="span4">
  <form class="navbar-form pull-right" action="" method="get" >
  <select class="span2" name="pca"> 
  <option VALUE=''>Area Search</option>
  <OPTION VALUE='1'>Rod Test</option>';   
  <OPTION VALUE='4125'>Amanzimtoti</option>';      
  <OPTION VALUE='3200'>Midlands</option>';      
  <OPTION VALUE='3500'>Berg</option>';              
  </select>
  <select class="span2" name="pcb"> 
  <option  VALUE=''>Area Search</option> 
  <OPTION VALUE='1'>Rod Test</option>'; 
  <OPTION VALUE='4295'>Port Edward</option>';   
  <OPTION VALUE='3200'>Midlands</option>';      
  <OPTION VALUE='3500'>Berg</option>';             
  </select>
  <input name="Submit" type="submit" class="btn" value="Search"/>
  </form>  
</div>
</div>




<?php
$var =  mysql_real_escape_string(@$_GET['q']) ;
$varmodal =  mysql_real_escape_string(@$_GET['m']) ;
$trimmed = trim($var); //trim whitespace from the stored variable

// rows to return
$limit=25; 

// check for an empty string and display a message.
if (($trimmed == "") AND $_GET['pca'] == "")
  {
  echo "<div class='span12'>Please enter a search...</div>";
  exit;
  }

// check for a search parameter
if (!isset($var))
  {
  echo "<div class='span12'>We dont seem to have a search parameter!</div>";
  exit;
  }

// Table

if (($_GET['pca'] == "") OR ($_GET['pcb'] == ''))
{
$query = "SELECT DISTINCT w_company.company_id, w_company.company_name, w_company.industry_category, w_company.city_town_area, w_people.people_id, w_people.name_first, w_people.name_last, w_people.email 
FROM w_company LEFT JOIN w_people
ON w_company.company_id = w_people.company_id
WHERE city_town_area LIKE '".$trimmed."%' OR industry_category LIKE '%".$trimmed."%' OR company_name LIKE '".$trimmed."%' AND w_people.email !='' AND w_people.unsubscribe = '0' ";
$trimmed_final= $trimmed;
}
else
{
$query = "SELECT DISTINCT w_company.company_id, w_company.company_name, w_company.industry_category, w_company.city_town_area, w_people.people_id, w_people.name_first, w_people.name_last, w_people.email 
FROM w_company LEFT JOIN w_people
ON w_company.company_id = w_people.company_id
WHERE  postalcode >= '".$_GET['pca']."' AND postalcode <= '".$_GET['pcb']."' AND w_people.email !='' AND w_people.unsubscribe = '0' ";	

$postala= $_GET['pca'];
$postalb= $_GET['pcb'];

}
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);

?>
<div class="row">
<div class="span12">
<?php echo "$num_rows records found <br/>
search variable 1:". $postala. "<br/> 
search variable 2:". $postalb. "<br/>  
search variable 3:". $trimmed_final. "<br/>  
"; 
 
 ?>

</div>
</div>
	
<?php	
	
	
	
	//haven't seen the form, so display it
	echo "<div class='row'>
	<div class='span6'>
	<h1>Send a Newsletter</h1>
	
	<form method=\"post\" action=\"".$_SERVER["PHP_SELF"]."\">
	<p><strong>Subject:</strong><br/>
	<input type=\"text\" name=\"subject\" size=\"40\"></p>
	<p><strong>From:</strong><br/>
	<input type=\"text\" name=\"from\" size=\"40\"></p>

	<p><strong>Email Search Variables:</strong><br/>
	<input type=\"text\" name=\"trimmed\" size=\"40\" value=\"$trimmed_final\"></p>
	<input type=\"text\" name=\"postala\" size=\"40\" value=\"$postala\"></p>
	<input type=\"text\" name=\"postalb\" size=\"40\" value=\"$postalb\"></p>
	
		
	<p><strong>Mail Body Link:</strong><br/>
	<textarea name=\"link\" cols=\"100\"></textarea>
	<p> <button type=\"submit\" class=\"btn\">Send Email</button></p>
	</form>
	</div>
	
	

	<div class=\"span6\">";
	
$server=$_SERVER['HTTP_HOST'];
	
$directory = "../../content/email/2013/";


"<br/><br/>";

$dh = opendir($directory);
while (false !== ($file = readdir($dh))) {
	if($file != "../../content/email/2013/") {
		echo "http://$server/content/email/2013/$file<br/>";
	}
}
closedir($dh);




	
	echo "</div>
	    
	      </div>";
	
	
	
	

} else if ($_POST) {
	//want to send form, so check for required fields
	if (($_POST["subject"] == "") || ($_POST["link"] == "")) {
		header("Location: sendmymail.php");
		exit;
	}

	//connect to database
	doDB();

	if (mysqli_connect_errno()) {
		//if connection fails, stop script execution
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	} else {
		
		$subjectform= ($_POST["subject"]);
		$fromform=($_POST["from"]);
		$link=($_POST["link"]);
	
		
$postala =($_POST["postala"]);
$postalb =($_POST["postalb"]);
$trimmed =($_POST["trimmed"]);
		
		
		
		
		
		echo $subjectform . ' </br> ' .
		$fromform . ' </br> ' .
		$link . ' </br> ' .
		$category. ' </br> ' ;

		
		//otherwise, get emails from subscribers list
			
		if ($_POST['postala'] == "" OR $_POST['postalb'] == '' AND $_POST['trimmed'] != '' )
{
$sql = "SELECT DISTINCT w_company.company_id, w_company.company_name, w_company.industry_category, w_company.city_town_area, w_people.people_id, w_people.name_first, w_people.name_last, w_people.email 
FROM w_company LEFT JOIN w_people
ON w_company.company_id = w_people.company_id
WHERE city_town_area LIKE '".$trimmed."%' OR industry_category LIKE '%".$trimmed."%' OR company_name LIKE '".$trimmed."%' AND w_people.email !='' AND w_people.unsubscribe = '0' ";

}
else

if ($_POST['postala'] == "" OR $_POST['postalb'] == "" AND $_POST['trimmed'] == '')
{
echo "<div class='span12'>There is a BIG problem with your email send queary</div>";
  exit;
}
else


{
$sql = "SELECT DISTINCT w_company.company_id, w_company.company_name, w_company.industry_category, w_company.city_town_area, w_people.people_id, w_people.name_first, w_people.name_last, w_people.email 
FROM w_company LEFT JOIN w_people
ON w_company.company_id = w_people.company_id
WHERE  postalcode >= '".$postala."' AND postalcode <= '".$postalb."' AND w_people.email !='' AND w_people.unsubscribe = '0' ";	

}
		
	
		$result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
		
		$num_rows = mysqli_num_rows($result);
		
		echo "$num_rows records found <br/>
        search variable 1:". $postala. "<br/> 
		search variable 2:". $postalb. "<br/>
		search variable 3:". $trimmed. "<br/>"
		;



		//loop through results and send mail		
		
		while ($row = mysqli_fetch_array($result)) {
		 set_time_limit(0);
		 $to = $row["email"];
		 $from=$fromform;
         $namefrom=$fromform;
         $nameto = $row["name_first"];
         $subject = stripslashes($_POST["subject"]);
         $message = file_get_contents($link);
         
		 // this is it, lets send that email!
         authgMail($from, $namefrom, $to, $nameto, $subject, $message);
		 echo "newsletter sent to: ".$to."<br/>";
	
		}
		mysqli_free_result($result);
		mysqli_close($mysqli);
	}
}
?>
</div>
<?php
}
else 

{
	echo '<h1>&nbsp;&nbsp;Please, <a href="demo.php">login</a> and come back later!</h1>';
    	
}
?>
</div>