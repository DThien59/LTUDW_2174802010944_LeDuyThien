<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sachmoi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin sách kèm tên thể loại
$sql = "SELECT sach.id, sach.title, sach.author, sach.price, sach.image_url, categories.name AS category
        FROM sach
        LEFT JOIN categories ON sach.category = categories.id
        ORDER BY sach.id DESC";

$result = $conn->query($sql);

$books = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($books);
$conn->close();
?>
