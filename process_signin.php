<?php
// process_signin.php
session_start();
require_once 'config.php'; // يجب أن يحتوي على الاتصال بـ MySQLi ($conn)

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: SignIn.html');
    exit;
}

$email    = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    exit('All fields are required.');
}

$sql = "SELECT id, full_name, password FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    exit('Prepare failed: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) === 0) {
    exit('Invalid email or password.');
}

$user = mysqli_fetch_assoc($result);

// مقارنة كلمة المرور بدون تشفير (للتجارب فقط، يُنصح باستخدام hash مستقبلًا)
if ($user['password'] !== $password) {
    exit('Invalid email or password.');
}

// حفظ معلومات المستخدم في الجلسة
$_SESSION['user_id']   = $user['id'];
$_SESSION['full_name'] = $user['full_name'];

mysqli_stmt_close($stmt);
mysqli_close($conn);

header('Location: index.html');
exit;
?>

