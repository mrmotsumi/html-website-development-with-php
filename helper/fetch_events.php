<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM Game 
	WHERE  category LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM Game    ORDER BY category";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);


if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table style="color: blue;" class="table table bordered">
						<tr>
							<th>Category</th>

							<th>Title</th>
							<th>Venue</th>
							<th>Start Date</th>
							<th>Time</th>
						
							<th></th>

						</tr>';
	while($row = mysqli_fetch_array($result))
	{

	 $output .= '
			<tr>
							<td>'.$row["category"].'</td>

				<td>'.$row["title"].'</td>
				<td>'.$row["venue"].'</td>
				<td>'.$row["date"].'</td>
				<td>'.$row["time"].'</td>

					<td width="1%">
				<button type="button"  name="update" class="btn btn-primary btn-xs update" id="'.$row["id"].'">update</button>
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