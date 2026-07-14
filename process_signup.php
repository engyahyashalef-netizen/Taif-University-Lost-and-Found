<?php
// process_signup.php
require_once 'config.php';  // يجب أن يحتوي على متغير $conn لمُعرف اتصال mysqli

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: SignUp.html');
    exit;
}

$full_name        = trim($_POST['full_name'] ?? '');
$email            = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$password         = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (!$full_name || !$email || !$password || !$confirm_password) {
    exit('All fields are required.');
}

if ($password !== $confirm_password) {
    exit('Passwords do not match.');
}

// تحقق من عدم وجود البريد مسبقاً
$sql_check = "SELECT id FROM users WHERE email = ?";
$stmt_check = mysqli_prepare($conn, $sql_check);
mysqli_stmt_bind_param($stmt_check, 's', $email);
mysqli_stmt_execute($stmt_check);
$result = mysqli_stmt_get_result($stmt_check);

if (mysqli_num_rows($result) > 0) {
    exit('Email already registered.');
}
mysqli_stmt_close($stmt_check);

// إدخال المستخدم الجديد
$sql_insert = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
$stmt_insert = mysqli_prepare($conn, $sql_insert);

if (!$stmt_insert) {
    exit('Prepare failed: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt_insert, 'sss', $full_name, $email, $password);
mysqli_stmt_execute($stmt_insert);
mysqli_stmt_close($stmt_insert);
mysqli_close($conn);

// إعادة التوجيه
header('Location: SignIn.html?registered=1');
exit;
?>

