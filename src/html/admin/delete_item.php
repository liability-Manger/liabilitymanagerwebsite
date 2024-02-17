<?php
include 'db_connection.php'; // Your database connection code

$id = $_POST['id'];

$sql = "DELETE FROM items WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo "Item deleted successfully";
} else {
    echo "Error deleting item: " . $conn->error;
}

$stmt->close();
$conn->close();
?>