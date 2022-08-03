<?php
    //$username = $_SESSION["Session Variable"];
    //echo "Hello".$username;

    $file = fopen("users.txt", "r");
    echo $file;
    fclose($file);
?>