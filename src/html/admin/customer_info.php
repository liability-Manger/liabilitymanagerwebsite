// Fetch customer information from the database
// Encode customer information as JSON
$customerData = array(
    "customer_name" => $customerName,
    "email" => $email,
    // Add other customer information here
);
echo json_encode($customerData);
