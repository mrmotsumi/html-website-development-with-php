<?php

require('../config/databaseConfig.php');
$output = '';


if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM Activity 
	WHERE title LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM Activity  ORDER BY id";
}
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);


if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table style="color: white;" class="table table bordered">
						<tr>
							<th>Code Title</th>
							<th>Category</th>
							<th>Start Date</th>

							<th></th>

						</tr>';
	while($row = mysqli_fetch_array($result))
	{

	 $output .= '
			<tr>
				<td>'.$row["title"].'</td>
				<td>'.$row["type"].'</td>
				<td>'.$row["commencing_date"].'</td>


				<td width="10%">
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