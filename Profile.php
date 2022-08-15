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
    
    <style>
    
    
    body {
    background-color: #f9f9fa
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    border-radius: 5px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}
</style>

  </head>
  <body  >
    <div class="wrapper" >
      <div class="sidebar">
	  <?php include("includes/admin_menu.php"); ?>
      </div>
  <div class="main_content" >
        <div class="info">
   
   
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"> </div>
                                <h6 class="f-w-600"><?php echo $_SESSION['name']; ?></h6>
                                 <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION['email']; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION['contact_no']; ?></h6>
                                    </div>
                                </div>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Videos</h6>
                                <div class="row">
                                    
                                    <?php $result=mysqli_query($conn, "SELECT count(DISTINCT (video_id)) as total from watch_later where user_id='$user_id'");
					$data=mysqli_fetch_assoc($result);
					?>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Favorites</p>
                                        <h6 class="text-muted f-w-400"><?php echo $data['total']; ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        
                                         <?php $result=mysqli_query($conn, "SELECT count(DISTINCT (video_id)) as total from liked_videos where user_id='$user_id'");
					$data=mysqli_fetch_assoc($result);
					?>
                                        <p class="m-b-10 f-w-600">Liked</p>
                                        <h6 class="text-muted f-w-400"><?php echo $data['total']; ?></h6>
                                    </div>
                                </div>
                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  




       </div>
      </div>
    </div>
 

  

  </body>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

  <script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"helper/fetch_users.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	
	  $(document).on('click', '.book', function(){
  var id = $(this).attr("id");
     Book_bus(id);
 });


	  function Book_bus(id)
 {
	 
	 var url = "booking.php";

  $.ajax({
   url:url,
   method:"GET",
   data:{id:id},
   success:function(data)
   {
	  
	   
        window.location =url+"?id="+id; 
	
   }
  });
 }
 
  
  $(document).on('click', '.remove', function(){
  var remove_id = $(this).attr("id");
  

	
		 swal({
			  title: "Add to Likes?",
			  text: "add to your likes!",
			  icon: "success",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			    $.ajax({
				method: 'GET',
				data: {'delete': true, 'remove_id' : remove_id },
				url: 'action.php',
				success: function(data) {
						swal("Proof! Video added to your Liked playlist!!", {
										  icon: "success",
										  
				});

			window.setTimeout(function(){location.reload()},1500);

				}

			});
			  } else {
				swal("Action not Performed!");
			  }
			});

 });
 
 
 
 
   
  $(document).on('click', '.favorite', function(){
  var video_id = $(this).attr("id");

	
		 swal({
			  title: "Add to Favorites?",
			  text: "add to your Favourite List!",
			  icon: "success",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			    $.ajax({
				method: 'GET',
				data: {'delete': true, 'fav_id' : video_id },
				url: 'action.php',
				success: function(data) {
						swal("Poof! Video added to your playlist!", {
										  icon: "success",
										  
				});

			window.setTimeout(function(){location.reload()},1500);

				}

			});
			  } else {
				swal("Action not Performed!");
			  }
			});

 });
 
 
  
 
	
  
 
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
});
</script>
</html>

