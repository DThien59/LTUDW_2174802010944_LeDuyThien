<?php
header('Content-Type: application/json');

// Thông tin kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sachmoi";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Kết nối thất bại: ' . $conn->connect_error]);
    exit;
}

// Nhận dữ liệu JSON từ fetch
$data = json_decode(file_get_contents("php://input"), true);

// Kiểm tra nếu không có dữ liệu
if (!isset($data['name']) || empty(trim($data['name']))) {
    echo json_encode(['success' => false, 'error' => 'Tên danh mục không được để trống']);
    $conn->close();
    exit;
}

$name = trim($data['name']);

// Sử dụng Prepared Statement để chống SQL Injection
$stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
$stmt->bind_param("s", $name);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Lỗi khi thêm danh mục: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
