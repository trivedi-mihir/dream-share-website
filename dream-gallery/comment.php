<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image_id = $_POST['image_id'] ?? 0;
    $username = $_POST['username'] ?? '';
    $comment = $_POST['comment'] ?? '';

    if ($image_id && $username && $comment) {
        $stmt = $conn->prepare("INSERT INTO comments (image_id, username, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $image_id, $username, $comment);
        $stmt->execute();

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing data']);
    }
}
?>
