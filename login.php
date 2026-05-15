<?php
// 1. بدء الجلسة واستدعاء ملف قاعدة البيانات
session_start();
include 'database/db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // جلب البيانات من الحقول الحالية وتنظيفها
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // 2. الاستعلام البسيط والآمن (البحث بالإيميل والباسورد فقط لتجنب الأخطاء)
   
        // تنبيه في حال كانت البيانات غير مطابقة
        echo "<script>
                alert('البريد الإلكتروني أو كلمة المرور غير صحيحة!');
                window.location.href='login.html';
              </script>";
    }$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("خطأ في الاستعلام: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    echo "تم العثور على المستخدم!"; // للتجربة فقط
    // بقية الكود...
} else {
    echo "لم يتم العثور على مستخدم بهذه البيانات في قاعدة البيانات.";
}

?>