<?php
header('Content-Type: application/json');

// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "sachmoi");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]);
    exit;
}

// Lấy dữ liệu gửi lên từ fetch
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode(["success" => false, "message" => "Thiếu ID sách cần xóa"]);
    exit;
}

$id = (int)$data['id']; // Ép kiểu để chắc chắn là số nguyên

// Dùng prepared statement để tránh SQL injection
$stmt = $conn->prepare("DELETE FROM sach WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Không thể xóa sách"]);
}

$stmt->close();
$conn->close();
?>
