<?php
include 'db_connection.php'; // Adjust this line to include your actual database connection script

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST['itemName'];
    $itemDescription = $_POST['itemDescription'];
    $itemPrice = $_POST['itemPrice'];

    $target_dir = "../../uploads/"; // Ensure this directory exists and is writable
    $target_file = $target_dir . basename($_FILES["itemImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["itemImage"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["itemImage"]["size"] > 500000) { // 500KB limit
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["itemImage"]["tmp_name"], $target_file)) {
            // File is uploaded successfully. Now insert item details into the database.
            $sql = "INSERT INTO items (item_image, item_name, item_description, item_price) VALUES (?, ?, ?, ?)";

            if($stmt = $conn->prepare($sql)){
                $stmt->bind_param("sssd", $target_file, $itemName, $itemDescription, $itemPrice);

                if($stmt->execute()){
                    // Redirect the user to a different page after form submission
                    header("Location: success.php"); // Replace "success.php" with the URL of your success page
                    exit(); // Terminate the script to prevent further execution
                } else{
                    echo "Error: " . $conn->error;
                }
                $stmt->close();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $conn->close();
}
?>
