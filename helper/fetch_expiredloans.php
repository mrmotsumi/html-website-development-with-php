<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM loan 
	WHERE omang_id LIKE '%".$search."%' AND loanstatus ='Expired'
	";
}
else
{
	$query = "
	SELECT * FROM loan where  loanstatus ='Expired' ORDER BY endDate";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);

$curentDate = date("Y-m-d");

$colorFlag = "";
$loanStatus = "";
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive" id="employee_table">
					 
					<table class="table table bordered" >
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
							<th>Due Date</th>
							<th>Days Remaining</th>
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
	
	$amountpayable= $row['amount'] + $row['interest'] + $row['PenalityAmount'];
	 if($days < 1){

		


		$update_qury = "update loan SET loanstatus='Expired' where 
		loanId='$rowNum'";
		$updateresult = mysqli_query($conn, $update_qury);

	
	  }

	  $dueamount =$amountpayable -$Queryrow["payedAmount"]; 
	  
	
	  if($amountpayable -$Queryrow["payedAmount"] === 0)
	  {
		$close_qury = "update loan SET loanstatus='CLOSED' where 
		loanId='$rowNum'";
		$closeresult = mysqli_query($conn, $close_qury);

	  }
	 $output .= '
			<tr>
				<td>'.$row["omang_id"].'</td>
				<td>P'.$row["amount"].'</td>
				<td>P'.$row["interest"].'</td>
				<td>P'.$amountpayable.'</td>
				<td>'.$Queryrow["payedAmount"].'</td>
				<td>'.$dueamount.'</td>
				<td>'.$row["endDate"].'</td>
				<td>'.$days.'</td>
				<td>'.$row["loanstatus"].'</td>	

				<td width="1%">

				
				<button type="button"  name="view" class="btn btn-primary btn-xs view" id="'.$row["loanId"].'"><i class="fas fa-eye"></i></button>
			</td>
			
				<td width="1%">

				
				<button type="button"  name="print" class="btn btn-primary btn-xs print" id="'.$row["loanId"].'"><i class="fas fa-print"></i></button>
			</td>
			
				<td width="1%">

				
				<button type="button"  name="close_loan" class="btn btn-primary btn-xs close_loan" id="'.$row["loanId"].'"><i class="fas fa-times"></i></button>
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