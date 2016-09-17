<?php

include_once("db_connect.php");


if (isset($_POST['userid']) && isset($_POST['tripid'])) {
    $userid = $_POST['userid'];
    $tripid = $_POST['tripid'];

    //select
    $sql = "SELECT TripPhotoFilename FROM TripPhotos WHERE UserID = '$userid' and TripId = '$tripid'";

    $result = mysqli_query($conn, $sql);

    //check if result is empty
    if(mysqli_num_rows($result) != 0)
    {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row['TripPhotoFilename'];
        }
        echo json_encode($rows);
    }else {

        echo json_encode("");

    }




}

?>



