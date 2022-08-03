<!doctype html>
<html lang="en">
	<head><title>Logout</title></head>



<?php
session_start();
session_destroy();
header("Location: login.html");
exit;   // we call exit here so that the script will stop executing before the connection is broken
?>

</html>