<?php

include_once("db_connect.php");


if (isset($_POST['userid']) ) {
    $userid = $_POST['userid'];

    //check if userid exists
    $sql = "SELECT userid FROM Trips WHERE userid = '$userid'";

    $result = mysqli_query($conn, $sql);
    if($row1 = mysqli_fetch_array($result) ===null )
    {
        echo json_encode("");
    }
    else
    {
        $sql3 = "SELECT * FROM Trips WHERE userid = '$userid'";
        $result3 = mysqli_query($conn, $sql3);

        while ($row = mysqli_fetch_assoc($result3))
        {
//            $response["tripTitle"]= $row["tripTitle"];
//            $response["departTime"]= $row["departTime"];
//            $response["category"]= $row["category"];
            $rows[] = $row;
        }
        echo json_encode($rows);
    }

}

?>





