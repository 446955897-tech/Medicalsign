<?php
session_start();
include 'database/db.php'; 

$message = "";

// 1. نأخذ الإيميل اللي انكتب في صفحة الدخول
$email_to_update = isset($_SESSION['temp_email']) ? $_SESSION['temp_email'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($email_to_update)) {
        $message = "عذراً، لم نتمكن من تحديد الحساب. يرجى كتابة الإيميل في صفحة الدخول أولاً.";
    } elseif ($new_password === $confirm_password) {
        
        // 2. تحديث الباسورد بناءً على الإيميل
        $sql = "UPDATE users SET password = '$new_password' WHERE email = '$email_to_update'";
        
        if (mysqli_query($conn, $sql)) {
            // 3. رسالة النجاح والتحويل للرئيسية
            echo "<script>
                    alert('تم تغيير كلمة المرور بنجاح للحساب ($email_to_update) ✅');
                    window.location.href='index.html';
                  </script>";
            exit();
        } else {
            $message = "خطأ في قاعدة البيانات: " . mysqli_error($conn);
        }
    } else {
        $message = "كلمتا المرور غير متطابقتين!";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>استعادة كلمة المرور</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; direction: rtl; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); width: 380px; text-align: center; }
        h2 { color: #2980b9; margin-bottom: 10px; }
        .user-info { background: #ebf5fb; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; color: #1a5276; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { background: #2980b9; color: white; border: none; padding: 12px; width: 100%; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold; transition: 0.3s; }
        button:hover { background: #1a5276; }
        .error { color: #e74c3c; background: #fdedec; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="card">
    <h2>تغيير كلمة المرور</h2>
    
    <?php if ($email_to_update): ?>
        <div class="user-info">تغيير باسوورد الحساب: <b><?php echo $email_to_update; ?></b></div>
    <?php endif; ?>

    <?php if ($message != ""): ?>
        <div class="error"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="password" name="password" placeholder="كلمة المرور الجديدة" required>
        <input type="password" name="confirm_password" placeholder="تأكيد كلمة المرور" required>
        <button type="submit">تحديث ونجاح</button>
    </form>
</div>

</body>
</html>
