<?php

session_start();

if(!isset($_SESSION['email'])){
	header('location:index.php');
  }

require('config/databaseConfig.php');





?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Olympic System</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/CSS.css" />
    <link rel="stylesheet" href="css/custom.css" />
	    <link rel="stylesheet" href="adminlte.min.css" />


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" />

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
  <body>
    <div class="wrapper">
    <?php include "includes/menu.php"; ?>

      <div class="main_content">

      <div class="header">
     
        </div>

   
        
        <div class="info">
			

				
			   <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
            <?php $result=mysqli_query($conn, "SELECT count(*) as total from liked_videos");
					$data=mysqli_fetch_assoc($result);
					?>
					                <h2><?php   echo $data['total'] ; ?> </h2>

                <p>Total Of Likes</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
					<?php $result=mysqli_query($conn, "SELECT count(*) as total from event");
					$data=mysqli_fetch_assoc($result);
					?>
					                <h2><?php   echo $data['total'] ?> </h2>
                <p>Total Online Videos</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php $result=mysqli_query($conn, "SELECT count(*) as total from user");
					$data=mysqli_fetch_assoc($result);
					?>
					                <h2><?php  echo round($data['total'] , 2); ?> </h2>
                <p>Total Number Of Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
     
			
  
      
        </div>
      </div>
    </div>



      <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

    <script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"helper/fetch_loans.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
	}
	
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
  
  
 
	
	$(document).on('click', '.delete', function(){
     var id = $(this).attr("id");
	 
		 swal({
			  title: "Are you sure?",
			  text: "The loan will be permantely Deleted!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			    $.ajax({
				method: 'GET',
				data: {'delete': true, 'loan_id' : id },
				url: 'helper/action.php',
				success: function(data) {
						swal("Poof! Your  Loan has been Deleted!", {
										  icon: "success",
										  
				});

			window.setTimeout(function(){location.reload()},1500);

				}

			});
			  } else {
				swal(" Your  Loan could Not be Deleted!");
			  }
			});

 });
 
 
 $(document).on('click', '.view', function(){
            var omang_id = $(this).attr("id");
            profile_data(omang_id);
 });



	  function profile_data(omang_id)
     {
    	 
    	 var url = "customer_profile.php";
    
          $.ajax({
               url:url,
               method:"GET",
               data:{omang_id,omang_id},
               success:function(data)
               {
            	  
            	   
                    window.location =url+"?omang_id="+omang_id; 
            		
               }
          });
     }
    	
 
 
  
  $(document).on('click', '#create_excel', function(){
    var excel_data = $('#employee_table').html();  
           var page = 'excel.php?data=' + excel_data;  
           window.location = page; 
  });

  

		  $(document).on('click', '.pay', function(){
            var id = $(this).attr("id");
            var omang_id = $(this).attr("omang_id");

    pay_loan_data(id,omang_id);
 });



	  function pay_loan_data(id,omang_id)
 {
	 
	 var url = "pay_loan.php";

  $.ajax({
   url:url,
   method:"GET",
   data:{id:id,omang_id,omang_id},
   success:function(data)
   {
	  
	   
        window.location =url+"?id="+id+"&omang_id="+omang_id; 
	   

		
   }
  });
 }
	
	  $(document).on('click', '.edit', function(){
  var id = $(this).attr("id");
     update_loan_data(id);
 });


	  function update_loan_data(id)
 {
	 
	 var url = "update_loan.php";

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
  function fetch_post_data(id)
 {
	 
	 var url = "Receipt.php";

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

 
 
 
 $(document).on('click', '.print', function(){
  var id = $(this).attr("id");
  fetch_post_data(id);
 });

});

</script>



  </body>
  
  
</html>

