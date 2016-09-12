<?php


include_once("db_connect.php");

//specify file path where image are stored and image file source and name
$target_dir = "/var/www/html/DangerousAnimals/Images";
$target_dir = $target_dir . "/" . basename($_FILES["file"]["name"]);

if (isset($_POST['userid']) &&isset($_POST['tripid'])&& isset($_POST['category'])
    && isset($_POST['tripTitle']) &&isset($_POST['departTime'])&&isset($_POST['returnTime'])
    &&isset($_POST['lat']) &&isset($_POST['lgt'])&&isset($_POST['emergencyContactName'])
    &&isset($_POST['emergencyContactPhone']) &&isset($_POST['emergencyContactEmail'])
    &&isset($_POST['desc'])&&isset($_POST['imagefilename']))
{
    $userid = $_POST['userid'];
    $tripid = $_POST['tripid'];
    $category = $_POST['category'];
    $tripTitle = $_POST['tripTitle'];
    $departTime = $_POST['departTime'];
    $returnTime = $_POST['returnTime'];
    $lat = $_POST['lat'];
    $lgt = $_POST['lgt'];
    $emergencyContactName = $_POST['emergencyContactName'];
    $emergencyContactPhone = $_POST['emergencyContactPhone'];
    $emergencyContactEmail = $_POST['emergencyContactEmail'];
    $desc = $_POST['desc'];
    $imagefilename  = $_POST['imagefilename'];


    //check trip records based on user id to get trip id
      $tripCount = "SELECT COUNT(userid) as total FROM Trips WHERE userid = '$userid'";
    echo $tripCount;
    $result = mysqli_query($conn, $tripCount);
    $rows = mysqli_fetch_assoc($result);


    if (!empty($rows))
    {
        //if there are trips already, tripid = max trip number + 1
            //get max number of tripid
            echo "********test";
            $maxtripid = "SELECT max(tripid) as maxid FROM Trips WHERE userid = '$userid'";
            echo $maxtripid;
            $result = mysqli_query($conn, $maxtripid);
            $rows = mysqli_fetch_assoc($result);


        $tripid = $rows['maxid'] + 1;

        $sql = "INSERT INTO Trips (userid,tripid,departTime,returnTime,tripTitle,
emergencyContactName,emergencyContactPhone,emergencyContactEmail,category,tripdesc,lat,lgt)
VALUES ('{$userid}','{$tripid}','{$departTime}','{$returnTime}','{$tripTitle}',
'{$emergencyContactName}','{$emergencyContactPhone}','{$emergencyContactEmail}',
'{$category}','{$desc}','{$lat}','{$lgt}')";


        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }
    else {
        //if there is no trip, tripid  = 1
        $tripid = 1;
        $sql = "INSERT INTO Trips (userid,tripid,departTime,returnTime,tripTitle,
emergencyContactName,emergencyContactPhone,emergencyContactEmail,category,tripdesc,lat,lgt)
VALUES ('{$userid}','{$tripid}','{$departTime}','{$returnTime}','{$tripTitle}',
'{$emergencyContactName}','{$emergencyContactPhone}','{$emergencyContactEmail}',
'{$category}','{$desc}','{$lat}','{$lgt}')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    //upload image
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir))
    {
        echo json_encode([
            "Message" => "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.",
            "Status" => "OK",
            "userId" => $_REQUEST["userid"]
        ]);


            //upload image and set the filepath of image
            $sql = "UPDATE Trips set imagefilename = '$imagefilename'
            where userid = '$userid' and  tripid = '$tripid'";

            if ($conn->query($sql) === TRUE) {
                echo "Image file path created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

    } else {

        echo json_encode([
            "Message" => "Sorry, there was an error uploading your file.",
            "Status" => "Error",
            "userId" => $_REQUEST["userid"]
        ]);



        //upload image and set the filepath of image to ""
        $imagefilename = "";
        $sql = "UPDATE Trips set imagefilename = '$imagefilename'
            where userid = '$userid' and  tripid = '$tripid'";

        if ($conn->query($sql) === TRUE) {
            echo "Image file path created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

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

