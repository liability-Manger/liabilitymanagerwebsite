<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Store Items</title>
<link rel="stylesheet" href="../../css/items.css">

</head>
<body>
  <h1>Items</h1>
  <button id="addItemBtn">Add Item</button>
  <table id="itemsTable">
    <thead>
      <tr>
       
        <th>Item Name</th>
        <th>Item Description</th>
        <th>Item Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="itemsTableBody">
  <?php
  include 'db_connection.php'; // Adjust this line to include your actual database connection script
  $sql = "SELECT * FROM items";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr>
        
        <td>" . $row["item_name"] . "</td>
        <td>" . $row["item_description"] . "</td>
        <td>" . $row["item_price"] . "</td>
        <td>
            <button class='editBtn' data-id='" . $row["id"] . "'>Edit</button>
            <button class='deleteBtn' data-id='" . $row["id"] . "'>Delete</button>
        </td>
      </tr>";
      }
  } else {
      echo "<tr><td colspan='5'>No items found</td></tr>";
  }
  $conn->close();
  ?>
</tbody>
  </table>

  <div id="addItemModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form action="insert_item.php" method="post" enctype="multipart/form-data">
        
        <input type="text" id="itemName" name="itemName" placeholder="Item Name">
        <input type="text" id="itemDescription" name="itemDescription" placeholder="Item Description">
        <input type="number" id="itemPrice" name="itemPrice" placeholder="Item Price">
        <button type="submit" id="saveItemBtn">Save Item</button>
      </form>
    </div>
  </div>

  <script src="../../js/items.js"></script>
</body>
</html>
