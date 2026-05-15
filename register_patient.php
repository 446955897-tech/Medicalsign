<?php
include 'database/db.php'; // مسار الاتصال الصحيح بمشروعك

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // جلب البيانات من الفورم وتنظيفها
    $full_name = mysqli_real_escape_string($conn, $_POST['name']); // الـ name في الـ HTML يقابل full_name في القاعدة
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $password  = mysqli_real_escape_string($conn, $_POST['password']); // حفظ نص صريح ليطابق كود اللوجن عندك
    
    $role      = 'patient';
    $gender    = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
    $health    = isset($_POST['health']) ? mysqli_real_escape_string($conn, $_POST['health']) : '';
    $headphone = isset($_POST['headphone']) ? mysqli_real_escape_string($conn, $_POST['headphone']) : '';
    
    $is_active = 0; // جعل الحساب مفعل مباشرة لتسجيل الدخول بنجاح

    // أمر الإدخال المتوافق مع أسماء أعمدة جدولك الفعلي بالملي
    $sql = "INSERT INTO users (full_name, email, password, role, Gender, health_condition, Dose_he_use_headphones, is_active) 
            VALUES ('$full_name', '$email', '$password', '$role', '$gender', '$health', '$headphone', '$is_active')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('تم إنشاء حساب المريض بنجاح!'); window.location.href='login.html';</script>";
    } else {
        echo "خطأ في التسجيل: " . mysqli_error($conn);
    }
}
?>