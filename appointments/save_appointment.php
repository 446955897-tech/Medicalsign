<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicalsign";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id       = $_POST['patient_id'];
    $doctor_id        = $_POST['doctor_id'];
    $clinic_type      = $_POST['clinic_type'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $period           = $_POST['period'];

    $sql = "INSERT INTO appointments (patient_id, doctor_id, clinic_type, appointment_date, appointment_time, period) 
            VALUES ('$patient_id', '$doctor_id', '$clinic_type', '$appointment_date', '$appointment_time', '$period')";

    if ($conn->query($sql) === TRUE) {
        // نرجع استجابة نجاح عشان الـ Network يطلع أخضر
        http_response_code(200);
        echo "Success";
    } else {
        http_response_code(500);
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>