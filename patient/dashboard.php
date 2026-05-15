<?php
session_start();
include '../database/db.php'; 

// التحقق من أن المستخدم مسجل دخول وأنه مريض
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'patient') {
    header("Location: ../login.html"); // توجيه لصفحة الدخول إذا حاول الدخول مباشرة
    exit();
}

// جلب البيانات من الجلسة (التي قمنا بتخزينها في login.php)
$patientName = $_SESSION['full_name'];
$patientEmail = $_SESSION['email'];
// ملاحظة: تأكدي من تخزين الرقم (phone) في login.php لكي يظهر هنا، أو سيعرض "غير مسجل"
$patientPhone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '05XXXXXXXX';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedicalSign - لوحة المريض</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="patient-body">
    <div class="patient-container">
        <div class="patient-card profile-card fade-in">
            
            <div class="header">
                <img src="../images/logo.png" alt="MedicalSign Logo" class="logo">
                <h1>لوحة بيانات المريض</h1>
            </div>

            <div class="patient-info">
                <p><strong>الاسم:</strong> <samp id="patientName"><?php echo $patientName; ?></samp></p>
                <p><strong>الرقم:</strong> <samp id="patientPhone"><?php echo $patientPhone; ?></samp></p>
                <p><strong>الإيميل:</strong> <samp id="patientEmail"><?php echo $patientEmail; ?></samp></p>
            </div>
            
            <div class="action-buttons">
                <button class="btn main-btn" onclick="location.href='../symptoms/symptoms.php'">
                    🔍 استكشاف الأعراض
                </button>
               <button class="btn main-btn" onclick="openEditModal()">✏️ تعديل البيانات</button>
                <button onclick="location.href='appointments.php'">📅 مواعيدي الطبية</button>
            </div>

            <div style="display: flex; gap: 15px; justify-content: center; margin-top: 30px; border-top: 1px solid #ecf0f1; padding-top: 25px;">
                <a href="../appointments/booking.html" class="btn main-btn" style="text-decoration: none; padding: 12px 20px; flex: 1; text-align: center;">
                    📅 حجز موعد جديد
                </a> 
                <a href="../index.html" class="btn" style="text-decoration: none; padding: 12px 20px; flex: 1; text-align: center; background-color: #c0392b; color: white;">
                    🚪 تسجيل الخروج
                </a>
            </div>
        </div> 
    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3>تعديل الملف الشخصي</h3>
            <input type="text" id="newName" placeholder="الاسم الجديد" value="<?php echo $patientName; ?>">
            <input type="text" id="newPhone" placeholder="الرقم الجديد" value="<?php echo $patientPhone; ?>">
            <input type="text" id="newEmail" placeholder="الإيميل الجديد" value="<?php echo $patientEmail; ?>">
            <div style="display: flex; gap: 10px; margin-top: 15px;">
                <button class="btn" onclick="saveChanges()" style="background: #2980b9; color: white; flex: 1;">حفظ</button>
                <button class="btn" onclick="closeEditModal()" style="background: #7f8c8d; color: white; flex: 1;">إلغاء</button>
            </div>
        </div>
    </div>

    <script>
        function openEditModal() { document.getElementById('editModal').style.display = 'block'; }
        function closeEditModal() { document.getElementById('editModal').style.display = 'none'; }
        
        // ملاحظة: هذه الدالة حالياً تعدل في المتصفح فقط، تحتاجين لملف PHP لتعديلها في قاعدة البيانات
        function saveChanges() {
            let nameValue = document.getElementById('newName').value;
            let phoneValue = document.getElementById('newPhone').value;
            let emailValue = document.getElementById('newEmail').value;
            if(nameValue) document.getElementById('patientName').innerText = nameValue;
            if(phoneValue) document.getElementById('patientPhone').innerText = phoneValue;
            if(emailValue) document.getElementById('patientEmail').innerText = emailValue;
            closeEditModal();
            alert("تم التعديل في الواجهة، لطلب تعديل دائم يجب ربطها بقاعدة البيانات.");
        }
    </script>   
</body>
</html>