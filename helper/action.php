<?php

require('../config/databaseConfig.php');



     
if(isset($_POST['omangNo']) & !empty($_POST['omangNo'])){

  
    $omangNo = mysqli_real_escape_string($conn, $_POST['omangNo']);
    $query = "select * from Customer where omangID= '$omangNo'";
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

}else if(isset($_POST['firstname']) & !empty($_POST['firstname'])){

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);


}

?>