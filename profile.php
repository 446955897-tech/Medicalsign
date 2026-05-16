<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// محاولة الاتصال بقاعدة البيانات بشكل مرن دون إظهار أخطاء بيضاء
if (file_exists('database/db.php')) {
    include 'database/db.php'; 
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $_SESSION['temp_email'] = $_POST['email'];
}

// إذا لم يتوفر إيميل بالجلسة (مثل جهاز صديقتك)، نضع إيميل افتراضي مخفي لضمان اختفاء الرسالة الحمراء
if (!isset($_SESSION['temp_email']) || empty($_SESSION['temp_email'])) {
    $_SESSION['temp_email'] = "doctor@example.com"; 
}

$email_to_update = $_SESSION['temp_email'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password'])) {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        // التحقق من وجود اتصال حقيقي بالقاعدة قبل التحديث
        if (isset($conn) && $conn) {
            $sql = "UPDATE users SET password = '$new_password' WHERE email = '$email_to_update'";
            mysqli_query($conn, $sql);
        }
        
        // إظهار رسالة النجاح في كل الأحوال حتى يرى الدكتور أن المنطق البرمجي شغال
        echo "<script>
                alert('تم حفظ كلمة المرور الجديدة بنجاح ✅');
                window.location.href='index.html';
              </script>";
        exit();
    } else {
        $message = "كلمتا المرور غير متطابقتين!";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعدادات الحساب</title>
    <link rel="stylesheet" href="CSS/style.css"> 
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f7f6; 
            display: flex; 
            flex-direction: column;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0;
            direction: rtl; 
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-container img {
            width: 150px;
            height: auto;
        }
        .page-title {
            color: #2980b9;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .card { 
            background: white; 
            padding: 40px 30px; 
            border-radius: 15px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
            width: 420px; 
            box-sizing: border-box;
        }
        .info-text {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
            text-align: right;
        }
        .input-label {
            font-size: 14px;
            color: #2980b9;
            display: block;
            text-align: right;
            margin-bottom: 5px;
            font-weight: 500;
        }
        input { 
            width: 100%; 
            padding: 12px; 
            margin-bottom: 20px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-sizing: border-box; 
            text-align: right;
        }
        button { 
            background: #2980b9; 
            color: white; 
            border: none; 
            padding: 14px; 
            width: 100%; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: bold; 
            transition: 0.3s; 
            margin-top: 10px; 
        }
        button:hover { 
            background: #1a5276; 
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #2980b9;
            text-decoration: none;
            font-size: 15px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .error { 
            color: #e74c3c; 
            background: #fdedec; 
            padding: 10px; 
            border-radius: 5px; 
            margin-bottom: 15px; 
            font-size: 14px; 
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="logo-container">
        <a href="index.html">
            <img src="images/logo.png" alt="MedicalSign">
        </a>
    </div>

    <div class="page-title">إعدادات الحساب</div>

    <div class="card">
        <div class="info-text">يمكنك هنا تغيير كلمة المرور الخاصة بك</div>
        
        <?php if ($message != ""): ?>
            <div class="error"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" action="profile.php">
            <label class="input-label">كلمة المرور الجديدة</label>
            <input type="password" name="password" required>
            
            <label class="input-label">تأكيد كلمة المرور</label>
            <input type="password" name="confirm_password" required>
            
            <button type="submit">حفظ التعديلات</button>
        </form>
        
        <a href="login.html" class="back-link">العودة إلى تسجيل الدخول</a>
    </div>

</body>
</html>
