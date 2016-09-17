<?php




include_once("db_connect.php");


if (isset($_POST['userid']) && isset($_POST['tripid'])  )
{
    $userid = $_POST['userid'];
    $tripid = $_POST['tripid'];

    //delete trip from table Trips
    $sql = "DELETE FROM Trips WHERE userid = '$userid' and tripid = '$tripid'";
    $result = mysqli_query($conn,$sql);

    //get the result of deletion query
    while($row = mysqli_fetch_assoc($result))
    {
        $response["result"]= $row["delete"];
    }

    //delete photo file names from table TripPhotos
    $sql = "DELETE FROM TripPhotos WHERE userid = '$userid' and tripid = '$tripid'";
    $result = mysqli_query($conn,$sql);
    //get the result of deletion query
    while($row = mysqli_fetch_assoc($result))
    {
        $response["result"]= $row["delete"];
    }

    echo json_encode($response);


    $conn->close();
}
?>


