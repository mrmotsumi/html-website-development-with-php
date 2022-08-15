<?php

require('../config/databaseConfig.php');
     
if(isset($_POST['OmangNum']) & !empty($_POST['OmangNum'])){

  
    $omangNo = mysqli_real_escape_string($conn, $_POST['OmangNum']);
    $query = "select l.OmangId from loan l where l.OmangId= '$omangNo'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);



    if($count > 0)
    {

        echo '<div style="color:green;"><b>'.$omangNo. '</b> Looks Good </div>';

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