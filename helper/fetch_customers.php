<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM customer 
	WHERE omang_id LIKE '%".$search."'
	";
}
else
{
	$query = "
	SELECT * FROM customer ORDER BY firstname";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);

$curentDate = date("Y-m-d");

$colorFlag = "";
$loanStatus = "";
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive ">
					<table class="table table bordered">
					  <thead class="thead-dark">

						<tr>
							<th>Identity Number</th>
							<th>FirstName</th>
							<th>Surname</th>
							<th>Contact No.</th>
							<th>Job</th>
							<th></th>
							<th></th>
							<th></th>


						</tr>  </thead>';
	while($row = mysqli_fetch_array($result))
	{

	
	 
	 $output .= '
			<tr>
				<td>'.$row["omang_id"].'</td>
				<td>'.$row["firstname"].'</td>
				<td>'.$row["lastname"].'</td>
				<td>'.$row["HomeMobile"].'</td>
				<td>'.$row["CompanyName"].'</td>


	<td width="1%">
				<button type="button"  name="delete"  class="btn btn-primary btn-sm delete" id="'.$row["omang_id"].'"><i class="fas fa-money-check-alt"></i>  Loan
</button>
			</td>
				<td width="1%">
				<button type="button"  name="view"  class="btn btn-primary btn-sm view" id="'.$row["omang_id"].'"> 
                              <i class="fas fa-folder">
                              </i>
                              View
                          </button>
			</td>
				<td width="1%">
				<button type="button"  name="delete"  class="btn btn-danger btn-sm delete" id="'.$row["omang_id"].'"><i class="fa fa-trash" aria-hidden="true"></i>                              Delete
</button>
			</td>
			
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