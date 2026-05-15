<?php
session_start();
include '../database/db.php';
$patient_id = $_SESSION['user_id'];
$sql = "SELECT * FROM appointments WHERE patient_id = '$patient_id' AND status = 'approved'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedicalSign - مواعيدي</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body class="patient-body fade-in">
    <div class="patient-container">
        <div class="patient-card table-card">
            <div class="header">
                <img src="../images/logo.png" alt="MedicalSign Logo" class="logo">
                <h2>قائمة المواعيد المحجوزة</h2>
            </div>

            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                        <th>العيادة</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
              <tbody>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['appointment_date'] . "</td>";
            echo "<td>" . $row['appointment_time'] . "</td>";
            echo "<td>" . $row['clinic_type'] . "</td>";
            
            // تلوين الحالة
            $class = ($row['status'] == 'approved') ? 'confirmed' : 'pending';
            $text = ($row['status'] == 'approved') ? 'مؤكد' : 'قيد الانتظار';
            
            echo "<td><span class='status $class'>$text</span></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>لا يوجد مواعيد مسجلة لك حالياً.</td></tr>";
    }
    ?>
</tbody>
            </table>
            
            <button class="btn secondary-btn" onclick="location.href='dashboard.php'" style="margin-top: 20px;">
                العودة للملف الشخصي
            </button>
        </div>
    </div>
</body>
</html>