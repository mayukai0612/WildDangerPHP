<?php
$filename = date("YmdHis");
$file = fopen($filename.".png", "w");
$data = base64_decode($_POST['img']);

fwrite($file, $data);

fclose($file);


include_once("db_connect.php");


if (isset($_POST['userid']) )
{
    $userid = $_POST['userid'];




    $sql = "UPDATE user_icon set icon_filename = '$filename'
where userid = '$userid'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>