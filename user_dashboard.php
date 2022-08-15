<?php

require_once("config/databaseConfig.php");

session_start();
$user_id = $_SESSION['userid'];

if(!isset($_SESSION['userid']))
{
    
    header("location: index.html");
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Olympic System</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/CSS.css" />
    <link rel="stylesheet" href="css/custom.css" />

    <link rel="stylesheet" href="css/fontawesome.css" />
    <link rel="stylesheet" href="dist/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />   <script src="js/fontawesome.js"></script>
    <script src="js/b99e675b6e.js"></script>
    <script src="js/dialogify.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <script src="js/jquery-ui.js"></script>

    <script src="js/index.js"></script>
  </head>
  <body  >
    <div class="wrapper" >
      <div class="sidebar">
	  <?php include("includes/user_menu.php"); ?>
      </div>
  <div class="main_content" >
        <div class="header"  >
        <h2 align="center">All VIDEOS</h2><br />
        <div class="col-sm-10 col-sm-offset-2">

        </div>
        </div>
        <div class="info">
        <div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Search</span>
					<input type="text" name="search_text" id="search_text" placeholder="Search by *" class="form-control" />
				</div>
			</div>

    
			<div id="result"></div>
      
       </div>
      </div>
    </div>
 

  

  </body>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
</html>

