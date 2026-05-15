<?php
session_start();
include 'database/db.php'; 

// التحقق من أن المستخدم سجل دخوله
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        // تحديث كلمة المرور في قاعدة البيانات
        $sql = "UPDATE users SET password = '$new_password' WHERE user_id = '$user_id'";
        
        if (mysqli_query($conn, $sql)) {
            // 👇 هنا الرسالة التي طلبتِها
            echo "<script>
                    alert('تم حفظ كلمة المرور الجديدة بنجاح ✅');
                    window.location.href='index.html'; 
                  </script>";
            exit();
        } else {
            $message = "خطأ في التحديث: " . mysqli_error($conn);
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
    <title>تعديل الملف الشخصي</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; direction: rtl; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        button { background-color: #2980b9; color: white; border: none; padding: 12px; width: 100%; border-radius: 8px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #1a5276; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="card">
    <h2>تغيير كلمة المرور</h2>
    
    <?php if ($message != ""): ?>
        <p class="error"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="password" name="password" placeholder="كلمة المرور الجديدة" required>
        <input type="password" name="confirm_password" placeholder="تأكيد كلمة المرور" required>
        <button type="submit">حفظ التعديلات</button>
    </form>
    <br>
    <a href="index.html" style="text-decoration: none; color: #7f8c8d;">إلغاء</a>
</div>

</body>
</html>
