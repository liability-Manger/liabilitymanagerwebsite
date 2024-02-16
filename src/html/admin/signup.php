<?php
// Include your database connection file
include 'db_connection.php';

// Check if email is set and not empty
if(isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $name = $conn->real_escape_string($_POST['name']);

    // Check if email already exists in the admins table
    $sql = "SELECT email FROM admins WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email already exists
        echo "Email already in use. Please choose another email.";
    } else {
        // Email doesn't exist, proceed with signup
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new admin into the admins table
        $insertSql = "INSERT INTO admins (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if ($conn->query($insertSql) === TRUE) {
            header("Location: adminlogin.php");
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
} else {
    echo "Email field is required.";
}

$conn->close();
?>