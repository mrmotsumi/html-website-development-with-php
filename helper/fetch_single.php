

<?php

//fetch_single.php

require('../config/databaseConfig.php');

if(isset($_GET["id"]))
{
 $query = "SELECT * FROM loan WHERE loanId = '".$_GET["id"]."'";

 $result = mysqli_query($conn, $query);
 $row = mysqli_num_rows($result);


 $output = '<div class="row">';
 foreach($result as $row)
 {

    $due_amount = $row['interest'] + $row['amount'];
 
  $output .= '
  <div class="col-md-3">
   <br />
  </div>
  <div class="col-md-9">
   <br />
   <p><label>Omang Id :&nbsp;</label>'.$row["OmangId"].'&nbsp;<label>Amount :&nbsp;</label>BWP '.$row["amount"].'</p>
   <p><label>interest :&nbsp;</label>BWP '.$row["interest"].'&nbsp;&nbsp;<label>&nbsp;&nbsp;&nbsp;&nbsp;Rate :&nbsp;</label>'.$row["interestRate"].'% </p>
   <p><label>Due Amount :&nbsp;</label>BWP '.$due_amount.'</p>

   <p><label>Loan Status :&nbsp;</label>'.$row["loanstatus"].'</p>
   <p><label>Start Date :&nbsp;</label>'.$row["startDate"].'</p>

   <p><label>Due Date :&nbsp;</label>'.$row["endDate"].'</p>
  </div>

  </div><br />
  ';
 }
 echo $output;
}

?>
