<?php
include 'db_connection.php'; // Your database connection file

$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n'); // Current month by default
$year = date('Y'); // Current year

// Initialize arrays
$dates = [];
$incomeData = [];
$expensesData = [];

// Function to fetch data
function fetchData($conn, $table, $month, $year) {
    $sql = "SELECT DAY(date) AS day, SUM(amount) AS total_amount FROM {$table} 
            WHERE MONTH(date) = ? AND YEAR(date) = ? GROUP BY DAY(date) ORDER BY day ASC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $month, $year);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['day']] = $row['total_amount'];
    }
    return $data;
}

// Fetch income and expenses data
$incomeData = fetchData($conn, 'income_table', $month, $year);
$expensesData = fetchData($conn, 'expenses_table', $month, $year);

// Combine dates from both income and expenses
$