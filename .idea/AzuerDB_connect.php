<?php
/**
 * Created by PhpStorm.
 * User: yukaima
 * Date: 4/05/2016
 * Time: 10:56 PM
 */

$servername = "127.0.0.1";
$username = "root";
$password = "techsquad";
$dbname = "CSV_DB";

$conn = new mysqli($servername,$username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



