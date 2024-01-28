// server.js

const http = require('http');
const fs = require('fs');
const path = require('path');

const server = http.createServer((req, res) => {
  if (req.url === '/save-customer' && req.method === 'POST') {
    let body = '';
    req.on('data', chunk => {
      body += chunk.toString(); // Convert Buffer to string
    });
    req.on('end', () => {
      const customerData = JSON.parse(body);
      saveCustomerData(customerData);
      res.end('Customer data saved successfully.');
    });
  } else {
    res.statusCode = 404;
    res.end('Not Found');
  }
});

function saveCustomerData(customerData) {
  const jsonFolderPath = path.join(__dirname, '../json/data.json'); // Path to your Json folder
  const jsonFilePath = path.join(jsonFolderPath, 'customers.json'); // Path to customers.json in Json folder
  const customers = JSON.parse(fs.readFileSync(jsonFilePath, 'utf8')) || [];
  customers.push(customerData);
  fs.writeFileSync(jsonFilePath, JSON.stringify(customers, null, 2), 'utf8');
}

server.listen(3000, () => {
  console.log('Server running on port 3000');
});
