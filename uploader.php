<!doctype html>
<html lang="en">
	<head><title>File Upload</title></head>

<?php
session_start();

// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
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
//$full_path = sprintf("/home/whambamleo/public_html/%s", $filename);
echo $full_path;
echo $_FILES['uploadedfile']['tmp_name'];

if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	header("Location: homepage.php");
	exit;
}else{
	//header("Location: login.php");
	exit;
}

?>

</html>