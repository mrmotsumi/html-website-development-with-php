<?php

require('../config/databaseConfig.php');
     
if(isset($_POST['omangNum']) & !empty($_POST['omangNum'])){

  
    $omangNo = mysqli_real_escape_string($conn, $_POST['omangNum']);
    $query = "select c.omangID from Customer c where c.omangID= '$omangNo'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);



    if($count > 0)
    {

        $checkquery = "select l.omangID from loan l where l.omangID= '$omangNo' AND loanstatus='Active'";
        $checkresult = mysqli_query($conn, $checkquery);
        $checkcount = mysqli_num_rows($checkresult);

        if($checkcount < 1){

            echo '<div style="color:green;"><b>'.$omangNo. '</b> Looks Good </div>';

        }else{
            echo '<div style="color:red;">This Client has pending loans</div>';

        }

    }else if((strlen((string)$omangNo) < 9) || (strlen((string)$omangNo) > 9))
    {
        echo '<div style="color:red;">  Omang Number must have 9 digits</div>';


    }
    
    else
    {
        echo '<div style="color:red;"><b>'.$omangNo. '</b> Not Registered Member</div>';

    }

}


?>