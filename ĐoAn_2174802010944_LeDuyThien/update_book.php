<?php
$conn = new mysqli("localhost", "root", "", "sachmoi");
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$title = $conn->real_escape_string($data['title']);
$author = $conn->real_escape_string($data['author']);
$price = (int)$data['price'];
$image_url = $conn->real_escape_string($data['image_url']);
$category = $conn->real_escape_string($data['category']);

$conn->query("UPDATE sach SET title='$title', author='$author', price=$price, image_url='$image_url', category='$category' WHERE id=$id");

echo json_encode(["success" => true]);
?>
