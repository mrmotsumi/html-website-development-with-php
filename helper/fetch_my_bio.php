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
	SELECT * FROM bio b where  b.athlete='$user_id'
	AND b.city LIKE '%".$search."'
	";
}
else
{
	$query = "
	SELECT * FROM bio b where  b.athlete='$user_id' ";
}


$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);


if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table  style="color: white;" class="table table bordered">
						<tr style="color: white;">
							<th>Name</th>
							<th>Age</th>
							<th>Height</th>
							<th>Sport</th>
							<th>Rank</th>

							<th></th>

						</tr>';
	while($row = mysqli_fetch_array($result))
	{

//$date= strtotime('d-m-Y',$row['DATETIMEAPP']);

	 $output .= '
			<tr style="color: white;">
				<td>'.$row["name"].'</td>
				<td>'.$row["age"].'</td>
				<td>'.$row["height"].'</td>
				<td>'.$row["sport"].'</td>
				<td>'.$row["rank"].'</td>



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