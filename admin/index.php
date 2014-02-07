<?php

define('INCLUDE_CHECK',true);

require 'connect.php';
require 'functions.php';
// Those two files can be included only if INCLUDE_CHECK is defined


session_name('tzLogin');
// Starting the session

session_set_cookie_params(2*7*24*60*60);
// Making the cookie live for 2 weeks

session_start();

if($_SESSION['id'] && !isset($_COOKIE['tzRemember']) && !$_SESSION['rememberMe'])
{
	// If you are logged in, but you don't have the tzRemember cookie (browser restart)
	// and you have not checked the rememberMe checkbox:

	$_SESSION = array();
	session_destroy();
	
	// Destroy the session
}


if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php");
	exit;
}

if($_POST['submit']=='Login')
{
	// Checking whether the Login form has been submitted
	
	$err = array();
	// Will hold our errors
	
	
	if(!$_POST['username'] || !$_POST['password'])
		$err[] = 'All the fields must be filled in!';
	
	if(!count($err))
	{
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		$_POST['password'] = mysql_real_escape_string($_POST['password']);
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];
		
		// Escaping all input data

		$row = mysql_fetch_assoc(mysql_query("SELECT id,usr FROM login WHERE usr='".($_POST['username'])."' AND pass='".($_POST['password'])."'"));

		if($row['usr'])
		{
			// If everything is OK login
			
			$_SESSION['usr']=$row['usr'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
			
			// Store some data in the session
			
			setcookie('tzRemember',$_POST['rememberMe']);
		}
		else $err[]='Wrong username and/or password!';
	}
	
	if($err)
	$_SESSION['msg']['login-err'] = implode('<br />',$err);
	// Save the error messages in the session

	header("Location: index.php");
	exit;
}
else if($_POST['submit']=='Send')
{
	// If the Register form has been submitted
	
	$err = array();
	
	if(strlen($_POST['username'])<4 || strlen($_POST['username'])>100)
	{
		$err[]='Your username must be between 3 and 100 characters!';
	}
	
	if(!checkEmail($_POST['username']))
	{
		$err[]='Your username contains invalid characters!';
	}
	
	if(!checkEmail($_POST['email']))
	{
		$err[]='Your email is not valid!';
	}
	
	if(!count($err))
	{
		// If there are no errors
		
		
		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		// Escape the input data
		
		
	$sql="SELECT pass, email FROM login WHERE usr='".$_POST['username']."'";
$r = mysql_query($sql);
if(!$r) {

    $err=mysql_error();

    print $err;

    exit();
}

if(mysql_affected_rows()==0){

    print "no such login in the system. please try again.";

    exit();
}
else {

    $row=mysql_fetch_row($r);

    $password=$row[0];

    $email= $row[3];

    $subject="Artisan Login";

    $header="from:rod@lightship.co.za";

    $message= $email."Hi - Your password is -  " . $password;
	
send_mail(	'rod@lightship.co.za',
						$_POST['email'],
						'Artisan Contemporary Gallery - Your Password',
						$message);


   $_SESSION['msg']['reg-success']='We sent you an email with your new password!';

}
}

	if(count($err))
	{
		$_SESSION['msg']['reg-err'] = implode('<br />',$err);
	}	
	
	header("Location: index.php");
	exit;
}

$script = '';

