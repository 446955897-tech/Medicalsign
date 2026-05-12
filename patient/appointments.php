<?php
include 'db_config.php'; // استدعاء ملف الاتصال

// الاستعلام لجلب كافة المواعيد
$sql = "SELECT id, patient_id, doctor_id, clinic_type, appointment_date, appointment_time, period FROM appointments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مواعيدي الطبية</title>
    <style>
        /* ستايل بسيط ليتناسب مع الواجهة الخاصة بك */
        .appointments-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .appointments-table th, .appointments-table td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        .appointments-table th { background-color: #2980b9; color: white; }
        .appointments-table tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>

<div class="patient-container">
    <h2>قائمة المواعيد الطبية</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="appointments-table">
            <thead>
                <tr>
                    <th>رقم الموعد</th>
                    <th>نوع العيادة</th>
                    <th>التاريخ</th>
                    <th>الوقت</th>
                    <th>الفترة</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["clinic_type"]; ?></td>
                        <td><?php echo $row["appointment_date"]; ?></td>
                        <td><?php echo $row["appointment_time"]; ?></td>
                        <td><?php echo $row["period"]; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>لا توجد مواعيد مسجلة حالياً.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$conn->close(); // إغلاق الاتصال بعد الانتهاء
?>