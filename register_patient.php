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

    
    $sql = "INSERT INTO users (full_name, email, password, role, Gender, `health condition`, `Dose he use headphones`) 
            VALUES ('$full_name', '$email', '$password', '$role', '$gender', '$health', '$headphone')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('تم إنشاء حساب المريض بنجاح'); window.location.href='login.html';</script>";
    } else {
        echo "خطأ في التسجيل: " . mysqli_error($conn);
    }
}
?>