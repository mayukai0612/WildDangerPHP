<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

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




    $sql = "UPDATE Trips SET departTime = '$departTime',returnTime = '$returnTime',
          tripTitle = '$tripTitle',emergencyContactName = '$emergencyContactName',
          emergencyContactEmail = '$emergencyContactEmail',category = '$category',
          tripdesc = '$tripdesc',lat = '$lat',lgt = '$lgt',imagefilename = '$imagefilename' 
          WHERE userid = '$userid' and tripid = '$tripid'";



    if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


    //upload image
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir))
    {
        echo json_encode([
            "Message" => "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.",
            "Status" => "OK",
            "userId" => $_REQUEST["userid"]
        ]);

    } else {

        echo json_encode([
            "Message" => "Sorry, there was an error uploading your file.",
            "Status" => "Error",
            "userId" => $_REQUEST["userid"]
        ]);

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

