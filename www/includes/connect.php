<?php 
    $dbc = mysqli_connect("localhost", "root", "", "movies_onslow_L2");
    if($dbc) {
        //var_dump("CHUR");
        $dbc->set_charset("utf8");
    } else {
        var_dump("NOT A CHUR");
    }
?>
