<?php  //ignore this comment >

ini_set('display_errors',1);
error_reporting(E_ALL);

include_once("db_connect.php");

if (isset($_POST['userid']) &&isset($_POST['tripid'])) {
    $userid = $_POST['userid'];
    $tripid = $_POST['tripid'];


//specify the dir where image are stored
    $target_dir = "/var/www/html/DangerousAnimals/Images";

//check target file exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir);
    }
    echo("dir exist");
    if (is_array($_FILES["files"])) {
        echo("array");
        $numberOfFiles = count($_FILES["files"]["name"]);
        for ($i = 0; $i < $numberOfFiles; $i++) { //ignore this comment >
            $uploadFile = $target_dir . "/" . basename($_FILES["files"]["name"][$i]);
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            //check if the file is the image
            if (!(getimagesize($_FILES["files"]["tmp_name"][$i]) !== false)) {
                echo "Sorry, your image is invalid";
                exit;
            }

            //check the image size
            if ($_FILES["files"]["size"][$i] > 10000000) {
                echo "Sorry, your file is too large.";
                exit;
            }

            //check the image type
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

                exit;

            }

            //move uploaded file
            if (move_uploaded_file($_FILES["files"]["tmp_name"][$i], $uploadFile)) {
                echo "Upload image " . basename($_FILES["files"]["name"][$i]) . " successfully!";


                //if the file is uploaded successfully, insert the file name into tables

                $sql = "INSERT INTO TripPhotos (userid,tripid,TripPhotoFilename)
                        VALUES ('{$userid}','{$tripid}','{$_FILES["files"]["name"][$i]}')";

                //execute sql query
                if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

            } else {

                echo "Sorry, there was an error uploading your file.";

            }

        }

    }

    $conn->close();
}

?>


