<?php

require('../config/databaseConfig.php');
     
$omangNo ="";
if(isset($_POST['OmangNum']) ){

  
    $omangNo = mysqli_real_escape_string($conn, $_POST['OmangNum']);
    $query = "select l.omangID from loan l where l.omangID= '$omangNo'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);



    if($count > 0)
    {

        echo '<div style="color:green;">  Looks Good</div>';

      

    }else if((strlen((string)$omangNo) < 9) || (strlen((string)$omangNo) > 9))
    {
        echo '<div style="color:red;">  Omang Number must have 9 digits</div>';


    }
    
    else
    {
        echo '<div style="color:red;"><b>'.$omangNo. '</b> Not Registered Member</div>';

    }

}
else if(isset($_POST['LoanNum']) ){


   

    $loanNo = mysqli_real_escape_string($conn, $_POST['LoanNum']);

    $checkquery = "select l.loanId from loan l where l.loanId ='$loanNo'";
    $checkresult = mysqli_query($conn, $checkquery);
    $checkcount = mysqli_num_rows($checkresult);

    if($checkcount > 0){

        echo '<div style="color:green;"><b>'.$omangNo. '</b> Looks Good </div>';

    }else{
        echo '<div style="color:red;">Invalid Loan Number </div>';

    }

}

?>