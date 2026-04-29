<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $role = $_POST['role'];

    $query = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', '$role')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('تم إنشاء الحساب بنجاح!'); window.location.href='index.html';</script>";
    } else {
        echo "خطأ: " . mysqli_error($conn);
    }
}
?>