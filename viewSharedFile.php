<?php
session_start();
#readfile("/media/filesharing/Alpha/file1.txt");
$filename = $_GET['file'];
$filenameSplit = explode(" ", $filename);
$dir1 = $filenameSplit[0];
$dir2 = $filenameSplit[1];


$full_path = sprintf("/media/filesharing/shared/%s/%s", $dir1, $dir2);

// Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($full_path);

// Finally, set the Content-Type header to the MIME type of the file, and display the file.
header("Content-Type: ".$mime);
header('content-disposition: inline; filename="'.$filename.'";');
readfile($full_path);





?>


