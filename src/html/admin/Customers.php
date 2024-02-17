<?php
include 'db_connection.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add customer to database
    $name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $address = $_POST['address'];

    $sql = "INSERT INTO customers (customer_name, email, phone_number, address) VALUES ('$name', '$email', '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Customer added successfully.</p>";
    } else {
        echo "<p>Error adding customer: " . $conn->error . "</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers</title>
    <link rel="stylesheet" href="../../css/Customers.css"> <!-- Link to your CSS file -->
    <script>
function deleteCustomer(customerId) {
    if(confirm('Are you sure you want to delete this customer?')) {
        // AJAX request to a PHP file that handles deletion
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_customer.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                // Request finished. Do something here.
                alert('Customer deleted successfully');
                window.location.reload(); // Reload the page to see the changes
            }
        };
        xhr.send("customer_id=" + customerId);
    }
}

function toggleAddCustomerForm() {
        var form = document.getElementById('addCustomerForm');
        if (form.style.display === "none" || form.style.display === "") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }

    // Event listener for the 'Add Customer' button
    document.getElementById('showFormBtn').addEventListener('click', toggleAddCustomerForm);
;
    </script>
</head>
<body>
    <h1>Customer List</h1>
    <table id="customers">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
include 'db_connection.php';

// Fetch customers
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["customer_id"]."</td>
                <td>".$row["customer_name"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["phone_number"]."</td>
                <td>".$row["address"]."</td>
                <td>
                    <button onclick='deleteCustomer(".$row["customer_id"].")'>Delete</button>
                    <button onclick='showCustomerInfo(".$row["customer_id"].")'>Info</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No customers found</td></tr>";
};

$conn->close();
?>
        </tbody>
    </table>
    <button id="showFormBtn">Add Customer</button>

<div id="addCustomerForm">
    <h2>Add Customer</h2>
    <!-- Form for adding a new customer -->
    <form id="addCustomer" method="post">
        <input type="text" name="customer_name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone_number" placeholder="Phone Number" required>
        <input type="text" name="address" placeholder="Address" required>
        <button type="submit">Add Customer</button>
    </form>
</div>

<script>
  function showCustomerInfo(customerId) {
    // AJAX request to a PHP file that retrieves customer information
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "customer_info.php?customer_id=" + customerId, true);
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            // Request finished. Display customer information in a modal or popup.
            var customerInfo = JSON.parse(this.responseText);
            // Example: Display customer info in a popup alert
            alert("Customer Info:\n\nName: " + customerInfo.customer_name + "\nEmail: " + customerInfo.email + "\nPhone Number: " + customerInfo.phone_number + "\nAddress: " + customerInfo.address);
            // Example: Redirect to a customer info page
            // window.location.href = "customer_info.php?customer_id=" + customerId;
        }
    };
    xhr.send();
}

</script>
</body>
</html>