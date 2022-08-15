<?php

require('../config/databaseConfig.php');



     
if(isset($_POST['loanId']) & isset($_POST['OmangId'])){

  
    $loanId = mysqli_real_escape_string($conn, $_POST['loanId']);
    $OmangId = mysqli_real_escape_string($conn, $_POST['loanId']);

    $query = "select * from loan where loanId= '$loanId' AND OmangId='$omangId'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);


    if($count >0)
    {

        echo '<div style="color:red;"><b>'.$omangNo. '</b> is already registered</div>';

    }else  if(filter_var($omangNo, FILTER_VALIDATE_INT) == FALSE)
    {
        echo '<div style="color:red;"><b>'.$omangNo. '</b> is invalid Omang Number</div>';

    }else if((strlen((string)$omangNo) < 9) || (strlen((string)$omangNo) > 9))
    {
        echo '<div style="color:red;">  Omang Number must have 9 digits</div>';


    }
    
    else
    {
        echo '<div style="color:blue;"><b>'.$omangNo. '</b> can be registered</div>';

    }

}

?>