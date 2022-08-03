<?php
session_start();
#readfile("/media/filesharing/Alpha/file1.txt");
$filename = $_GET['file'];

// We need to make sure that the filename is in a valid format; if it's not, display an error and leave the script.
// To perform the check, we will use a regular expression.
# Modified this from the starter code to accept spaces in file names
if( !preg_match('/^[\w_\.\-\s]+$/', $filename) ){
	?> <!doctype html><html lang="en"></html>
	<?php echo "Invalid filename:";
	exit;
}

// Get the username and make sure that it is alphanumeric with limited other characters.
// You shouldn't allow usernames with unusual characters anyway, but it's always best to perform a sanity check
// since we will be concatenating the string to load files from the filesystem.
$username = $_SESSION['SessionVariable'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	?> <!doctype html><html lang="en"><head><title>ViewFile</title></head>
	Invalid Username</html>
	<?php
	exit;
}
$full_path = sprintf("/media/filesharing/%s/%s", $username, $filename);
// Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);
// Finally, set the Content-Type header to the MIME type of the file, and display the file.
if (file_exists($full_path)){
header("Content-Type: ".$mime);
header('content-disposition: inline; filename="'.$filename.'";');
readfile($full_path);
exit;} else {
    echo "File not found.";
}
?>