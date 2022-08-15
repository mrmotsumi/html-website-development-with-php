<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM transaction 
	WHERE omang_id LIKE '%".$search."'
	";
} else  if(isset($_POST["from_date"], $_POST["to_date"]))  
{ 
	$query = "  
           SELECT * FROM transaction 
           WHERE  	transDate BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
      "; 
}
else
{
	$query = "
	SELECT * FROM transaction ORDER BY transDate";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);

$curentDate = date("Y-m-d");


if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive" id="employee_table">
					 
	      <table class="table table bordered" >
			
					<tr>
							<th>Transaction ID</th>
							<th>Customer ID</th>
							<th>Loan Number</th>
							<th>Amount Received</th>
                            <th>Transaction Date</th>

						</tr>';
	while($row = mysqli_fetch_array($result))
	{

	
	  
	 $output .= '
			<tr>
				<td>'.$row["transID"].'</td>
				<td>'.$row["omang_id"].'</td>
				<td>'.$row["loanId"].'</td>
				<td>'.$row["amount"].'</td>
                <td>'.$row["transDate"].'</td>
			
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>