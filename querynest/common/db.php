<?php
$conn = new mysqli("localhost", "root", "", "querynest");
if ($conn->connect_error) {
    die("not connected with DB" . $conn->connect_error);
}
?>