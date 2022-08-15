<?php

require('../config/databaseConfig.php');
$output = '';
session_start();
$user_id = $_SESSION['userid'];

if(!isset($_SESSION['userid']))
{
    
    header("location: index.html");
}


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM Locations b where  b.athlete='$user_id'
	AND b.city LIKE '%".$search."'
	";
}
else
{
	$query = "
	SELECT * FROM Locations b where  b.athlete='$user_id' ";
}


$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);


if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table  style="color: white;" class="table table bordered">
						<tr style="color: white;">
							<th>Country</th>
							<th>Region</th>
							<th>City</th>
							<th>Stadium</th>
							<th>Date</th>
							<th>Time</th>

							<th></th>

						</tr>';
	while($row = mysqli_fetch_array($result))
	{

//$date= strtotime('d-m-Y',$row['DATETIMEAPP']);

	 $output .= '
			<tr style="color: white;">
				<td>'.$row["country"].'</td>
				<td>'.$row["region"].'</td>
				<td>'.$row["city"].'</td>
				<td>'.$row["stadium"].'</td>

				<td>'.$row["date"].'</td>
				<td>'.$row["time"].'</td>


				<td width="1%">
				<button type="button"  name="delete" class="btn btn-primary btn-xs delete" id="'.$row["id"].'">delete</button>
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