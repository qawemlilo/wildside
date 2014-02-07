<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CMS</title>

<link href="../css/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="../css/bootstrap/js/bootstrap.js"></script>
<script>
function createRequestObject(){
var request_o;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_o = new ActiveXObject("Microsoft.XMLHTTP");
}else{
request_o = new XMLHttpRequest();
}
return request_o;
}

var http = createRequestObject(); 

function liveSearch()
{
var url = "/cms-wildside/search/livesearch.php";
var s = document.getElementById('qsearch').value;
var params = "&s="+s;
http.open("POST", url, true);

http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.setRequestHeader("Content-length", params.length);
http.setRequestHeader("Connection", "close");

http.onreadystatechange = function() {
if(http.readyState == 4 && http.status != 200) {
document.getElementById('searchResults').innerHTML='<li>Loading...</li>';
}
if(http.readyState == 4 && http.status == 200) {
document.getElementById('searchResults').innerHTML = http.responseText; 
} 
}
http.send(params);
}

function liveSearch1()
{
var url = "/cms-wildside/search/livesearch1.php";
var s = document.getElementById('qsearch1').value;
var params = "&s="+s;
http.open("POST", url, true);

http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
http.setRequestHeader("Content-length", params.length);
http.setRequestHeader("Connection", "close");

http.onreadystatechange = function() {
if(http.readyState == 4 && http.status != 200) {
document.getElementById('searchResults1').innerHTML='<li>Loading...</li>';
}
if(http.readyState == 4 && http.status == 200) {
document.getElementById('searchResults1').innerHTML = http.responseText; 
} 
}
http.send(params);
}

function sendToSearch1(str){
document.getElementById('qsearch1').value = str;
document.getElementById('searchResults1').innerHTML = "";
}

function sendToSearch(str){
document.getElementById('qsearch').value = str;
document.getElementById('searchResults').innerHTML = "";
}
</script>

</head>

<body>


 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">WILDSIDE MAGAZINE&nbsp;&nbsp;&nbsp;&nbsp; </a>
          <div class="nav-collapse collapse">
           <ul class="nav">
           
 <?php
	if(isset($_SESSION['id']))
	{echo "<li class='active'><a href='#'>Hello, ".$_SESSION['usr']."&nbsp;&nbsp; You are logged in!</a></li>";
}
	else {echo '<li><a href="../home.php">Please login and come back later!</a> </li>';}
    ?>
    </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>