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


<?php
 $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
 $allowedTags.='<li><ol><ul><span><div><br><ins><del>';  
// Should use some proper HTML filtering here.
  if($_POST['elm1']!='') {
    $sHeader = '<h2>Ah, content is king.</h2>';
    $sContent = strip_tags(stripslashes($_POST['elm1']),$allowedTags);
} else {
    $sHeader = '<h2>Nothing submitted yet</h2>';
    $sContent = '<p>Start typing...</p>';
    $sContent.= '<p><img width="107" height="108" border="0" src="/mediawiki/images/badge.png"';
    $sContent.= 'alt="TinyMCE button"/>This rover has crossed over</p>';
  }
?>
<html>
<head>
<title></title>
<script language="javascript" type="text/javascript" src="http://www.wildsidesa.co.za/cms-wildside/content_manager/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
  tinyMCE.init({
    theme : "advanced",
    mode: "exact",
    elements : "elm1",
    theme_advanced_toolbar_location : "top",
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,"
    + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
    + "bullist,numlist,outdent,indent",
    theme_advanced_buttons2 : "link,unlink,anchor,image,separator,"
    +"undo,redo,cleanup,code,separator,sub,sup,charmap",
    theme_advanced_buttons3 : "",
    height:"400px",
    width:"350px"
});

</script>
</script>
<SCRIPT language="JavaScript1.2">
function openwindow()
{
	window.open("http://www.wildsidesa.co.za/content/img/thumbnail","mywindow","menubar=1,resizable=1,width=490,height=700");
}
</SCRIPT>
</head>
<div class="content">  
<table width="950" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><h3>Online Content Manager - Update Page</h3>
      <?php


