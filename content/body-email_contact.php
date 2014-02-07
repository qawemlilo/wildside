
<!DOCTYPE HTML>  
<html>  
<head>  
    <title>My basic contact form</title> 
     <link href="assets/css/bootstrap.css" rel="stylesheet"> 
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">  
</head>  
<body>  
<div class="container">  
<div class="page-header"><h1>Contact</h1></div>
<div class="row-fluid">  
<div class="span12">      
<?php
if(isset($_POST['Submit']))
{

$name=trim($_POST["name"]);
$number=trim($_POST["number"]);
$email=trim($_POST["email"]);
$comment=trim($_POST["comment"]);
$reason=trim($_POST["reason"]);

if($name == "" ) {
$error= "<div class='alert alert-error'><strong>Oops.</strong> You did not enter a name.</div>";
$code= "1" ;
}


elseif($reason == "" ) {
$error= "<div class='alert alert-error'><strong>Oops.</strong>  You did not select a reason for your enquiry.</div>";
$code= "1";
}

elseif($number == "" ) {
$error= "<div class='alert alert-error'><strong>Oops.</strong>  Please enter number.</div>";
$code= "2";
}

//check if the number field is numeric
elseif(is_numeric(trim($_POST["number"])) == false ) {
$error= "<div class='alert alert-error'><strong>Oops.</strong> Please enter numeric value.</div>";
$code= "2";
}

elseif(strlen($number)<5) {
$error= "<div class='alert alert-error'><strong>Oops.</strong> Number should be five digits.</div>";
$code= "2";
}

//check if email field is empty
elseif($email == "" ) {
$error= "<div class='alert alert-error'><strong>Oops.</strong> You did not enter a email.</div>";
$code= "3";
} //check for valid email 
elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
$error= "<div class='alert alert-error'><strong>Oops.</strong> You did not enter a valid email.</div>";
$code= "3";
}

elseif($comment == "" ) {
$error= "<div class='alert alert-error'><strong>Oops.</strong>  You did not enter a comment.</div>";
$code= "4";
}

