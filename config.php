<?php
// config.php
// --- إعدادات الاتصال بقاعدة البيانات باستخدام MySQLi ---

$host = 'localhost';
$db   = 'taif_lost_and_found';
$user = 'root';
$pass = '';

// الاتصال بقاعدة البيانات
$conn = new mysqli($host, $user, $pass, $db);

// التحقق من الاتصال
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// ضبط الترميز
$conn->set_charset("utf8mb4");
?>

