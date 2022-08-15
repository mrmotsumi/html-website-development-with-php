<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM schedule 
	WHERE  title LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM schedule    ORDER BY date";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);


if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table style="color: white;" class="table table bordered">
						<tr>
							<th>Event</th>
							<th>Date</th>
							<th>Time</th>

							<th></th>

						</tr>';
	while($row = mysqli_fetch_array($result))
	{

	 $output .= '
			<tr>
				<td>'.$row["activity"].'</td>
				<td>'.$row["date"].'</td>
				<td>'.$row["time"].'</td>



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