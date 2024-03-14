<?php
include 'db_connection.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add item to database
    $name = $_POST['item_name'];
    $description = $_POST['item_description'];
    $price = $_POST['item_price'];

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO items (item_name, item_description, item_price) VALUES (?, ?, ?)");
    // Bind parameters
    $stmt->bind_param("ssd", $name, $description, $price);
    // Execute statement
    if ($stmt->execute()) {
        echo "<p>Item added successfully.</p>";
    } else {
        echo "<p>Error adding item: " . $stmt->error . "</p>";
    }
    // Close statement
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Items</title>
    <!-- Include your CSS file here -->
    <script>
       function deleteItem(itemId) {
           if(confirm('Are you sure you want to delete this item?')) {
        // AJAX request to a PHP file that handles deletion
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_item.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Request finished. Do something here.
                alert('Item deleted successfully');
                window.location.reload(); // Reload the page to see the changes
            }
        };
        xhr.send("item_id=" + itemId);
        }}
        function toggleAddItemForm() {
            var form = document.getElementById('addItemForm');
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
                } else {
                    form.style.display = "none";
                    }}
        // Event listener for the 'Add Item' button
        document.getElementById('showFormBtn').addEventListener('click', toggleAddItemForm);
        ;
    </script>
    <script src="items.js"></script>
    
</head>
<body>
    <h1>Item List</h1>
    <table id="items">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include 'db_connection.php';
        // Fetch items
        $sql = "SELECT * FROM items";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["item_id"]."</td>
                <td>".$row["item_name"]."</td>
                <td>".$row["item_description"]."</td>
                <td>".$row["item_price"]."</td>
                <td>
                    <button onclick='deleteItem(".$row["item_id"].")'>Delete</button>
                    <button onclick='showItemInfo(".$row["item_id"].")'>Info</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No items found</td></tr>";
};

$conn->close();
?>
        </tbody>
    </table>
    <button id="showFormBtn" onclick="toggleAddItemForm()">Add Item</button>

<div id="addItemForm">
    <h2>Add Item</h2>
    <!-- Form for adding a new item -->
    <form id="addItem" method="post">
        <input type="text" name="item_name" placeholder="Name" required>
        <input type="text" name="item_description" placeholder="Description" required>
        <input type="number" step="0.01" name="item_price" placeholder="Price" required>
        <button type="submit">Add Item</button>
    </form>
</div>

<script>
  function showItemInfo(itemId) {
    // AJAX request to a PHP file that retrieves item information
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "item_info.php?item_id=" + itemId, true);
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Request finished. Display item information in a modal or popup.
            var itemInfo = JSON.parse(this.responseText);
            // Example: Display item info in a popup alert
            alert("Item Info:\n\nName: " + itemInfo.item_name + "\nDescription: " + itemInfo.item_description + "\nPrice: $" + itemInfo.item_price.toFixed(2));
            // Example: Redirect to an item info page
            // window.location.href = "item_info.php?item_id=" + itemId;
        }
    };
    xhr.send();
    }
    function deleteItem(itemId) {
        if (confirm('Are you sure you want to delete this item?')) {
            // AJAX request to delete_item.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_item.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    // Request finished. Do something here.
                    alert(this.responseText); // Display response from delete_item.php
                    window.location.reload(); // Reload the page to see the changes
                }
            };
            xhr.send("id=" + itemId); // Send item ID to delete_item.php
        }
    }


</script>
</body>
</html>
