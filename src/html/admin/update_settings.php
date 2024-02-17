<!-- update_settings.php -->
<?php
// Include your database connection file
include 'db_connection.php';

// Start session (if not already started)
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or display error message
    header("Location: login.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Handle profile image upload (if provided)
    if ($_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["profile_image"]["tmp_name"];
        $image_name = basename($_FILES["profile_image"]["name"]);
        $target_path = "uploads/" . $image_name;
        move_uploaded_file($tmp_name, $target_path);
    }

    // Update user's information in the database
    $user_id = $_SESSION['user_id'];
    $sql = "UPDATE admins SET name='$name', email='$email', password='$password'";
    if ($_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $sql .= ", profile_image='$target_path'";
    }
    $sql .= " WHERE id='$user_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "User information updated successfully";
    } else {
        echo "Error updating user information: " . $conn->error;
    }
    
    // Close database connection
    $conn->close();
}
?>
