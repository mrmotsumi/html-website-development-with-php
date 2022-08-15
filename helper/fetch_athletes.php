<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM user 
	WHERE role='athlete' AND name LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM user  WHERE  role='athlete' ORDER BY name";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);


if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table style="color: blue;" class="table table bordered">
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Contact Number</th>
							<th>Sport Code</th>
							<th>Country</th>
							<th></th>

							<th></th>

						</tr>';
	while($row = mysqli_fetch_array($result))
	{

	 $output .= '
			<tr>
				<td>'.$row["name"].'</td>
				<td>'.$row["email"].'</td>
				<td>'.$row["contact_no"].'</td>
				<td>'.$row["sport_activity"].'</td>
				<td>'.$row["country"].'</td>


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