else{
	
//Succesfull submission	

$name.'<br/>';
$number.'<br/>';
$email.'<br/>';
$comment.'<br/>';
$reason.'<br/>';


if (isset($_POST['Submit'])) {



//define the sender name of the email 
$sendername = $_POST['visitorname']; 
//define the sender name of the email 
$senderemail = $_POST['visitoremail']; 
//define the receiver of the email 
$to = 'rod@lightship.co.za';
$visitorfriendname = $_POST['visitorfriendname']; ;  
//define the subject of the email 
$subject = 'Musgarve Methodist Web Form Submission - $name'; 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash 
$random_hash = md5(date('r', time())); 
//define the headers we want passed. Note that they are separated with \r\n 
$headers = "From: info@musgravemethodist.co.za\r\nReply-To: info@musgravemethodist.co.za"; 
//add boundary string and mime type specification 
$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 


//define the body of the message. 
ob_start(); //Turn on output buffering 
?> 
--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>" 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<!-- HTML here -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <!-- Facebook sharing information tags -->
        <meta property="og:title" content="*|MC:SUBJECT|*" />
        
        <title>*|MC:SUBJECT|*</title>
		<style type="text/css">
			/* Client-specific Styles */
			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
			body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
			body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

			/* Reset Styles */
			body{margin:0; padding:0;}
			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
			table td{border-collapse:collapse;}
			#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}

			/* Template Styles */

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: COMMON PAGE ELEMENTS /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Page
			* @section background color
			* @tip Set the background color for your email. You may want to choose one that matches your company's branding.
			* @theme page
			*/
			body, #backgroundTable{
				/*@editable*/ background-color:#FAFAFA;
			}

			/**
			* @tab Page
			* @section email border
			* @tip Set the border for your email.
			*/
			#templateContainer{
				/*@editable*/ border: 1px solid #DDDDDD;
			}

			/**
			* @tab Page
			* @section heading 1
			* @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
			* @style heading 1
			*/
			h1, .h1{
				/*@editable*/ color:#202020;
				display:block;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:34px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Page
			* @section heading 2
			* @tip Set the styling for all second-level headings in your emails.
			* @style heading 2
			*/
			h2, .h2{
				/*@editable*/ color:#202020;
				display:block;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:30px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Page
			* @section heading 3
			* @tip Set the styling for all third-level headings in your emails.
			* @style heading 3
			*/
			h3, .h3{
				/*@editable*/ color:#202020;
				display:block;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:26px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Page
			* @section heading 4
			* @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
			* @style heading 4
			*/
			h4, .h4{
				/*@editable*/ color:#202020;
				display:block;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:22px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				margin-top:0;
				margin-right:0;
				margin-bottom:10px;
				margin-left:0;
				/*@editable*/ text-align:left;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: PREHEADER /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Header
			* @section preheader style
			* @tip Set the background color for your email's preheader area.
			* @theme page
			*/
			#templatePreheader{
				/*@editable*/ background-color:#FAFAFA;
			}

			/**
			* @tab Header
			* @section preheader text
			* @tip Set the styling for your email's preheader text. Choose a size and color that is easy to read.
			*/
			.preheaderContent div{
				/*@editable*/ color:#505050;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:10px;
				/*@editable*/ line-height:100%;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Header
			* @section preheader link
			* @tip Set the styling for your email's preheader links. Choose a color that helps them stand out from your text.
			*/
			.preheaderContent div a:link, .preheaderContent div a:visited, /* Yahoo! Mail Override */ .preheaderContent div a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:#336699;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			.preheaderContent img{
				display:inline;
				height:auto;
				margin-bottom:10px;
				max-width:280px;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: HEADER /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Header
			* @section header style
			* @tip Set the background color and border for your email's header area.
			* @theme header
			*/
			#templateHeader{
				/*@editable*/ background-color:#FFFFFF;
				/*@editable*/ border-bottom:0;
			}

			/**
			* @tab Header
			* @section header text
			* @tip Set the styling for your email's header text. Choose a size and color that is easy to read.
			*/
			.headerContent{
				/*@editable*/ color:#202020;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:34px;
				/*@editable*/ font-weight:bold;
				/*@editable*/ line-height:100%;
				/*@editable*/ padding:0;
				/*@editable*/ text-align:center;
				/*@editable*/ vertical-align:middle;
			}

			/**
			* @tab Header
			* @section header link
			* @tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.
			*/
			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:#336699;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			#headerImage{
				height:auto;
				max-width:320px !important;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: MAIN BODY /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Body
			* @section body style
			* @tip Set the background color for your email's body area.
			*/
			#templateContainer, .bodyContent{
				/*@editable*/ background-color:#FFFFFF;
			}

			/**
			* @tab Body
			* @section body text
			* @tip Set the styling for your email's main content text. Choose a size and color that is easy to read.
			* @theme main
			*/
			.bodyContent div{
				/*@editable*/ color:#505050;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:12px;
				/*@editable*/ line-height:150%;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Body
			* @section body link
			* @tip Set the styling for your email's main content links. Choose a color that helps them stand out from your text.
			*/
			.bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:#336699;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			.bodyContent img{
				display:inline;
				height:auto;
				margin-bottom:10px;
				max-width:280px;
			}

			/* /\/\/\/\/\/\/\/\/\/\ STANDARD STYLING: FOOTER /\/\/\/\/\/\/\/\/\/\ */

			/**
			* @tab Footer
			* @section footer style
			* @tip Set the background color and top border for your email's footer area.
			* @theme footer
			*/
			#templateFooter{
				/*@editable*/ background-color:#FFFFFF;
				/*@editable*/ border-top:0;
			}

			/**
			* @tab Footer
			* @section footer text
			* @tip Set the styling for your email's footer text. Choose a size and color that is easy to read.
			* @theme footer
			*/
			.footerContent div{
				/*@editable*/ color:#707070;
				/*@editable*/ font-family:Arial;
				/*@editable*/ font-size:11px;
				/*@editable*/ line-height:150%;
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Footer
			* @section footer link
			* @tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.
			*/
			.footerContent div a:link, .footerContent div a:visited, /* Yahoo! Mail Override */ .footerContent div a .yshortcuts /* Yahoo! Mail Override */{
				/*@editable*/ color:#336699;
				/*@editable*/ font-weight:normal;
				/*@editable*/ text-decoration:underline;
			}

			.footerContent img{
				display:inline;
				height:auto;
				margin-bottom:10px;
				max-width:280px;
			}

			/**
			* @tab Footer
			* @section social bar style
			* @tip Set the background color and border for your email's footer social bar.
			* @theme footer
			*/
			#social{
				/*@editable*/ background-color:#FAFAFA;
				/*@editable*/ border:0;
			}

			/**
			* @tab Footer
			* @section social bar style
			* @tip Set the background color and border for your email's footer social bar.
			*/
			#social div{
				/*@editable*/ text-align:left;
			}

			/**
			* @tab Footer
			* @section utility bar style
			* @tip Set the background color and border for your email's footer utility bar.
			* @theme footer
			*/
			#utility{
				/*@editable*/ background-color:#FFFFFF;
				/*@editable*/ border:0;
			}

			/**
			* @tab Footer
			* @section utility bar style
			* @tip Set the background color and border for your email's footer utility bar.
			*/
			#utility div{
				/*@editable*/ text-align:left;
			}
		</style>
	</head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    	<center>
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable">
            	<tr>
                	<td align="center" valign="top">
                        <!-- // Begin Template Preheader \\ -->
                        <table border="0" cellpadding="10" cellspacing="0" width="320" id="templatePreheader">
                            <tr>
                                <td valign="top" class="preheaderContent">
                                
                                	<!-- // Begin Module: Standard Mobile Preheader \\ -->
                                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                    	<tr>
                                        	<td valign="top">
                                            	<div>
                                                	 You have received a message from the MMC website.
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                	<!-- // End Module: Standard Mobile Preheader \\ -->
                                
                                </td>
                            </tr>
                        </table>
                        <!-- // End Template Preheader \\ -->
                    	<table border="0" cellpadding="0" cellspacing="0" width="320" id="templateContainer">
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Header \\ -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="320" id="templateHeader">
                                        <tr>
                                            <td class="headerContent">
                                            
                                            	<!-- // Begin Module: Standard Header Image \\ -->
                                            	<img src="http://www.musgravemethodist.co.za/assets/img/mmclogo_dark.png" style="max-width:320px;" />
                                            	<!-- // End Module: Standard Header Image \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Header \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Body \\ -->
                                	<table border="0" cellpadding="0" cellspacing="0" width="320" id="templateBody">
                                    	<tr>
                                            <td valign="top" class="bodyContent">
                                
                                                <!-- // Begin Module: Standard Postcard Content \\ -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr mc:repeatable>
                                                        <td valign="top">
                                                       	  <div mc:edit="photoblog_heading00">
                                                                <h1 class="h1">Web Message</h1>
                                                            </div>
                                                       	  <div mc:edit="std_content00">
                                                            
