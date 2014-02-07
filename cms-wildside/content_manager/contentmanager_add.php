<?php
define('INCLUDE_CHECK',true);

require '../connect.php';
require '../functions.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

include 'loginstrip.php'; 

if($_SESSION['id'])
{
	if (!$_POST ['submit'])
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
    <td><h3>Online Content Manager - Add a page</h3></td>
    <td>&nbsp;</td>
    <td><A href="javascript: openwindow()"><span style="color:#d80e0e; font-size:15px; ">UPLOAD PHOTOGRAPH</span></A></tr>
  <tr>
    <td>
    <!--HTML BEGINS ----------------------------------------------------------------------------->

<?php
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');

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
?>


<form action="<?php echo  htmlentities( $_SERVER ['PHP_SELF']); ?>" method="post" class="iform">
<ul>
<li class="ilabel">SELECT A CATEGORY</br></li>
<li>
<select name="category" class="iselect" >        
<?=$options?>                 
</select>
</li> 
<li>&nbsp;&nbsp;
</li>

<li class="ilabel">Choose Story order</br></li>
<li>       
<select name="storyorder" class="iselect" > 
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

<li><select name="active" class="iselect" > 
  <option value="yes">yes</option>
  <option value="no">no</option>
</select> </li> 

<li><label for="person">person</label><input class="itext" type="text" name="person"/></li> 
<li><label for="title">Story Title</label><input class="itext" type="text" name="title"/></li> 
<li><label for="storyintro">Story Intro</label><textarea class="itextarea" name="storyintro" cols="" rows="10"></textarea></li>
<li><label for="story">Story</label><textarea class="itextarea" name="story" cols="" rows="10"></textarea></li> 
<li><label for="button">Button Name</label><input class="itext" type="text" name="button"/></li> 
<li><label for="link">Link</label><input class="itext" type="text" name="link"/></li> 
<li><label for="image1">Image</label><input class="itext" type="text" name="image1"/></li> 
<li><label for="caption">Caption</label><input class="itext" type="text" name="caption"/></li> 

<li>&nbsp;&nbsp;</li>
<li><label>&nbsp;</label><input class="ibutton" type="Submit" name="submit" value="Add record" /></li>
</ul>

</form>


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
	
$errorList = array ();

$active = $_POST['active'];
$category = $_POST['category'];
$storyorder = $_POST['storyorder'];
$person = $_POST['person'];
$title = $_POST['title'];
$image1 = $_POST['image1'];
$img_width = $_POST['img_width'];
$storyintro = $_POST['storyintro'];
$story = $_POST['story'];
$button = $_POST['button'];
$link = $_POST['link'];
$caption = $_POST['caption'];	

if (sizeof($errorList) == 0)

{

	
$connection = mysql_connect($db_host, $db_user, $db_pass) or die ('Unable to connect to server'); 
mysql_select_db($db_database) or die('Unable to select database');


$query = "INSERT INTO
w_content (
active,
category,
storyorder,
person,
title,
image1,
img_width,
storyintro,
story,
button,
link,
caption,
datecreated
)

VALUES (
'$active',
'$category',
'$storyorder',
'$person',
'$title',
'$image1',
'$img_width',
'$storyintro',
'$story',
'$button',
'$link',
'$caption',
now()
)";


$result = mysql_query($query) or die ("Error in query: $query. " . mysql_error());

echo 'ADD successful. <a href=contentmanager.php?q=%>Go back to Content Manager</a>';

mysql_close($connection);


}

else

{
	echo '<div class="containerdbbox">';
	echo '</br>';
	echo '<ul>';
	for ($x=0; $x<sizeof($errorList); $x++)
{
    echo "<li>$errorList[$x]";
}

    echo '</ul></p>';
}
}
}

else 

{
	echo '<h1>&nbsp;&nbsp;Please, <a href="demo.php">login</a> and come back later!</h1>';   	
}
?>
</div>
</div>

</body>
</html>
