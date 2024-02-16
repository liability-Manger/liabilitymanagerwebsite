<?php
// Include the database connection file
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    // var_dump($_REQUEST);
    // print_r($_POST);
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL query to check if the user exists in the database
    $query = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // User exists, redirect to dashboard or perform any other action
        // For example:
        
        header("Location: manager.php");
        exit();
    } else {
        // User doesn't exist or incorrect credentials, handle accordingly
        // For example:
        echo "Invalid email or password";
    }
}
?>
