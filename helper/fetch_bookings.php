<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM Booking 
	WHERE Customer_names LIKE '%".$search."'
	";
}
else
{
	$query = "
	SELECT * FROM Booking  ORDER BY id";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);


if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Booking ID</th>
							<th>Booking Date</th>
							<th>Customer Name(s)</th>
							<th>Customer Address</th>

							<th>Action</th>

						</tr>';
	while($row = mysqli_fetch_array($result))
	{

	 $output .= '
			<tr>
				<td>'.$row["id"].'</td>
				<td>'.$row["booking_date"].'</td>
				<td>'.$row["Customer_names"].'</td>
				<td>'.$row["address"].'</td>


				<td width="10%">
				<button type="button"  name="view" class="btn btn-primary btn-xs view" id="'.$row["id"].'">View</button>
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