<!doctype html>
<html lang="en">



    <head>
        <title>File Sharing Site</title>
        <link rel="stylesheet" href="homepage.css">


    </head>

    <body>
        <img src="folderlogo.png" alt = "folder logo" id = "logo" />
        <h1> File Sharing Site </h1>  
        

        <div id="firstBox"> 
        Logged in as:
        <?php
        session_start();
        echo $_SESSION["SessionVariable"];
        ?>

        <form name="logout" action="logout.php">
            <button type="submit" name="Logout">Logout</button>
        </form>
        </div>

        <div id="secondBox"> 
            Display file names + click file name to display
            <br>
            <?php
            $fileArray =array_diff(scandir("/media/filesharing/{$_SESSION["SessionVariable"]}"), array('..','.'));
            # getting rid of the dots: https://www.php.net/manual/en/function.scandir.php
            #print_r ( $fileArray);
            echo "<form name='fileEcho' action='viewFile.php' method='get'>" ;
            foreach ($fileArray as $value){
               
            
                echo "<button type='submit' name='file' value='$value'>$value</button>";
            } 
                            echo "</form>";

		
	    echo "<form name='fileEcho' action='deleteFile.php' method='get'>";
            foreach ($fileArray as $value){
                echo "<button type='submit' name='file' value='$value'> Delete $value </button>";
                #formaction='viewFile.php' formmethod='get'
                #echo "<input type='button' id='$value' value='$value' name='$value' label='$value' onclick='viewFile.php'>";
                
                #echo "</form>";

                #echo "<form name='fileEcho' action='deleteFile.php' method='get'>";
                #echo "<button type='submit' name='file' value='$value'> Delete $value </button>";
                #echo "</form>";
            } 
            echo "</form>";
            ?>
            Shared files
            <?php
                $dirArray =array_diff(scandir("/media/filesharing/shared"), array('..','.'));

                foreach ($dirArray as $value) {
                    $directory = $value;
                    if ($directory != "users.txt") {
                        $path = sprintf("/media/filesharing/shared/%s/shared.txt", $directory);

                       $file = fopen($path, "r");

                       while (!feof($file)){
                           if ($_SESSION["SessionVariable"] == trim(fgets($file))){
                            $dirPath = sprintf("/media/filesharing/shared/%s", $value);
                            $fileArray2 = array_diff(scandir($dirPath), array('..','.'));
                            
                            foreach ($fileArray2 as $value2){
                                echo "<form name='fileEcho' action='viewSharedFile.php' method='get'>";
                                echo "<button type='submit' name='file' value='$value $value2'>$value2</button>";
                                echo "</form>";
                
                            
                            } 
                       }


                        
                    }

                     
                }
            }
                

            ?>
        </div>

   <div id="thirdBox"> 
        <form enctype="multipart/form-data" action="uploader.php" method="POST">
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
		<label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
	</p>
	<p>
		<input type="submit" value="Upload File" />
	</p>
</form>
        </div>

    </body>


</html>

