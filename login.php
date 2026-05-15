<?php

session_start();
include 'database/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // 👇 ضع الشرط هنا بالضبط (في السطر 17)
    if ($user['is_active'] == 0) {
        echo "<script>
                alert('حسابك قيد الانتظار لموافقة الإدارة!'); 
                window.location.href='login.html';
              </script>";
        exit();
    }
        // تعديل اسم العمود ليكون user_id كما في صورتك
        $_SESSION['user_id'] = $user['user_id']; 
        $_SESSION['user_role'] = $user['role'];
       $_SESSION['specialty'] = $user['specialty'];
       $_SESSION['email'] = $user['email'];
       $_SESSION['full_name'] = !empty($user['full_name']) ? $user['full_name'] : $user['name'];

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