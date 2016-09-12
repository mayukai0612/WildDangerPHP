<?php


include_once("db_connect.php");



if (isset($_POST['userid']) &&isset($_POST['tripid'])&&isset($_POST['departTime'])
    &&isset($_POST['tripTitle'])&& isset($_POST['category']))
{
    $userid = $_POST['userid'];
    $tripid = $_POST['tripid'];
    $category = $_POST['category'];
    $tripTitle = $_POST['tripTitle'];
    $departTime = $_POST['departTime'];

    //check trip records based on user id to get trip id
    $tripCount = "SELECT COUNT(userid) as total FROM Trips WHERE userid = '$userid'";
    echo $tripCount;
    $result = mysqli_query($conn, $tripCount);
    $rows = mysqli_fetch_assoc($result);

    if (!empty($rows))
    {
        $tripid = $rows['total'] + 1;

        $sql = "INSERT INTO Trips (userid,tripid,tripTitle,category,departTime) VALUES
    ('$userid','$tripid','$tripTitle','$category','$departTime')";


        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }
    else {

        $sql = "INSERT INTO Trips (userid,tripid,tripTitle,category,departTime) VALUES
    ('$userid','1','$tripTitle','$category','$departTime')";


        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }



    $conn->close();
}
?>



