<?php
define('INCLUDE_CHECK',true);

require '../connect.php';

session_name('tzLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

  </head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#" style="color:#BD6135; font-size:15px; font-weight:200;">Wildside Magazine Email Client</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><?php
	if($_SESSION['id'])
	{
	echo '<a href="#">Hello, '.$_SESSION['usr'].'&nbsp;&nbsp; You are registered and logged in!</a>';
	}
	else 
	{
	echo '<a href="#">Please, login <a href="../home.php">login</a> and come back later!</a>';
	}
    ?></a></li>
              <li><a href="#about">About</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
<div class="container">