<?php

session_start();
include 'database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // البحث عن المستخدم
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND is_active = 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // تخزين البيانات
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['user_role'] = $user['role'];

        // التوجيه بناءً على الـ role الموجود في القاعدة
        if ($user['role'] == 'doctor') {
            header("Location: doctor/doctor_dashboard.php");
            exit();
        } else if ($user['role'] == 'patient') {
            // ملاحظة: تأكدي أن الملف في مجلد patient واسمه dashboard.html أو dashboard.php
            header("Location: patient/dashboard.html"); 
            exit();
        } else {
            echo "خطأ: لم يتم تحديد رتبة المستخدم (Role is NULL)";
        }
   } else {
    echo "<script>alert('البريد أو كلمة المرور غير صحيحة، أو أن حسابك بانتظار تفعيل الإدارة'); window.location='login.html';</script>";
        }
}
?>