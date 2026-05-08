<?php

include 'database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST['full_name'];
    $email     = $_POST['email'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role      = $_POST['role'];
    $gender    = $_POST['gender'];
    $health    = $_POST['health'];
    $headphone = $_POST['headphone'];

    $sql = "INSERT INTO users
    (full_name, email, password, role, Gender, `health condition`, `Dose he use headphones`)
    
    VALUES
    
    ('$full_name', '$email', '$password', '$role', '$gender', '$health', '$headphone')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
        alert('تم إنشاء الحساب بنجاح');
        window.location.href='login.html';
        </script>";

    } else {

        echo 'خطأ: ' . mysqli_error($conn);

    }
}

?>