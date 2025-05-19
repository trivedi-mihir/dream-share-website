<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_id = $_POST['image_id'] ?? 0;

    $stmt = $conn->prepare("UPDATE images SET likes = likes + 1 WHERE id = ?");
    $stmt->bind_param("i", $image_id);
    $stmt->execute();

    echo json_encode(['status' => 'success']);
}
?>
