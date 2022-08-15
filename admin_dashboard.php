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
	  <?php include("includes/menu.php"); ?>
      </div>
  <div class="main_content" >
        <div class="info">
   
   
   
   <?php 
   
   $query = "select * from event";
   $result = mysqli_query($conn, $query);
   $row = mysqli_num_rows($result);
   
   
   if(mysqli_num_rows($result) > 0)
{

	while($row = mysqli_fetch_array($result))
	{ 
   ?>
    
    <div class="card-group">
        
  <div class="card">
      <video  class="card-img-top" controls>
  <source src="<?php echo  $row["url"] ?>" type="video/mp4">
</video>
    <div class="card-body">
      <h5 class="card-title"><?php echo  $row["title"] ?></h5>
      <p class="card-text"><?php echo  $row["details"] ?></p>

	<button type="button"  name="delete" class="btn btn-primary btn-xs delete" id="<?php echo  $row["id"] ?>"><i class="fas fa-trash-alt"></i></button>
	

	

    </div>

  </div>
 
 

</div>
  
  
  <?php }  } ?>    
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
 
  
  $(document).on('click', '.like', function(){
  var like_id = $(this).attr("id");
  
  console.log(like_id)

	
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
				data: {'delete': true, 'like_id' : like_id },
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
 
 
 
 
   
    
  $(document).on('click', '.delete', function(){
  var event_id = $(this).attr("id");
 
	
		 swal({
			  title: "Completely Delete video?",
			  text: "Delete Video from thesystem!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			    $.ajax({
				method: 'GET',
				data: {'delete': true, 'event_id' : event_id },
				url: 'action.php',
				success: function(data) {
						swal("Proof! Video will completely be removed!!", {
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

