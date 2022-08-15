<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM loan 
	WHERE OmangId LIKE '%".$search."%'  loanstatus ='Active'
	";
}
else
{
	$query = "
	SELECT * FROM loan where  loanstatus ='Active' ORDER BY endDate";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);

$curentDate = date("Y-m-d");

$colorFlag = "";
$loanStatus = "";
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive"  id="employee_table">
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
							<th></th>
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
		
		 $amountpayable= $row['amount'] + $row['interest'] + $row['service_fee'] ;
		
		

		 $penalityRate = 5;

		 $penalityAmount = $penalityRate / 100 * $amountpayable;

		//Penalize loanStatus
		$monitor_expired_query = "SELECT * from loan where loanStatus='Expired'";
		$monitor_expired_query_result = mysqli_query($conn, $monitor_expired_query);
		$monitor_expired_query_row = mysqli_num_rows($monitor_expired_query_result);
		
		while($monitor_expired_query_row =mysqli_fetch_array($monitor_expired_query_result)){
			
			if(mysqli_num_rows($monitor_expired_query_result) > 0){

				//procecess Penality
				
				$loan_num= $monitor_expired_query_row['loanId'];
				$penality_date = $monitor_expired_query_row['penalty_date'];
				
				$next_penality_date = date('Y-m-d', strtotime($penality_date. ' + 30 days'));
				
		    	 $days_mon=	( strtotime($curentDate) - strtotime($next_penality_date))/60/60/24;
				 
				 $current_balance = $monitor_expired_query_row['amount'];
				 $Current_Interest = $monitor_expired_query_row['interest'];
				 $Total_current_balance = $current_balance + $Current_Interest;
				 
				 
				 $current_penalty = 5 / 100 * $current_balance;
				 
				 
				 
				 
			

				
				if($days_mon > 0)
				{
					
				 $penality_query = "insert into Penalty(loan_id, penality_date, amount) values('$loan_num','$next_penality_date','$current_penalty')";
		         $penality_result = mysqli_query($conn, $penality_query);
				 
				 
				 $update_qury = "update loan SET penalty_date='$next_penality_date' where 
				loanId='$loan_num'";
	
				$updateresult = mysqli_query($conn, $update_qury);


				}
			
			}
		}
	
	 if($days < 1){

      		 $_penality_date = date('Y-m-d', strtotime($row['endDate']. ' + 30 days'));


		$update_qury = "update loan SET loanstatus='Expired', penalty_date='$_penality_date' where 
		loanId='$rowNum'";
	
		$updateresult = mysqli_query($conn, $update_qury);

	
	  }

	  $dueamount =$amountpayable -$Queryrow["payedAmount"]; 
	  
	 
	  
	
	  if($amountpayable -$Queryrow["payedAmount"] == 0)
	  {
		$close_qury = "update loan SET loanstatus='CLOSED' where 
		loanId='$rowNum'";
		$closeresult = mysqli_query($conn, $close_qury);

	  }
	 $output .= '
			<tr>
				<td>'.$row["loanId"].'</td>
				<td>'.$row["omang_id"].'</td>
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

				<td width="1%">
				<button type="button"  name="Edit" class="btn btn-primary btn-xs edit" id="'.$row["loanId"].'"><i class="fas fa-edit"></i></button>

			</td>
				<td width="1%">

				<button type="button"  name="view" class="btn btn-primary btn-xs view" id="'.$row["loanId"].'"><i class="fas fa-eye"></i></button>
			</td>
			
				<td width="1%">

				<button type="button"  name="print" class="btn btn-primary btn-xs print" id="'.$row["loanId"].'"><i class="fas fa-print"></i></button>
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