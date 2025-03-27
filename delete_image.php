<?php

require 'db_connection.php';
session_start();

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['id'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit;
}

$id = $data['id'];

$sql = "DELETE FROM file_uploads WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $id, SQLITE3_INTEGER);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Image deleted successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to delete image"]);
}

?>