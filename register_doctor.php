<?php
include 'database/db.php'; // مسار الاتصال الصحيح بمشروعك

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // جلب البيانات وتنظيفها
    $full_name = mysqli_real_escape_string($conn, $_POST['doctor_name']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $password  = mysqli_real_escape_string($conn, $_POST['password']); // حفظ بدو تشفير ليطابق كود اللوجن عندك
    $role      = 'doctor';
    $is_active = 1; // تفعيل الحساب فوراً

    // الإدخال في الأعمدة الصحيحة (full_name وليس username)
    $sql = "INSERT INTO users (full_name, email, password, role, is_active) 
            VALUES ('$full_name', '$email', '$password', '$role', '$is_active')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('تم إنشاء حساب الدكتور بنجاح!'); window.location.href='login.html';</script>";
    } else {
        echo "خطأ في التسجيل: " . mysqli_error($conn);
    }
}
?>