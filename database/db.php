<?php
$conn = mysqli_connect("localhost", "root", "", "medicalsign");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>