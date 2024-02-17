<?php
include 'db_connection.php'; // Make sure you have your database connection file included

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customer_id'])) {
    $customer_id = $_POST['customer_id'];

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("DELETE FROM customers WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);

    if ($stmt->execute()) {
        echo "Customer deleted successfully";
    } else {
        echo "Error deleting customer: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No customer ID provided";
}
?>