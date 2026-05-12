<?php

session_start();

// الاتصال باستخدام بياناتك الحقيقية من الصورة
$conn = mysqli_connect("localhost", "root", "", "medicalsign");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // تعديل اسم العمود ليكون user_id كما في صورتك
        $_SESSION['user_id'] = $user['user_id']; 
        $_SESSION['user_role'] = $user['role'];

        // التوجيه بناءً على القيم الموجودة في صورتك (patient / doctor)
        if ($user['role'] == 'doctor') {
            header("Location: doctor/doctor_dashboard.php");
        } else if ($user['role'] == 'patient') {
            header("Location: patient/dashboard.php");
        }
        exit(); 
    } else {
        echo "خطأ: البيانات غير صحيحة";
    }
}
?>