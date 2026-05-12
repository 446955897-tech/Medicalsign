<?php
session_start();
include '../database/db.php'; // استدعاء قاعدة البيانات

// التعديل: التحقق من full_name بدلاً من username
if (!isset($_SESSION['full_name']) || $_SESSION['user_role'] !== 'doctor') {
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
                        <th>الخدمة</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

               <tbody>
    <?php
    // لاحظي هنا استخدمنا doctor_id لأنه الاسم الموجود في صورتك لقاعدة البيانات
    $sql = "SELECT * FROM appointments WHERE doctor_id = '$doctor_name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['patient_id'] . "</td>"; // في صورتك العمود اسمه patient_id ويحتوي على الاسم
            echo "<td>" . $row['appointment_date'] . "</td>"; // في صورتك اسمه appointment_date
            echo "<td>" . $row['appointment_time'] . "</td>"; // في صورتك اسمه appointment_time
            echo "<td>" . $row['clinic_type'] . "</td>";      // في صورتك اسمه clinic_type
            echo "<td><span class='status confirmed'>مؤكد</span></td>";
            echo "<td><button class='action-btn'>عرض</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' style='text-align:center;'>لا توجد مواعيد مسجلة باسم: $doctor_name</td></tr>";
    }
    ?>
            </tbody>
            </table>

            <a href="doctor_dashboard.php" class="back-link">الرجوع للوحة التحكم</a>
        </div>

    </div>

</body>
</html>