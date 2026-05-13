<?php
include('database/db.php'); 

if (isset($_POST['action']) && isset($_POST['name'])) {
    $action = $_POST['action'];
    $identifier = $_POST['name']; // هنا الاسم أو الـ ID

    if ($action == 'accept') {
        $sql = "UPDATE users SET is_active = 1 WHERE full_name = '$identifier'";
    } 
    elseif ($action == 'reject') {
        $sql = "DELETE FROM users WHERE full_name = '$identifier'";
    } 
    elseif ($action == 'approve_apt') {
        $sql = "UPDATE appointments SET status = 'approved' WHERE id = '$identifier'";
    } 
    elseif ($action == 'reject_apt') {
        $sql = "UPDATE appointments SET status = 'rejected' WHERE id = '$identifier'";
    }

    if (mysqli_query($conn, $sql)) {
        echo "تم تنفيذ العملية بنجاح";
    } else {
        echo "خطأ: " . mysqli_error($conn);
    }
}
?>