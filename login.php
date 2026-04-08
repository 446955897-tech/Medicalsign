<?php
include "database/db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    if ($user['role'] == 'patient') {
        header("<Location:patient/ patient_dashboard.php");
        exit();
    } else if ($user['role'] == 'doctor') {
        header("Location: doctor/doctor_dashboard.php");
        exit();
    }

} else {
    echo "بيانات الدخول غير صحيحة";
}
?>