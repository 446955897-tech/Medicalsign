<?php
session_start();
include '../database/db.php'; // تأكدي من المسار الصحيح لقاعدة البيانات

// التعديل هنا: نتحقق من أن المستخدم هو "doctor" وليس "patient"
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'doctor') {
    header("Location: ../login.html");
    exit();
}

// جلب اسم الدكتور من الجلسة لعرض مواعيده فقط
$doctor_name = $_SESSION['full_name']; 
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مواعيد الطبيب - Medical Sign</title>
    <style>
        :root {
            --primary-blue: #2980b9;
            --hover-blue: #1a5276;
            --page-bg: #eef2f7;
            --text-main: #2c3e50;
            --text-sub: #7f8c8d;
            --success-bg: #ebf5fb;
            --border-light: #ecf0f1;
            --shadow-blue: rgba(41, 128, 185, 0.1);
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--page-bg);
            color: var(--text-main);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            animation: fadeUp 0.8s ease;
        }

        .top-brand {
            text-align: center;
            margin-bottom: 35px;
        }

        .top-brand img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .top-brand h1 {
            color: var(--primary-blue);
            font-size: 34px;
            margin-bottom: 8px;
        }

        .top-brand p {
            color: var(--text-sub);
            font-size: 16px;
        }

        .page-header {
            background-color: var(--white);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px var(--shadow-blue);
            border-top: 5px solid var(--primary-blue);
            margin-bottom: 25px;
        }

        .page-header h2 {
            color: var(--primary-blue);
            font-size: 28px;
            margin-bottom: 10px;
        }

        .page-header p {
            color: var(--text-sub);
            font-size: 15px;
        }

        .table-card {
            background-color: var(--white);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px var(--shadow-blue);
            border-top: 5px solid var(--primary-blue);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 14px;
            text-align: right;
            font-size: 15px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid var(--border-light);
            font-size: 14px;
            color: var(--text-main);
            text-align: right;
        }

        tr:hover {
            background-color: #f8fbfd;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 10px;
            font-size: 13px;
        }

        .confirmed {
            background-color: var(--success-bg);
            color: var(--primary-blue);
        }

        .pending {
            background-color: #fdf2e9;
            color: #c27c0e;
        }

        .completed {
            background-color: #eafaf1;
            color: #239b56;
        }

        .action-btn {
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            padding: 8px 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s ease;
            font-size: 13px;
            margin-left: 6px;
        }

        .action-btn:hover {
            background-color: var(--hover-blue);
            transform: scale(1.05);
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 12px 18px;
            border-radius: 10px;
            transition: 0.3s ease;
            font-weight: bold;
        }

        .back-link:hover {
            background-color: var(--hover-blue);
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .top-brand h1 {
                font-size: 28px;
            }

            .page-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="top-brand">
            <img src="../images/logo.png" alt="شعار Medical Sign">
            <h1>Medical Sign</h1>
            <p>مواعيد الطبيب</p>
        </div>

        <div class="page-header">
            <h2>قائمة المواعيد</h2>
            <p>عرض كافة المواعيد الحالية والقادمة المسندة للطبيب.</p>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>اسم المريض</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                        <th>العيادة</th>
                        <th>الحالة</th>
                        <th> الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
<?php
// استعلام متطور يربط جدول المواعيد بجدول المستخدمين لجلب اسم المريض
$sql = "SELECT appointments.*, users.full_name AS patient_name 
        FROM appointments 
        INNER JOIN users ON appointments.patient_id = users.user_id 
        WHERE appointments.doctor_id = '$doctor_name' 
        ORDER BY appointment_date DESC";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['patient_name'] . "</td>"; 
    echo "<td>" . $row['appointment_date'] . "</td>";
    echo "<td>" . $row['appointment_time'] . "</td>";
    echo "<td>" . $row['clinic_type'] . "</td>";
    
    // هنا مكان عرض "حالة الموعد" ككلمة ملونة
    echo "<td>";
    if ($row['status'] == 'approved') {
        echo "<span class='status confirmed'>✅ تم التأكيد</span>";
    } elseif ($row['status'] == 'rejected') {
        echo "<span class='status' style='background-color:#f8d7da; color:#721c24;'>❌ ملغي</span>";
    } else {
        echo "<span class='status pending'>⏳ قيد الانتظار</span>";
    }
    echo "</td>";

    // هنا "أزرار الإجراءات" التي يتحكم بها الطبيب
    // داخل حلقة while المواعيد
       echo "<td>";
if ($row['status'] == 'approved') {
    // إذا الموعد مؤكد: نعرض الحالة وزر إلغاء فقط
    echo "<span class='status confirmed'>✅ تم التأكيد</span>";
    echo "<button class='action-btn' style='background-color: #e74c3c; margin-right:10px;' onclick='updateStatus(".$row['id'].", \"reject_apt\")'>إلغاء الموعد</button>";
} elseif ($row['status'] == 'rejected') {
    // إذا الموعد ملغي: نعرض الحالة مع إمكانية إعادته للانتظار
    echo "<span class='status' style='background-color:#f8d7da; color:#721c24;'>❌ ملغي</span>";
    echo "<button class='action-btn' style='background-color: #7f8c8d; margin-right:10px;' onclick='updateStatus(".$row['id'].", \"pending_apt\")'>إعادة للانتظار</button>";
} else {
    // إذا الحالة "انتظار": نعرض زرين (تأكيد وإلغاء)
    echo "<button class='action-btn' style='background-color: #2ecc71;' onclick='updateStatus(".$row['id'].", \"approve_apt\")'>تأكيد</button>";
    echo "<button class='action-btn' style='background-color: #e74c3c;' onclick='updateStatus(".$row['id'].", \"reject_apt\")'>إلغاء</button>";
}
       echo "</td>";

    echo "</tr>";
}
} else {
    echo "<tr><td colspan='5' style='text-align:center;'>لا توجد مواعيد مسجلة للطبيب: $doctor_name</td></tr>";
}
?>
     </tbody>
            </table>

            <a href="doctor_dashboard.php" class="back-link">الرجوع للوحة التحكم</a>
        </div>

    </div>
    <script>
        function updateStatus(appointmentId, action) {
            if (confirm("هل أنت متأكد من تنفيذ هذا الإجراء؟")) {
                fetch('../update_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=${action}&name=${appointmentId}`
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload(); // إعادة تحميل الصفحة لتحديث الحالة
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء تحديث الحالة.');
                });
            }
        }
    </script>
</body>
</html>