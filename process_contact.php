<?php
// process_contact.php
require_once 'config.php';

// تأكد من الإرسال عبر POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ContactUs.html');
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$email     = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$subject   = trim($_POST['subject'] ?? '');
$message   = trim($_POST['message'] ?? '');

if (!$full_name || !$email || !$subject || !$message) {
    exit('All fields are required.');
}

// إعداد الاستعلام مع الحماية من الحقن
$query = "INSERT INTO contact_messages (full_name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    exit('Database prepare failed: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssss", $full_name, $email, $subject, $message);

if (!mysqli_stmt_execute($stmt)) {
    exit('Failed to save message: ' . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

header('Location: ContactUs.html?success=1');
exit;
?>

