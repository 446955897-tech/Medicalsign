<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login-doctor.html");
    exit();
}
$doctor_name = $_SESSION['username']; 
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
                    <tr>
                        <td>عائشة محمد</td>
                        <td>2026-04-12</td>
                        <td>10:00 صباحاً</td>
                        <td>استشارة Medical Sign</td>
                        <td><span class="status confirmed">مؤكد</span></td>
                        <td>
                            <button class="action-btn">عرض</button>
                            <button class="action-btn">إكمال</button>
                        </td>
                    </tr>

                    <tr>
                        <td>خالد سالم</td>
                        <td>2026-04-12</td>
                        <td>11:30 صباحاً</td>
                        <td>مساعدة في الترجمة</td>
                        <td><span class="status pending">قيد الانتظار</span></td>
                        <td>
                            <button class="action-btn">عرض</button>
                            <button class="action-btn">تأكيد</button>
                        </td>
                    </tr>

                    <tr>
                        <td>نورة علي</td>
                        <td>2026-04-12</td>
                        <td>01:00 مساءً</td>
                        <td>جلسة متابعة</td>
                        <td><span class="status confirmed">مؤكد</span></td>
                        <td>
                            <button class="action-btn">عرض</button>
                            <button class="action-btn">إكمال</button>
                        </td>
                    </tr>

                    <tr>
                        <td>فيصل أحمد</td>
                        <td>2026-04-13</td>
                        <td>09:30 صباحاً</td>
                        <td>استشارة أولية</td>
                        <td><span class="status completed">مكتمل</span></td>
                        <td>
                            <button class="action-btn">عرض</button>
                        </td>
                    </tr>

                    <tr>
                        <td>مها سعد</td>
                        <td>2026-04-13</td>
                        <td>12:00 مساءً</td>
                        <td>دعم التواصل الطبي</td>
                        <td><span class="status pending">قيد الانتظار</span></td>
                        <td>
                            <button class="action-btn">عرض</button>
                            <button class="action-btn">تأكيد</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <a href="doctor_dashboard.html" class="back-link">الرجوع للوحة التحكم</a>
        </div>

    </div>

</body>
</html>