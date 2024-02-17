<?php
session_start(); // Start the session at the very beginning

// Include the database connection file
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to fetch the user data from the database
    $query = "SELECT * FROM admins WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password (assuming you will hash passwords)
        // For now, we'll check the password directly, but you should use password hashing
        if ($password === $user['password']) { // Replace this line with password_verify if you use hashed passwords
            // Password is correct, set session variables
            $_SESSION['user_id'] = $user['id']; // Example of setting user ID in session
            $_SESSION['profile_image'] = $user['profile_image']; // Set profile image path in session

            // Redirect to dashboard
            header("Location: manager.php");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid email or password";
        }
    } else {
        // User doesn't exist
        echo "Invalid email or password";
    }
}
?>