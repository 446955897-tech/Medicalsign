<?php
// 1. تضمين ملف الاتصال بقاعدة البيانات (نفس أسلوب زميلتك)
include '../database/db.php'; 

// التأكد من أن الإرسال تم عبر POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. استلام البيانات من الحقول (الأسماء مطابقة للـ HTML حقك)
    $patient_id       = $_POST['patient_id'];      
    $clinic_type      = $_POST['clinic_type'];     
    $doctor_id        = $_POST['doctor_id'];       
    $appointment_date = $_POST['appointment_date']; 
    $period           = $_POST['period'];           
    $appointment_time = $_POST['appointment_time']; 

    // 3. جملة الاستعلام لجدول المواعيد (appointments)
    $sql = "INSERT INTO appointments (patient_id, doctor_id, clinic_type, appointment_date, appointment_time, period) 
            VALUES ('$patient_id', '$doctor_id', '$clinic_type', '$appointment_date', '$appointment_time', '$period')";

    // 4. تنفيذ الاستعلام بنفس طريقة البنت (mysqli_query)
    if (mysqli_query($conn, $sql)) {
        // إرجاع رد نجاح عشان الـ Network يطلع أخضر (Status 200)
        http_response_code(200);
        echo "Success: تم حفظ الموعد في القاعدة بنجاح";
    } else {
        // في حال وجود خطأ في قاعدة البيانات
        http_response_code(500);
        echo "Error: " . mysqli_error($conn);
    }
}

// إغلاق الاتصال
mysqli_close($conn);
?>