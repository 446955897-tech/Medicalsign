<?php

session_start();
include 'database/db.php'; // تأكدي أن المسار لملف القاعدة صح

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // نبحث عن المستخدم في جدول users العام
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // تخزين البيانات في الجلسة (Session)
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['full_name'] = $user['full_name'];

        // --- التوجيه حسب نوع الحساب (الرول) ---
       if ($user['role'] == 'admin') {
            header("Location: admin.php"); // يفتح صفحة الأدمن
        } elseif ($user['role'] == 'doctor') {
            header("Location: doctor/doctor_dashboard.php"); // يفتح صفحة الدكتور
        } else {
            header("Location: patient/dashboard.php"); // يفتح صفحة المريض
        }
        exit();
    } else {
        echo "<script>alert('البريد أو كلمة المرور غير صحيحة'); window.location.href='login.html';</script>";
    }
}
?>