if(!$_POST['submit'])
{

If ((!isset ($_GET['id']) || trim ($_GET['id']) == "")) 

{ 
die ('Missing Record id'); 
}


$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

$id = $_GET['id'];



$query = "SELECT * FROM w_content
		  WHERE id = '$id'
		  " ; 
		  
$result = mysql_query ($query) or die('Error in query: $query. ' . mysql_error() ) ;

if(mysql_num_rows($result) > 0)
{


// Select Category  
$querycat = "SELECT category FROM w_content_cat 
       	  ORDER BY category ASC
	         ";
$resultcat = mysql_query($querycat);
while ($rowcat = mysql_fetch_array($resultcat)) 

{
    $cat_type=$rowcat["category"]; 
    $options.="<OPTION VALUE=\"$cat_type\">".$cat_type. '</option>';
}

// Select Storyorder  
$queryord = "SELECT storyorder FROM w_content 
       	  ORDER BY storyorder ASC
	         ";
$resultord = mysql_query($queryord);
while ($roword = mysql_fetch_array($resultord)) 

{
    $order=$roword["storyorder"]; 
    $options_ord.="<OPTION VALUE=\"$cat_type\">".$order. '</option>';
}
?>
    </h2></td>
    <td><A href="javascript: openwindow()"><span style="color:#d80e0e; font-size:15px; ">UPLOAD PHOTOGRAPH</span></A></td>
    </tr>
  <tr>
    <td>
    
<!--HTML BEGINS ----------------------------------------------------------------------------->
<?php
if (!$_POST ['submit'])
{
?>

<form action="" method="post" class="iform">
<input name='id' type='hidden' value="<?php echo $id; ?>" /> 

<?php 
while($rowname = mysql_fetch_array($result))
{
?>


<ul>
<li class="ilabel">SELECT A CATEGORY</br></li>
<li>
<select name="category" class="iselect" >   
<option value="<? echo $rowname['category']?>" selected="selected"><? echo $rowname['category']?> </option>          
<?=$options?>                 
</select>
</li> 
<li>&nbsp;&nbsp;
</li>
<li class="ilabel">Choose Story order</br></li>
<li>       
<select name="storyorder" class="iselect" >   
<option value="<? echo $rowname['storyorder']?>" selected="selected"><? echo $rowname['storyorder']?> </option>          
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>              
</select>     

  
</li> 
<li>&nbsp;&nbsp;</li>
<li><label for="active">active</label><input class="itext" type="text" name="active" value="<?php echo $rowname['active']; ?>" /></li> 
<li><label for="person">person</label><input class="itext" type="text" name="person" value="<?php echo $rowname['person']; ?>" /></li> 
<li><label for="title">Story Title</label><input class="itext" type="text" name="title" value="<?php echo $rowname['title']; ?>"/></li> 
<li><label for="storyintro">Story Intro</label><textarea class="itextarea" name="storyintro" cols="" rows="10"><?php echo $rowname['storyintro']; ?></textarea></li>
<li><label for="story">Story</label><textarea class="itextarea" name="story" rows="50"> <?php echo htmlspecialchars($rowname['story']); ?> </textarea></li> 
<li><label for="button">Button Name</label><input class="itext" type="text" name="button" value="<?php echo $rowname['button']; ?>"/></li> 
<li><label for="link">Link</label><input class="itext" type="text" name="link" value="<?php echo $rowname['link']; ?>"/></li> 
<li><label for="image1">Image</label><input class="itext" type="text" name="image1" value="<?php echo $rowname['image1']; ?>"/></li> 
<li><label for="img_width">Image width</label><input class="itext" type="text" name="img_width" value="<?php echo $rowname['img_width']; ?>"/></li> 
<li><label for="caption">caption</label><textarea class="itextarea" name="caption" cols="" rows="10"><?php echo $rowname['caption']; ?></textarea></li>

<li>&nbsp;&nbsp;</li>

<?php
}
?>

<li><label>&nbsp;</label><input class="ibutton" type="Submit" name="submit" value="Update" /></li>
</ul>

</form>
<?php
}
else
{	
echo 'Your record could not be located';
}
?>

<!--HTML ENDS ----------------------------------------------------------------------------->
</td>
    <td colspan="2"><?php echo $sHeader;?>
      <form method="post" action="<?=$_SERVER['REQUEST_URI']?>">
        <textarea id="elm1" name="elm1" rows="15" cols="40"><?php echo $sContent;?></textarea>
        <br />
        <input type="submit" name="save" value="Submit" />
        <input type="reset" name="reset" value="Reset" />
      </form></td>
    </tr>
  <tr>
    <td width="470">&nbsp;</td>
    <td width="96" >&nbsp;</td>
    <td width="384">&nbsp;</td>
  </tr>
  </table>

<?php
  
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

If ((!isset ($_POST['id']) || trim ($_POST['id']) == "")) 

{ 
die ('Missing Record id'); 
}


$active = $_POST[ 'active'];
$category = $_POST[ 'category'];
$storyorder = $_POST[ 'storyorder'];
$person = $_POST[ 'person'];
$title = mysql_escape_string ($_POST[ 'title']);
$image1 = $_POST[ 'image1'];
$img_width = $_POST[ 'img_width'];
$storyintro = mysql_escape_string ($_POST[ 'storyintro']);
$story = mysql_escape_string ($_POST[ 'story']);
$button = $_POST[ 'button'];
$link = $_POST[ 'link'];
$caption = mysql_escape_string ($_POST[ 'caption']);	

if (sizeof($errorList) == 0)

{
	
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');



$query = "UPDATE w_content SET 
active='$active',
category='$category',
storyorder='$storyorder',
person='$person',
title='$title',
image1='$image1',
img_width='$img_width',
storyintro='$storyintro',
story='$story',
button='$button',
link='$link',
caption='$caption',
dateupdated= NOW() 
WHERE id = '$id'
";



$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

?>

<p></br><a href="http://www.wildsidesa.co.za/cms-wildside/content_manager/contentmanager.php?q=%" >Update Successful - Go to the content list</a></p>
 
<? 
	
mysql_close($connection);

}

else
{
?>

<div class="div960backgroundnone">
<a href="<?php echo $_SERVER['http_referrer']; ?>" style="padding-left:15px;"><img name="" src="../css/linkback.png" width="40" height="40" alt=""/></a>
<a href="<?php echo $_SERVER['http_referrer']; ?>"><i style="color:#FFF; padding-left:5px;">GO BACK TO FORM ENTRY</i></a></td></br></br></div>

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
echo '<body></br></br><div class="containerdb"><h2>&nbsp;&nbsp;Please, <a href="../home.php">login</a> and come back later!</h2>' ;
}
?>
</div>
</body>
</html>
