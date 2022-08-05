<!doctype html>
<html lang="en">



<head>
    <title>File Sharing Site</title>
    <link rel="stylesheet" href="homepage.css">


</head>

<body>

    <div class="header">
        <div class="header-content-left">
            <img src="folderlogo.png" alt="folder logo" id="logo" />
            <h1> File Sharing Site </h1>
        </div>

        <div class="header-content-right">
            Logged in as:
            <?php
            session_start();
            echo $_SESSION["SessionVariable"];
            ?>

            <form name="logout" action="logout.php">
                <button type="submit" name="Logout" class="logout-button">Logout</button>
            </form>
        </div>

    </div>

    <div class="mainContent">
        Click on file to preview:
        <br></br>
        <br></br>
        <div class="filetype-textbox">
            <div> My Files </div>
            <div> Shared </div>
        </div>
        <div id="secondBox">

            <br>
            <?php
            $fileArray = array_diff(scandir("/media/filesharing/{$_SESSION["SessionVariable"]}"), array('..', '.'));
            # getting rid of the dots: https://www.php.net/manual/en/function.scandir.php
            #print_r ( $fileArray);
            echo "<div class='personal-files'>";

            foreach ($fileArray as $value) {

                echo "<div class='file-and-delete'>";

                echo "<form name='fileEcho' action='viewFile.php' method='get'>";
                echo "<button type='submit' name='file' class='fileButton' value='$value'>$value</button>";
                echo "</form>";

                echo "<form name='fileEcho' action='deleteFile.php' method='get'>";
                echo "<button type='submit' name='file' value='$value' class='delete-button'> Delete </button>";
                echo "</form>";

                echo "</div>";
            }
            echo "</div>";


            ?>
            <?php
            $dirArray = array_diff(scandir("/media/filesharing/shared"), array('..', '.'));
            echo "<div class='shared-files'>";


            foreach ($dirArray as $value) {
                $directory = $value;
                if ($directory != "users.txt") {
                    $path = sprintf("/media/filesharing/shared/%s/shared.txt", $directory);

                    $file = fopen($path, "r");

                    while (!feof($file)) {
                        if ($_SESSION["SessionVariable"] == trim(fgets($file))) {
                            $dirPath = sprintf("/media/filesharing/shared/%s", $value);
                            $fileArray2 = array_diff(scandir($dirPath), array('..', '.'));

                            foreach ($fileArray2 as $value2) {
                                echo "<div class='file-and-delete'>";
                                echo "<form name='fileEcho' action='viewSharedFile.php' method='get'>";
                                echo "<button type='submit' name='file' value='$value $value2' class='fileButton-shared'>$value2</button>";
                                echo "</form>";
                                echo "</div>";
                            }
                        }
                    }
                }
            }
            echo "</div>";


            ?>
        </div>

        <div id="thirdBox">
            <div>
                Choose a file to upload:
                <form enctype="multipart/form-data" action="uploader.php" method="POST">
                    <p>
                        <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
                        <input name="uploadedfile" type="file" id="uploadfile_input" class="file-upload-button"/>
                    </p>
                    <p>
                        <input type="submit" value="Upload File" class="file-upload-submit-button"/>
                    </p>
                </form>
            </div>
        </div>

    </div>

</body>


</html>