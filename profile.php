<?php
// 1. الاتصال بقاعدة البيانات وبدء الجلسة
include 'database/db.php';
session_start();

// 2. التحقق من أن المستخدم مسجل دخوله فعلياً
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$message = "";
$user_id = $_SESSION['user_id'];

// 3. معالجة تحديث كلمة المرور عند الضغط على الزر
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($new_password) && $new_password === $confirm_password) {
        // تحديث كلمة المرور في الجدول للمستخدم الحالي
        $sql = "UPDATE users SET password = '$new_password' WHERE user_id = '$user_id'";
        
        if (mysqli_query($conn, $sql)) {
            $message = "تم تحديث بيانات الحساب بنجاح ✅";
        } else {
            $message = "خطأ في التحديث: " . mysqli_error($conn);
        }
    } else {
        $message = "كلمات المرور غير متطابقة! ❌";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إعدادات الحساب</title>
    <link rel="stylesheet" href="CSS/style.css">
    
    <style>
        /* تنسيقات إضافية لظهور رسالة النجاح بشكل جميل */
        .success-message-php {
            background-color: #ebf5fb;
            color: #2980b9;
            padding: 10px;
            border-radius: 10px;
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #2980b9;
        }
        .btn-save { cursor: pointer; }
    </style>
</head>
<body>

    <div style="text-align: center; margin-top: 20px;">
        <img src="images/logo.png" width="120">
    </div>

    <h1 style="text-align: center;">إعدادات الحساب</h1>

    <div class="account-settings">
        <div class="box-description">
            يمكنك هنا تغيير كلمة المرور الخاصة بك 
        </div>
        
        <form method="POST" action="profile.php">
            <div class="setting-item">
                <label>كلمة المرور الجديدة</label>
                <input type="password" name="new_password" placeholder="يرجى إدخال كلمة المرور" required>
            </div>

            <div class="setting-item">
                <label>تأكيد كلمة المرور</label>
                <input type="password" name="confirm_password" placeholder="يرجى إعادة إدخال كلمة المرور" required>
            </div>

            <button type="submit" class="btn-save">حفظ التعديلات</button>
        </form>

        <div style="margin-top: 20px; text-align: center;">
            <a href="index.html" style="color: #2980b9; text-decoration: none; font-weight: bold; font-size: 14px;">
                العودة إلى الصفحة الرئيسية
            </a>
        </div>

        <?php if ($message != ""): ?>
            <div class="success-message-php">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="JAVA%20S/script.js"></script>

</body>
</html>
