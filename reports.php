<?php
session_start();

if(!isset($_SESSION['email'])){
	header('location:index.php');
  }


require_once("config/databaseConfig.php");


         $sql ="select role, count(role) as count from user group by role";
		

         $result = mysqli_query($conn,$sql);
		 
		  


         $chart_data="";
         while ($row = mysqli_fetch_array($result)) { 
 
            $roles[]  = $row['role']  ;
            $totals[] =$row['count'] ;
        }

	
	
                	
                	
            

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>olympics System</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/CSS.css" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="css/custom.css" />
    <link rel="stylesheet" href="css/jquery-ui.css" />


  
    <link rel="stylesheet" href="css/fontawesome.css" />
    <script src="js/fontawesome.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/b99e675b6e.js"></script>
	
	
  </head>

  
  <body>
    <div class="wrapper">
    <?php include "includes/menu.php"; ?>

      <div class="main_content">
        <div class="header">
			<div class="info">







            	<div style="width:70%;height:25%;text-align:center">
				<div><h1>REPORT OF SYSTEM USERS</h1></h1> </div>
				<canvas  id="chartjs_bar"></canvas> 
			</div>   

         
        




          </div>
          
          
 

			</div>
		  </div>
		</div>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="js/index.js"></script>
	      <script src="//code.jquery.com/jquery-1.9.1.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	      <script type="text/javascript">
          var ctx = document.getElementById("chartjs_bar").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels:<?php echo json_encode($roles); ?>,
                            datasets: [{
                                backgroundColor: [
                                   "#5969ff",
                                    "#ff407b",
                                    "#25d5f2",
                                    "#ffc750",
                                    "#2ec551",
                                    "#7040fa",
                                    "#ff004e"
                                ],
                                data:<?php echo json_encode($totals); ?>,
                            }]
                        },
                        options: {
                               legend: {
                            display: true,
                            position: 'bottom',
     
                            labels: {
                                fontColor: '#71748d',
                                fontFamily: 'Circular Std Book',
                                fontSize: 14,
                            }
                        },
     
     
                    }
                    });
        </script>
		


  </body>
</html>