<h4>Senders Name</h4>
<p><?php echo $name ?></p>
<h4>Senders Email</h4>
<p><?php echo $email ?></p>
<h4>Contact Number</h4>
<p><?php echo $number ?></p>
<h4>Reason for Message</h4>
<p><?php echo $reason ?></p>
<h4>Message</h4>
<p><?php echo $comment ?></p>                                </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Postcard Content \\ -->
                                                
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Body \\ -->
                                </td>
                            </tr>
                        	<tr>
                            	<td align="center" valign="top">
                                    <!-- // Begin Template Footer \\ -->
                                	<table border="0" cellpadding="10" cellspacing="0" width="320" id="templateFooter">
                                    	<tr>
                                        	<td valign="top" class="footerContent">
                                            
                                                <!-- // Begin Module: Standard Footer \\ --><!-- // End Module: Standard Footer \\ -->
                                            
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Footer \\ -->
                                </td>
                            </tr>
                        </table>
                        <br />
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>


<!-- HTML End -->       

--PHP-alt-<?php echo $random_hash; ?>-- 



<?php 
//copy current buffer contents into $message variable and delete current output buffer 
$message = ob_get_clean(); 
//send the email 
$mail_sent = @mail( $to, $subject, $message, $headers ); 
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
?>
<div class='container'>
<?php echo $mail_sent ? 
'
<div class="alert alert-info">
<strong>Thanks.</strong> Your email has been sent.
</div>
<div class="alert alert-error">
<strong>Personal Details. </strong> All your details will treated as confidential.
</div>
'

: "Mail failed"; 


}


}
}
?>

<?php if (isset($error)) { echo "<p class='message'>" .$error. "</p>" ;} ?>

<form action="<?php $_SERVER ['PHP_SELF']; ?>" method="post" >

<label>Name</label>
<input name= "name" type= "text" value="<?php if(isset($name)){echo $name;} ?>" <?php if(isset($code) && $code == 1){echo "class=error" ;} ?> ><br/>

<label>Cell</label>
<input name= "number" type= "text" id= "number" value="<?php if(isset($number)){echo $number;} ?>" <?php if(isset($code) && $code == 2){echo "class=error" ;}?> >

<label>Email</label> 
<input name= "email" type= "text" id= "email" value="<?php if(isset($email)){echo $email; }?>" <?php if(isset($code) && $code == 3){echo "class=error" ;}?> >

<label>Reason</label>
<select name="reason" >
      <option>Prayer Request</option>
      <option>I would like to book an appointment with the minister</option>
      <option>General Enquiry</option>
      <option>Wedding Enquiry</option>
</select>

<label>Your Message</label>
<textarea rows="3"  class="input-large" type="" name= "comment" value="<?php if(isset($comment)){echo $comment;} ?>" <?php if(isset($code) && $code == 4){echo "class=error" ;} ?>> </textarea>


<label></label> 
<button type="submit" name= "Submit" class="btn">Submit</button>

</form>


</div>        
</div>                     
</div>  


          
</body>  
</html>  