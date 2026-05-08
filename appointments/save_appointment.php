<?php
session_start();

// 1. إعدادات الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";  // اسم المستخدم الافتراضي في XAMPP
$pass = "";      
$db_name = "medicalsign"; // اسم قاعدة البيانات كما ذكرتِ

// إنشاء الاتصال
$conn = mysqli_connect($host, $user, $pass, $db_name);

// التحقق من الاتصال
if (!$conn) {
    header('HTTP/1.1 500 Internal Server Error');
    die("Error connecting to database: " . mysqli_connect_error());
}

// ضبط الترميز لدعم اللغة العربية
mysqli_set_charset($conn, "utf8mb4");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. جلب البيانات من الفورم وتأمينها (تصحيح الخطأ المطبعي السابق)
    // ملاحظة: إذا لم يرسل الفورم id، سيتم وضع 1 كقيمة افتراضية
    $p_id = isset($_POST['patient_id']) ? mysqli_real_escape_string($conn, $_POST['patient_id']) : 1; 
    $d_id = isset($_POST['doctor_id']) ? mysqli_real_escape_string($conn, $_POST['doctor_id']) : 1;
    
    if (isset($_POST['appointment_date']) && !empty($_POST['appointment_date'])) {
        $a_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);

        // 3. أمر الإضافة (INSERT) مع أسماء الأعمدة الصحيحة والمفصولة بفاصلة
        $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date) 
                VALUES ('$p_id', '$d_id', '$a_date')";

        if (mysqli_query($conn, $sql)) {
            // نجاح العملية: إظهار رسالة وتوجيه المستخدم
            echo "<script>
                    alert('تم حجز الموعد بنجاح وحفظه في القاعدة!');
                    window.location.href='patient_dashboard.html'; 
                  </script>";
        } else {
            // في حال وجود خطأ في القاعدة سيعرض لكِ السبب بالضبط هنا
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('خطأ: يرجى اختيار تاريخ الموعد'); window.history.back();</script>";
    }
} else {
    echo "Error: طريقة الإرسال غير صحيحة (يجب استخدام POST).";
}

// إغلاق الاتصال
mysqli_close($conn);
?>