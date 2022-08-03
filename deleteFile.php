<!doctype html>
<html lang="en">
	<head><title>File Delete</title></head>


<?php
    session_start();

    // Get the filename and make sure it is valid
    $filename = $_GET["file"];;
    if( !preg_match('/^[\w_\.\-\s]+$/', $filename) ){
        echo "Invalid filename";
        exit;
    }
    
    // Get the username and make sure it is valid
    $username = $_SESSION['SessionVariable'];
    if( !preg_match('/^[\w_\-]+$/', $username) ){
        echo "Invalid username";
        exit;
    }

    $full_path = sprintf("/media/filesharing/%s/%s", $username, $filename);
    unlink($full_path);
    header("Location: homepage.php");
    exit;
?>
</html>
