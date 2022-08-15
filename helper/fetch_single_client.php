<?php
//fetch.php

require('../config/databaseConfig.php');

if(isset($_POST["omangID"]))
{
 $output = '';
 $query = "SELECT * FROM CUSTOMER WHERE omangID = '".$_POST["omangID"]."'";
 $result = mysqli_query($conn, $query);
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
  <h2>'.$row["firstname"].'</h2>
  <p><label>From - '.$row["homeVillage"].'</label></p>
  <p><label>Contact Number - '.$row["HomeMobile"].'</label></p>
  <p><label>Email Address - '.$row["email"].'</label></p>

  ';
  $query_1 = "SELECT omangID FROM CUSTOMER WHERE omangID < '".$_POST['omangID']."' ORDER BY omangID DESC LIMIT 1";
  $result_1 = mysqli_query($conn, $query_1);
  $data_1 = mysqli_fetch_assoc($result_1);
  $query_2 = "SELECT omangID FROM CUSTOMER WHERE omangID > '".$_POST['omangID']."' ORDER BY omangID ASC LIMIT 1";
  $result_2 = mysqli_query($conn, $query_2);
  $data_2 = mysqli_fetch_assoc($result_2);
  $if_previous_disable = '';
  $if_next_disable = '';
  if($data_1["omangID"] == "")
  {
   $if_previous_disable = 'disabled';
  }
  if($data_2["omangID"] == "")
  {
   $if_next_disable = 'disabled';
  }
  $output .= '
  <br /><br />
  <div align="center">
   <button type="button" name="previous" class="btn btn-warning btn-sm previous" id="'.$data_1["omangID"].'" '.$if_previous_disable.'>Previous</button>
   <button type="button" name="next" class="btn btn-warning btn-sm next" id="'.$data_2["omangID"].'" '.$if_next_disable.'>Next</button>
  </div>
  <br /><br />
  ';
 }
 echo $output;
}

?>