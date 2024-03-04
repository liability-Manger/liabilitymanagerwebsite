<?php
// Include the database connection file
include 'db_connection.php';

// Define daily expense amounts
$daily_expenses = [
    'utilities' => 7,
    'Web Hosting' => 5,
    'salaries' => 30,
    'network' => 2
];

// Get today's date
$today = date("Y-m-d");

// Insert daily expenses into the database
foreach ($daily_expenses as $category => $amount) {
    $sql = "INSERT INTO expenses (category, amount, date_added) VALUES ('$category', $amount, '$today')";
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection

?>
