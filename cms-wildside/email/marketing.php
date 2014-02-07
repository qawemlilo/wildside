<?php	include 'marketing_maststrip_bootstrap.php'; ?>
<?php
if($_SESSION['id'])
{
?>

<div class="container">


<?php
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
WHERE city_town_area LIKE '".$trimmed."%' OR industry_category LIKE '%".$trimmed."%' OR company_name LIKE '".$trimmed."%' AND w_people.email !='' ";
}
else
{
$query = "SELECT DISTINCT w_company.company_id, w_company.company_name, w_company.industry_category, w_company.city_town_area, w_people.people_id, w_people.name_first, w_people.name_last, w_people.email 
FROM w_company LEFT JOIN w_people
ON w_company.company_id = w_people.company_id
WHERE  postalcode >= '".$_GET['pca']."' AND postalcode <= '".$_GET['pcb']."' AND w_people.email !=''  ";	
}
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);
?>
<div class="row">
<div class="span12">
<?php echo "$num_rows records found"; ?>
</div>
</div>

<table class="table table-bordered table-condensed table-striped">  
        <thead>  
          <tr>  
            <th>id comp</th> 
            <th>Category</th>
            <th>Area</th>    
            <th>Company</th>  
            <th>Contact</th>  
            <th>Email</th>
            <th>X</th>   
          </tr>  
        </thead>  
        <tbody> 
<?php
		
		while ($row = mysql_fetch_array($result)) {
		echo '<tr>';  
		echo '<td>'.$row["company_id"].'</td>'; 
        echo '<td>'.$row["industry_category"].'</td>';  
	    echo '<td>'.$row["city_town_area"].'</td>';  
        echo '<td>'.$row["company_name"].'</td>';  
        echo '<td>'.$row["name_first"].'  '.$row["name_last"].' </td>';  
        echo '<td>'.$row["email"].'</td>';  
		echo "<td><a class=\"btn btn-small\" href=\"ajax-form.php?v=".$row["people_id"]."\"  onclick=\"centeredPopup(this.href,'myWindow','500','350','yes');return false\" onchange=\"showhide('testdiv','block') ; return false\"><i class=\"icon-edit\"></i></a></td>"; 
        echo '</tr>';

		}
		mysql_close($link);
?>
       
        </tbody>  
      </table>  

<script language="javascript">
var popupWindow = null;
function centeredPopup(url,winName,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
popupWindow = window.open(url,winName,settings)
}
</script>

       


</div>

<?php
}
?>
<?php	include 'marketing_footer.php'; ?>