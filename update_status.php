<?php
include 'database/db.php';

$action = $_POST['action'];
$identifier = $_POST['id']; // تأكدي إن الجافا سكريبت ترسل id

if ($action == 'approve_apt') {
    // 1. حالة قبول الموعد
    $sql = "UPDATE appointments SET status = 'approved' WHERE id = '$identifier'";
} 
elseif ($action == 'reject_apt') {
    // 2. حالة رفض الموعد
    $sql = "UPDATE appointments SET status = 'rejected' WHERE id = '$identifier'";
} 
elseif ($action == 'accept') {
    // 3. حالة قبول حساب جديد (هند) - هذا اللي كان ناقصك
   $sql = "UPDATE users SET is_active = 1 WHERE id = '$identifier'";
} 
elseif ($action == 'reject') {
    // 4. حالة رفض حساب جديد
    $sql = "DELETE FROM users WHERE id = '$identifier'";
}

// تنفيذ الاستعلام اللي اخترناه فوق
if (isset($sql) && mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error";
}
?>