<?php


include_once("db_connect.php");





    $animalName = "bee";
    $info_sql = "select * from Animals where Latitude <> 0 and
 VernacularName LIKE '%$aniamlName%' ";


    $result = mysqli_query($conn,$info_sql);

    while($row = mysqli_fetch_assoc($result))
    {
        $rows[] = $row;

    }

    echo json_encode($rows);


    $conn->close();

?>

<html>
<body>

<form action = "<?php $_PHP_SELF ?>" method = "POST">
    Keywords: <input type = "string" name = "latitude" />
    Keywords: <input type = "string" name = "longtitude" />
    Keywords: <input type = "string" name = "animalName" />

    <input type = "submit" />
</form>

</body>
</html>


<html>
<body>

<form action = "<?php $_PHP_SELF ?>" method = "POST">
    latitude: <input type = "string" name = "latitude" />
    longitude: <input type = "int" name = "longitude" />
    animalName: <input type = "string" name = "animalName" />
    time: <input type = "int" name = "time" />
    distance: <input type = "int" name = "distance" />

    <input type = "submit" />
</form>

</body>
</html>