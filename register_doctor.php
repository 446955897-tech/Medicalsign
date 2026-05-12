<?php

include 'database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // جلب البيانات من فورم الدكتور
    $full_name = $_POST['doctor_name']; // تأكدي أن name في الـ HTML هو 'doctor_name'
    $email     = $_POST['email'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role      = 'doctor'; // نحدد الرتبة دكتور يدوياً هنا

    // نترك حقول المريض فارغة (NULL) في جدول المستخدمين
    $sql = "INSERT INTO users 
            (username, email, password, role) 
            VALUES 
            ('$full_name', '$email', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('تم إنشاء حساب الدكتور بنجاح'); window.location.href='login-doctor.html';</script>";
    } else {

        echo 'خطأ: ' . mysqli_error($conn);

    }
}

?>