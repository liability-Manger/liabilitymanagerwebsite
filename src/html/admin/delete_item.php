<?php
// Include the database connection file
include 'db_connection.php';

// Retrieve the item ID from the POST request
$id = $_POST['id'];

// Prepare and execute the SQL query to delete the item from the database
$sql = "DELETE FROM items WHERE item_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // If deletion is successful, echo a success message
    echo "Item deleted successfully";
} else {
    // If an error occurs during deletion, echo an error message
    echo "Error deleting item: " . $conn->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
