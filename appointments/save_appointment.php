<?php

$host = "localhost";
$user = "root";  // اسم المستخدم الافتراضي في XAMPP
$pass = "";      
$db_name = "medicalsign"; // اسم قاعدة البيانات


$conn = mysqli_connect($host, $user, $pass, $db_name);


if (!$conn) {
    
    header('HTTP/1.1 500 Internal Server Error');
    die("Error connecting to database: " . mysqli_connect_error());
}


mysqli_set_charset($conn, "utf8mb4");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $p_id = isset($_POST['patient_id']) ? mysqli_real_escape_escape_string($conn, $_POST['patient_id']) : 1; 
    $d_id = isset($_POST['doctor_id']) ? mysqli_real_escape_string($conn, $_POST['doctor_id']) : 1;
    
    
    if (isset($_POST['appointment_date']) && !empty($_POST['appointment_date'])) {
        $a_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);

        
        $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date) 
                VALUES ('$p_id', '$d_id', '$a_date')";

        if (mysqli_query($conn, $sql)) {
        
            echo "success"; 
        } else {
            
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: التاريخ مطلوب.";
    }
} else {
    echo "Error: طريقة الإرسال غير صحيحة.";
}

mysqli_close($conn);
?>