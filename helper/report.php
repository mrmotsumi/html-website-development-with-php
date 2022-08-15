<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM loan 
	WHERE OmangId LIKE '%".$search."'
	";
}
else
{
	$query = "
	SELECT sum(l.amount) as totalLoaned, sum(l.interest) as totalinterests, sum(t.amount) as totalincome FROM loan l, transaction t";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);

$curentDate = date("Y-m-d");

$colorFlag = "";
$loanStatus = "";
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive" id="employee_table">
					<table class="table table bordered">
					<div align="center">  
                     <button name="create_excel" id="create_excel" class="btn btn-success">Create Excel File</button>  
		  </div> 	
					<tr>
							<th>Loan No</th>
							<th>ID No</th>
							<th>Principal</th>
							<th>Rate</th>
							<th>interest</th>
							<th>Total Loan</th>
							<th>Payed</th>
							<th>Due Amount</th>
                            <th>Issue Date</th>
							<th>Due Date</th>
							<th>Days Remaining</th>
							<th>Status</th>

						</tr>';
	while($row = mysqli_fetch_array($result))
	{


		$rowNum= $row['loanId'];


	
	$amountQuery="SELECT SUM(transaction.amount) as payedAmount  from transaction,loan where transaction.loanId='$rowNum' AND loan.loanId='$rowNum'";
	$Queryresult = mysqli_query($conn, $amountQuery);
	$Queryrow = mysqli_num_rows($Queryresult);

	while($Queryrow =mysqli_fetch_array($Queryresult)){

	

	$days=	( strtotime($row['endDate']) - strtotime($curentDate))/60/60/24;
	
	$amountpayable= $row['amount'] + $row['interest'];
	
	  $dueamount =$amountpayable -$Queryrow["payedAmount"]; 
	  
	
	 
	 $output .= '
			<tr>
				<td>'.$row["loanId"].'</td>
				<td>'.$row["OmangId"].'</td>
				<td>'.$row["amount"].'</td>
				<td>'.$row["interestRate"].'%</td>
				<td>'.$row["interest"].'</td>
				<td>'.$amountpayable.'</td>
				<td>'.$Queryrow["payedAmount"].'</td>
				<td>'.$dueamount.'</td>

                <td>'.$row["startDate"].'</td>
				<td>'.$row["endDate"].'</td>
				<td>'.$days.'</td>
				<td>'.$row["loanstatus"].'</td>	

				
			</tr>

			
		';
	}
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}

?>