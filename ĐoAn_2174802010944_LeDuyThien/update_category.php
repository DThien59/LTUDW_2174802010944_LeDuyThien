<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "sachmoi");

$data = json_decode(file_get_contents("php://input"), true);
$id = (int)$data['id'];
$name = $conn->real_escape_string($data['name']);

$sql = "UPDATE categories SET name = '$name' WHERE id = $id";
if ($conn->query($sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Không thể cập nhật']);
}

$conn->close();
?>
