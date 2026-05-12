<?php
session_start();
include '../database/db.php';
// 1. التعديل: نتحقق من full_name لأن هذا ما خزنته في login.php
if (!isset($_SESSION['full_name']) || $_SESSION['user_role'] !== 'doctor') {
    // 2. التعديل: المسار الصحيح للعودة (نقطتين للخلف لأننا داخل مجلد doctor)
    header("Location: ../login.html"); 
    exit();
}

$doctor_name = $_SESSION['full_name']; 
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الطبيب - Medical Sign</title>
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
            --logout-bg: #34495e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--page-bg);
            color: var(--text-main);
            line-height: 1.6;
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
            width: 250px;
            height: auto;
            object-fit: contain;
            margin-bottom: 20px;
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

        .dashboard-header {
            background-color: var(--white);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px var(--shadow-blue);
            border-top: 5px solid var(--primary-blue);
            margin-bottom: 25px;
        }

        .dashboard-header h2 {
            color: var(--primary-blue);
            margin-bottom: 10px;
            font-size: 28px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background-color: var(--white);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px var(--shadow-blue);
            border-top: 5px solid var(--primary-blue);
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .card h3 {
            color: var(--primary-blue);
            font-size: 20px;
            margin-bottom: 12px;
        }

        .card .value {
            font-size: 28px;
            font-weight: bold;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .card .sub-text {
            color: var(--text-sub);
            font-size: 14px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr;
            gap: 20px;
        }

        .appointment-list {
            list-style: none;
        }

        .appointment-item {
            padding: 15px 0;
            border-bottom: 1px solid var(--border-light);
        }

        .appointment-item:last-child {
            border-bottom: none;
        }

        .appointment-item h4 {
            color: var(--text-main);
            font-size: 17px;
            margin-bottom: 6px;
        }

        .appointment-item p {
            color: var(--text-sub);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .status-box {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 10px;
            background-color: var(--success-bg);
            color: var(--primary-blue);
            font-size: 14px;
            margin-top: 15px;
        }

        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .action-btn {
            background-color: var(--primary-blue);
            color: var(--white);
            text-decoration: none;
            text-align: center;
            padding: 14px;
            border-radius: 10px;
            transition: 0.3s ease;
            font-size: 15px;
            font-weight: bold;
        }

        .action-btn:hover {
            background-color: var(--hover-blue);
            transform: scale(1.03);
        }

        .logout-btn {
            background-color: var(--logout-bg);
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        @media (max-width: 900px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="top-brand">
            <img src="../images/logo.png" alt="شعار Medical Sign">
            <h1>Medical Sign</h1>
            <p>لوحة تحكم الطبيب</p>
        </div>

        <div class="dashboard-header">
            <h2>مرحباً،  <?php echo $doctor_name; ?></h2>
            <p>قم بإدارة مواعيدك، ومراجعة جدول المرضى، ومتابعة نشاطك اليومي من مكان واحد.</p>
        </div>

        <div class="stats-grid">
            <div class="card">
                <h3>اسم الطبيب</h3>
                <div class="value"> <?php echo $doctor_name; ?></div>
               <div class="sub-text">
    <?php echo $_SESSION['specialty']; ?>
        </div>
            </div>

            <div class="card">
                <h3>إجمالي المواعيد</h3>
               <div class="value">
           <?php 
             $count_sql = "SELECT COUNT(*) as total FROM appointments WHERE doctor_id LIKE '%$doctor_name%'";
             $count_res = mysqli_query($conn, $count_sql);
             $count_data = mysqli_fetch_assoc($count_res);
            echo $count_data['total'];
            ?>
        </div>
                <div class="sub-text">كل المواعيد المجدولة</div>
            </div>

            <div class="card">
                <h3>مواعيد اليوم</h3>
                <?php 
                // جلب تاريخ اليوم
            $today = date('Y-m-d'); 


            $today_sql = "SELECT COUNT(*) as total FROM appointments WHERE doctor_id LIKE '%$doctor_name%' AND appointment_date = '$today'";

           $today_res = mysqli_query($conn, $today_sql);
           $today_data = mysqli_fetch_assoc($today_res);

           echo $today_data['total'];
                       ?>
                <div class="sub-text">المواعيد المقررة لهذا اليوم</div>
            </div>

            <div class="card">
                <h3>حالة التوفر</h3>
                <div class="value">متاح</div>
                <div class="sub-text">الطبيب جاهز لاستقبال المواعيد</div>
            </div>
        </div>

        <div class="content-grid">
            <div class="card">
                <h3>المواعيد القادمة</h3>
                <ul class="appointment-list">
    <?php
    include '../database/db.php'; // تأكدي من مسار ملف الاتصال
    
    // جلب آخر 3 مواعيد لهذا الدكتور فقط
    $sql = "SELECT * FROM appointments WHERE doctor_id LIKE '%$doctor_name%' ORDER BY appointment_date DESC LIMIT 3";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<li class="appointment-item">';
           echo '<h4> المريض: ' . $row['patient_id'] . '</h4>'; // في جدولك الاسم مخزن في patient_id
           echo '<p>التاريخ: ' . $row['appointment_date'] . ' | الوقت: ' . $row['appointment_time'] . '</p>';
            echo '</li>';
        }
    } else {
        echo '<p style="padding:10px; color:var(--text-sub);">لا توجد مواعيد قادمة حالياً.</p>';
    }
    ?>
        </ul>
            </div>

            <div class="card">
                <h3>إجراءات سريعة</h3>
                <div class="quick-actions">
                    <a href="appointments.php" class="action-btn">عرض كافة المواعيد</a>
                    <a href="../index.html" class="action-btn logout-btn">تسجيل الخروج</a>
                </div>
                <div class="status-box">الحالة الحالية: نشط ✅</div>
            </div>
        </div>

    </div>

</body>
</html>