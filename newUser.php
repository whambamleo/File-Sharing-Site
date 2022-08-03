<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href = "login.css" />
        <title>New User</title>
    </head>

    <body>
        
        <h1> File Sharing Site </h1>
        
        <?php
            #checks if user is on the users.txt list, logs in if they are:
            $user = htmlentities($_GET["username"]);
            #This filters input to htmlentities
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
                #echo '<p style = "color: red; text-align: center; font-family: Arial;"> User not found! </p>';
                #append to file as in https://www.w3schools.com/php/php_file_create.asp 
                $fileAddition = fopen("/media/filesharing/users.txt", "a+");
                $txt = "$user\n";
                fwrite($fileAddition, $txt);
                mkdir("/media/filesharing/$user");
                fclose($fileAddition);

            }
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
                echo '<p style = "color: red; text-align: center; font-family: Arial;"> User created! Go back or refresh to log in.</p>';
                echo link('http://ec2-13-59-193-29.us-east-2.compute.amazonaws.com/~jokenfuss/login.html','Login'); 
                

            }
            
        ?>
    

    </body>

</html>