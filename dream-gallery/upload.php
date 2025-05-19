<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caption = $_POST['caption'] ?? '';
    $filename = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $target = 'uploads/' . $filename;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo json_encode(['status' => 'error', 'message' => 'Upload failed']);
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO images (filename, caption) VALUES (?, ?)");
        $stmt->bind_param("ss", $filename, $caption);
        $stmt->execute();

        echo json_encode([
            'status' => 'success',
            'filename' => $filename,
            'caption' => $caption,
            'id' => $stmt->insert_id
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No file uploaded']);
    }
}
?>
