<?php
// Include your database connection file
include 'db_connection.php';

// Check if email is set and not empty
if(isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Check if email already exists in the admins table
    $stmt = $conn->prepare("SELECT email FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "Email already in use. Please choose another email.";
    } else {
        // Email doesn't exist, proceed with signup
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new admin into the admins table using prepared statement
        $insertStmt = $conn->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
        $insertStmt->bind_param("sss", $name, $email, $hashed_password);
        if ($insertStmt->execute()) {
            header("Location: adminlogin.php");
        } else {
            echo "Error: " . $insertStmt->error;
        }
    }
    $stmt->close();
    $insertStmt->close();
} else {
    echo "Email field is required.";
}

$conn->close();
?>