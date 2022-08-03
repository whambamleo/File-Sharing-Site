<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href = "login.css" />
        <title>Login</title>
    </head>

    <body>
        
        <h1> File Sharing Site </h1>
        
        <?php
            #checks that user is on the users.txt list
            $user = htmlentities($_GET["username"]);
            if( !preg_match('/^[\w_\-]+$/', $user) ){
                echo "Invalid username";
                exit;
            }
            $file = fopen("/media/filesharing/users.txt", "r");
            if (empty(!$user)) {
                while (!feof($file)){
                    if (trim(fgets($file)) == $user) {

                        session_start();
                        $_SESSION["SessionVariable"] = $user; 
                        header("Location: homepage.php");
                        fclose($file);
                        exit;
                    } 
                }
                echo '<p style = "color: red; text-align: center; font-family: Arial;"> User not found! </p>';
            }
            
            
        ?>
    

    </body>

</html>
