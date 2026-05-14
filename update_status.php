<?php
include 'database/db.php';

$action = $_POST['action'];
$identifier = $_POST['name'];

if ($action == 'approve_apt') {
    // تأكيد الموعد مباشرة
    $sql = "UPDATE appointments SET status = 'approved' WHERE id = '$identifier'";
} elseif ($action == 'reject_apt') {
    // إلغاء الموعد
    $sql = "UPDATE appointments SET status = 'rejected' WHERE id = '$identifier'";
} elseif ($action == 'pending_apt') {
    // إعادة للانتظار (إذا احتجتيها)
    $sql = "UPDATE appointments SET status = 'pending' WHERE id = '$identifier'";
}

if (isset($sql) && mysqli_query($conn, $sql)) {
    echo "تمت العملية بنجاح";
} else {
    // في حال كان الاستعلام فارغاً لن ينهار النظام بل سيعطي رسالة واضحة
    echo "إجراء غير معروف أو خطأ في البيانات";
}
?>