if($_SESSION['msg'])
{
	// The script below shows the sliding panel on page load
	
	$script = '
	<script type="text/javascript">
	
		$(function(){
		
			$("div#panel").show();
			$("#toggle a").toggle();
		});
	
	</script>';
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Content Management</title>
    
    <link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="admin.css" media="screen" />
    <link type="text/css" rel="stylesheet" href="css/style.css" media="all" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="login_panel/js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    
    <script src="login_panel/js/slide.js" type="text/javascript"></script>
    <script>
     function show(ele) {
         var srcElement = document.getElementById(ele);
         if(srcElement != null) {
	   if(srcElement.style.display == "block") {
     		  srcElement.style.display= 'none';
   	    }
            else {
                   srcElement.style.display='block';
            }
            return false;
       }
  }
  </script>  
    
    <?php echo $script; ?>
</head>

<body>

<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>CRM</h1>
                <h4>created for:</h4>
				<h2><?php $companyname = 'Wildside' ; echo $companyname;?> </h2>
				<p class="grey"></p>
			</div>
            
            
            <?php
			
			if(!$_SESSION['id']):
			
			?>
            
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="<?= $_SERVER['PHP_SELF']?>" method="post">
					<h1>Member Login</h1>
                    
                    <?php
						
						if($_SESSION['msg']['login-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['login-err'].'</div>';
							unset($_SESSION['msg']['login-err']);
						}
					?>
					
					<label class="grey" for="username">Username:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="password">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
	            	<label><input name="rememberMe" id="rememberMe" type="checkbox" checked="checked" value="1" /> &nbsp;Remember me</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login" />
				</form>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form action="<?= $_SERVER['PHP_SELF']?>" method="post">
					<h1>Forgot your password?</h1><h4> Fill in your email and we will send it to you!</h4>		
                    
                    <?php
						
						if($_SESSION['msg']['reg-err'])
						{
							echo '<div class="err">'.$_SESSION['msg']['reg-err'].'</div>';
							unset($_SESSION['msg']['reg-err']);
						}
						
						if($_SESSION['msg']['reg-success'])
						{
							echo '<div class="success">'.$_SESSION['msg']['reg-success'].'</div>';
							unset($_SESSION['msg']['reg-success']);
						}
					?>
				<label class="grey" for="username">Username (Your email):</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="email">Comfirm Email:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
					<label>Your password will be e-mailed to you.</label>
					<input type="submit" name="submit" value="Send" class="bt_register" />
				</form>
			</div>
            
            <?php
			
			else:
			
			?>
            
            <div class="left">
            
            <h1>Members panel</h1>
            
            <p><?php echo $companyname;?></p>
            <p>- or -</p>
            <a href="?logoff">Log off</a>
            
            </div>
            
            <div class="left right">
            </div>
            
            <?php
			endif;
			?>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Hello <?php echo $_SESSION['usr'] ? $_SESSION['usr'] : 'Guest';?>!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#" ><?php echo $_SESSION['id']?'Open Panel':'Log In';?></a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div>

<?php include 'my_sidebar.php';?>

<div class="content">
    <div id="main">
      <div class="container">
      <div class=" divleftcontainer">
		<span class="headingarge">* &nbsp; <?php echo $companyname;?></span>
       </div>
       <div class=" divleftcontainer">
        <h3 style="font-stretch:extra-expanded;">Content Management </h3>
        <p>&nbsp;</p>
        </div>
        </div>
        
        
        
        <div class="container">
        
        <?php 
if($_SESSION['id'])

{
?>        
        
        
<p>&nbsp;</p>
<p><a href="my_home.php" >Home page</a></p>
<p><a href="my_banner.php" >Banner</a></p>
<p><a href="my_content.php" >Content</a></p>
<p><a href="my_webvisitor.php" >Web Visitors</a></p>
<p><a href="my_subscribers.php" >Subscribers</a></p>
<p><a href="my_cart.php" >Shop</a></p>

<A href="#" onclick="show('pic')">Image Upload</A> 
<br/>
<DIV ID="pic" style="display:none">
<br/><br/><br/>
<?php include '../content/img/thumbnail.php';?>
<br/><br/><br/>
</DIV>
<br/>

<A href="#" onclick="show('mysqlsetup')">+ Php Mysql Setup</A> 
<br/>
<DIV ID="mysqlsetup" style="display:none">
<br/><br/><br/>
<?php include 'phpMyEditSetup.php';?>
</DIV>



<br/><br/>
<p>Only accessible by registered users.</p>
<p>&nbsp;</p>

<?
       
}
else
{
?>
<div class="clear"></div>
<h1>Please,<span style="color:#C0C0C0"> log in.</span></h1>
<h2 style="color:#C0C0C0"> CLICK ON THE LOGIN BUTTON AT THE TOP OF THE PAGE</h2>
	   
</div>
</div>
</div>
<?	
}
?>

</body>
</html>
