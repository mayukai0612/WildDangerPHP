<?php


include_once("db_connect.php");


if (isset($_POST['userid']) &&isset($_POST['tripid'])&& isset($_POST['category'])
    && isset($_POST['tripContent']) &&isset($_POST['departTime'])&&isset($_POST['returnTime'])
    &&isset($_POST['lat']) &&isset($_POST['lgt']))
{
    $userid = $_POST['userid'];
    $tripid = $_POST['tripid'];
    $category = $_POST['category'];
    $tripContent = $_POST['tripContent'];
    $departTime = $_POST['departTime'];
    $returnTime = $_POST['returnTime'];
    $lat = $_POST['lat'];
    $lgt = $_POST['lgt'];




//
//        $sql = "INSERT INTO Trips (userid,tripid,departTime,returnTime,tripTitle,
//emergencyContactName,emergencyContactPhone,emergencyContactEmail,category,tripdesc,lat,lgt,imagefilename)
//VALUES ('{$userid}','{$tripid}','{$departTime}','{$returnTime}','{$tripTitle}',
//'{$emergencyContactName}','{$emergencyContactPhone}','{$emergencyContactEmail}',
//'{$category}','{$desc}','{$lat}','{$lgt}','')";

    $sql = "UPDATE Trips SET departTime = '$departTime',returnTime = '$returnTime',
          tripContent = '$tripContent',category = '$category',lat = '$lat',lgt = '$lgt' 
          WHERE userid = '$userid' and tripid = '$tripid'";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }



    $conn->close();
}
?>




<html>
<body>

<form action = "<?php $_PHP_SELF ?>" method = "POST">
    userid: <input type = "string" name = "userid" />
    tripid: <input type = "string" name = "tripid" />
    category: <input type = "string" name = "category" />
    tripTitle: <input type = "string" name = "tripTitle" />
    departTime: <input type = "string" name = "departTime" />
    returnTime: <input type = "string" name = "returnTime" />
    lat: <input type = "string" name = "lat" />
    lgt: <input type = "string" name = "lgt" />
    emergencyContactName: <input type = "string" name = "emergencyContactName" />
    emergencyContactPhone: <input type = "string" name = "emergencyContactPhone" />
    emergencyContactEmail: <input type = "string" name = "emergencyContactEmail" />
    desc: <input type = "string" name = "desc" />

    <input type = "submit" />
</form>

</body>
</html>

