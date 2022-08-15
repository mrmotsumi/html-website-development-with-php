<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM loan 
	WHERE omang_id LIKE '%".$search."%' loanstatus ='CLOSED'
	";
}
else
{
	$query = "
	SELECT * FROM loan where  loanstatus ='CLOSED' ORDER BY endDate";
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
							<th>ID No</th>
							<th>Principal</th>
							<th>interest</th>
							<th>Total Loan</th>
							<th>Payed</th>
							<th>Due Amount</th>
                            <th>Issue Date</th>
							<th>Status</th>
							<th></th>
							<th></th>


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
				<td>'.$row["omang_id"].'</td>
				<td>'.$row["amount"].'</td>
				<td>'.$row["interest"].'</td>
				<td>'.$amountpayable.'</td>
				<td>'.$Queryrow["payedAmount"].'</td>
				<td>'.$dueamount.'</td>

                <td>'.$row["startDate"].'</td>
				<td>'.$row["loanstatus"].'</td>	
				
				
				
				<td width="1%">
				<button type="button"  name="print"  class="btn btn-primary btn-xs print" id="'.$row["loanId"].'"><i class="fa fa-print" aria-hidden="true"></i></button>
			</td>
				<td width="1%">
				<button type="button"  name="delete"  class="btn btn-danger btn-xs delete" id="'.$row["loanId"].'"><i class="fa fa-trash" aria-hidden="true"></i></button>
			</td>

				
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