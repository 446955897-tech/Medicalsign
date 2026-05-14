<?php
include 'database/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $full_name = $_POST['name']; 
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    
    $role = 'patient'; 

    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $health = isset($_POST['health']) ? $_POST['health'] : '';
    $headphone = isset($_POST['headphone']) ? $_POST['headphone'] : '';

    $is_active = 0; 
    $status = 'pending';

   $sql = "INSERT INTO users (full_name, email, password, phone, role, is_active, status) 
        VALUES ('$full_name', '$email', '$password', '$phone', 'patient', '$is_active', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('تم إنشاء حساب المريض بنجاح'); window.location.href='login.html';</script>";
    } else {
        echo "خطأ في التسجيل: " . mysqli_error($conn);
    }
}
?>