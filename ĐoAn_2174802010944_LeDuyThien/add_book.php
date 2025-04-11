<?php
header('Content-Type: application/json');

// Thông tin kết nối CSDL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sachmoi";

// Kết nối
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Kết nối thất bại']);
    exit;
}

// Lấy dữ liệu JSON
$data = json_decode(file_get_contents("php://input"), true);

// Kiểm tra dữ liệu hợp lệ
if (!isset($data['title'], $data['author'], $data['price'], $data['category'])) {
    echo json_encode(['success' => false, 'error' => 'Thiếu thông tin']);
    $conn->close();
    exit;
}

// Xử lý và chống SQL injection
$title = $conn->real_escape_string($data['title']);
$author = $conn->real_escape_string($data['author']);
$price = floatval($data['price']);
$image_url = isset($data['image_url']) ? $conn->real_escape_string($data['image_url']) : null;
$category = $conn->real_escape_string($data['category']);

// Tạo câu lệnh SQL
$sql = "INSERT INTO sach (title, author, price, image_url, category) VALUES ('$title', '$author', $price, '$image_url', '$category')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Lỗi khi thêm sách: ' . $conn->error
    ]);
}

$conn->close();
?>
