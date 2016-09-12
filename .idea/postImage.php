<?php
$userId = $_POST["userId"];

$target_dir = "/var/www/html/DangerousAnimals/Images";

$target_dir = $target_dir . "/" . basename($_FILES["file"]["name"]);

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir))
{
    echo json_encode([
        "Message" => "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.",
        "Status" => "OK",
        "userId" => $_REQUEST["userId"]
    ]);


//    include_once("db_connect.php");
//
//    $sql = "UPDATE Trips set imagefilename = '$_FILES('name')'
//    where userid = '$userid'";
//
//    if ($conn->query($sql) === TRUE) {
//        echo "New record created successfully";
//    } else {
//        echo "Error: " . $sql . "<br>" . $conn->error;
//    }


} else {

    echo json_encode([
        "Message" => "Sorry, there was an error uploading your file.",
        "Status" => "Error",
        "userId" => $_REQUEST["userId"]
    ]);

}
?>