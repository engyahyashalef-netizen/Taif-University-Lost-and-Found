<?php
// process_item.php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: AddItems.html');
    exit;
}

$type      = ($_POST['type'] === 'found') ? 'found' : 'lost';
$item_name = trim($_POST['item_name'] ?? '');
$location  = trim($_POST['location'] ?? '');
$datetime  = $_POST['datetime'] ?? '';
$now       = date('Y-m-d H:i:s');

// رفع الصورة
$photo_path = null;
if (!empty($_FILES['item_photo']['name'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $ext      = pathinfo($_FILES['item_photo']['name'], PATHINFO_EXTENSION);
    $newName  = uniqid('img_') . '.' . $ext;
    $target   = $uploadDir . $newName;
    if (move_uploaded_file($_FILES['item_photo']['tmp_name'], $target)) {
        $photo_path = $target;
    }
}

// حقول خاصة بـ lost
$feature       = $id_mark       = $prev_location = null;
if ($type === 'lost') {
    $feature       = trim($_POST['feature'] ?? null);
    $id_mark       = trim($_POST['id_mark'] ?? null);
    $prev_location = trim($_POST['prev_location'] ?? null);
}

// حقول خاصة بـ found
$item_condition = $contact_info = $extra_details = null;
if ($type === 'found') {
    $item_condition = trim($_POST['condition'] ?? null);
    $contact_info   = trim($_POST['contact_info'] ?? null);
    $extra_details  = trim($_POST['extra_details'] ?? null);
}

// إعداد الاستعلام باستخدام MySQLi
$sql = "INSERT INTO items
        (type, item_name, photo_path, location, datetime,
         feature, id_mark, prev_location,
         item_condition, contact_info, extra_details)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    exit('Database prepare failed: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    'sssssssssss',
    $type,
    $item_name,
    $photo_path,
    $location,
    $datetime,
    $feature,
    $id_mark,
    $prev_location,
    $item_condition,
    $contact_info,
    $extra_details
);

if (!mysqli_stmt_execute($stmt)) {
    exit('Error inserting data: ' . mysqli_stmt_error($stmt));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

header('Location: AddItems.html?success=1');
exit;
?>

