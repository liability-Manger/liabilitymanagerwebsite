<?php
include 'db_connection.php';

// Fetch items from the database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

$items = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

// Return items as JSON
echo json_encode($items);
?>
