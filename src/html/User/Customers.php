<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customers</title>
<link rel="stylesheet" href="../../css/Customers.css">
</head>
<body>
  <h1>Customers</h1>
  <button id="addCustomerBtn">Add Customer</button>
  <table id="customersTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Customer Type</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="customersTableBody">
      <!-- Customers will be dynamically added here -->
    </tbody>
  </table>

  <div id="addCustomerModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <input type="text" id="customerName" placeholder="Name">
      <input type="email" id="customerEmail" placeholder="Email">
      <input type="text" id="customerAddress" placeholder="Address">
      <select id="customerType">
        <option value="business">Business</option>
        <option value="individual">Individual</option>
      </select>
      <button id="saveCustomerBtn">Save Customer</button>
    </div>
  </div>
  <script src="../../js/Customers.js"></script>
  <script src="../../js/serever.js"></script>
</body>
</html>
