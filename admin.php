<?php
include 'database/db.php';

// جلب المستخدمين الذين ينتظرون القبول (is_active = 0)
$users_query = "SELECT * FROM users WHERE is_active = 0 AND role != 'admin'";
$users_result = mysqli_query($conn, $users_query);

// جلب المواعيد التي بانتظار الموافقة
$app_query = "SELECT * FROM appointments WHERE status = 'pending'";
$app_result = mysqli_query($conn, $app_query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المدير</title>
    
    <link rel="stylesheet" href="CSS/style.css">

    <style>
        h1 { text-align: center !important; margin: 30px auto !important; display: block !important; color: #2980b9; }
        .account-settings { background-color: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 10px rgba(41, 128, 185, 0.1); width: 80%; max-width: 600px; margin: 30px auto; }
        .box-description { margin-bottom: 20px; color: #2980b9; font-size: 16px; font-weight: bold; border-bottom: 2px solid #ebf5fb; padding-bottom: 10px; }
        .admin-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .admin-table td { padding: 12px 5px; border-bottom: 1px solid #f2f2f2; font-size: 14px; color: #34495e; }
        .btn-action { padding: 8px 15px; border: none; border-radius: 8px; cursor: pointer; font-size: 12px; transition: 0.3s; font-weight: bold; }
        .btn-approve { background-color: #27ae60; color: white; }
        .btn-reject { background-color: #e74c3c; color: white; margin-right: 5px; }

        .btn-approve:hover { background-color: #1e8449; transform: scale(1.05); }
        .btn-reject:hover { background-color: #c0392b; transform: scale(1.05); }
        .success-message { background-color: #ebf5fb; padding: 10px; border-radius: 10px; margin-top: 15px; display: none; text-align: center; }
    </style>
</head>
<body>

    <div style="text-align: center; margin-top: 20px;">
        <img src="images/logo.png" width="120">
    </div>

    <h1>لوحة تحكم المدير</h1>

    <div class="account-settings">
        
        <div class="box-description">إدارة المستخدمين الجدد</div>
        <table class="admin-table">
        <?php 
        while($user = mysqli_fetch_assoc($users_result)) { 
            // التحقق من الاسم الصحيح في جدولك (إن كان name أو full_name)
            $display_name = !empty($user['full_name']) ? $user['full_name'] : $user['name'];
            $role_type = ($user['role'] == 'doctor' ? 'طبيب' : 'مريض');
            
            // التعديل الجوهري: نأخذ الـ user_id الصحيح من الجدول ونرسله للزر
            $uid = $user['user_id']; 
        ?>
        <tr id="user-row-<?php echo $uid; ?>">
            <td><?php echo $display_name; ?> (<?php echo $role_type; ?>)</td>
            <td style="text-align: left;">
                <button class="btn-action btn-approve" onclick="adminAction('accept', '<?php echo $uid; ?>')">قبول</button>
                <button class="btn-action btn-reject" onclick="adminAction('reject', '<?php echo $uid; ?>')">رفض</button>
            </td>
        </tr>
        <?php } ?>
        </table>

        <div class="box-description">إدارة المواعيد الطبية</div>
        <table class="admin-table">
        <?php while($app = mysqli_fetch_assoc($app_result)) { ?>
        <tr id="app-row-<?php echo $app['id']; ?>">
            <td>موعد: <?php echo $app['doctor_id']; ?> (المريض: <?php echo $app['patient_id']; ?>)</td>
            <td style="text-align: left;">
                <button class="btn-action btn-approve" onclick="adminAction('approve_apt', '<?php echo $app['id']; ?>')">موافقة</button>
                <button class="btn-action btn-reject" onclick="adminAction('reject_apt', '<?php echo $app['id']; ?>')">إلغاء</button>
            </td>
        </tr>
        <?php } ?>
        </table>

        <div style="margin-top: 20px; text-align: center;">
            <a href="index.html" style="color: #2980b9; text-decoration: none; font-weight: bold; font-size: 14px;">
                تسجيل الخروج من لوحة المدير
            </a>
        </div>

        <div class="success-message" id="adminMsg"></div>
    </div>

    <script>
        function adminAction(actionName, targetId) {
            let message = document.getElementById("adminMsg");
            
            // إرسال الـ ID الرقمي الصحيح للخلفية
            fetch('update_status.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=' + actionName + '&id=' + targetId
            })
            .then(response => response.text())
            .then(data => {
                // إظهار رسالة النجاح
                message.style.display = "block";
                message.innerText = "تمت العملية بنجاح ✅";
                
                // حركة ذكية: إخفاء السطر فوراً من الشاشة بدون انتظار إعادة تحميل الصفحة
                if(actionName === 'accept' || actionName === 'reject') {
                    let row = document.getElementById("user-row-" + targetId);
                    if(row) row.style.display = "none";
                } else {
                    let row = document.getElementById("app-row-" + targetId);
                    if(row) row.style.display = "none";
                }

                setTimeout(() => {
                    message.style.display = "none";
                }, 2000);
            });
        }
    </script>

    <script src="JAVA%20S/script.js"></script>

</body>
</html>
