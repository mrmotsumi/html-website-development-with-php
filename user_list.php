<?php
session_start();
 $role = $_SESSION['role'];


if(!isset($_SESSION['email'])){
	header('location:index.php');
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Olympics
    </title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/CSS.css" />
    <link rel="stylesheet" href="css/custom.css" />
    <link rel="stylesheet" href="css/fontawesome.css" />
    <link rel="stylesheet" href="dist/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />   <script src="js/fontawesome.js"></script>
    <script src="js/b99e675b6e.js"></script>
  </head>
  <body>
    <div class="wrapper">
    <?php include "includes/menu.php"; ?>

      <div class="main_content">
        
        <div class="info">
        <br />
			
			<h2 align="center">System Users</h2><br />
      <div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Search</span>
					<input type="text" name="search_text" id="search_text" placeholder="Search by Email Address" class="form-control" />
				</div>
			</div>
			<?php if ($role =='Admin'){?>
      <button type="button" onclick="location.href='add_user.php';" class="btn btn-primary">Add User</button>
 <?php } ?>
      <br />
			<div id="result"></div>
      
        </div>
      </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/index.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

    <script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"helper/fetch_Users.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	
	 $(document).on('click', '.delete', function(){
  var userid = $(this).attr("id");

	
		 swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this imaginary file!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			    $.ajax({
				method: 'GET',
				data: {'delete': true, 'userid' : userid },
				url: 'action.php',
				success: function(data) {
						swal("Poof! Your  file has been deleted!", {
										  icon: "success",
										  
				});

			window.setTimeout(function(){location.reload()},1500);

				}

			});
			  } else {
				swal("Your imaginary file is safe!");
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
  </body>
</html>
