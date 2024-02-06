document.addEventListener('DOMContentLoaded', function() {
    const addCustomerBtn = document.getElementById('addCustomerBtn');
    const addCustomerModal = document.getElementById('addCustomerModal');
    const closeBtn = document.querySelector('.close');
    const saveCustomerBtn = document.getElementById('saveCustomerBtn');
    const customersTableBody = document.getElementById('customersTableBody');
  
    // Handle add customer button click
    addCustomerBtn.addEventListener('click', () => {
      addCustomerModal.style.display = 'block';
    });
  
    closeBtn.addEventListener('click', () => {
      addCustomerModal.style.display = 'none';
    });
  
    window.addEventListener('click', (e) => {
      if (e.target === addCustomerModal) {
        addCustomerModal.style.display = 'none';
      }
    });
  
    // Handle save customer button click
    saveCustomerBtn.addEventListener('click', () => {
      const customerName = document.getElementById('customerName').value;
      const customerEmail = document.getElementById('customerEmail').value;
      const customerAddress = document.getElementById('customerAddress').value;
      const customerType = document.getElementById('customerType').value;
  
      const customerData = {
        name: customerName,
        email: customerEmail,
        address: customerAddress,
        type: customerType
      };
  
      addCustomerToTable(customerData);
  
      addCustomerModal.style.display = 'none';
    });
  
    function addCustomerToTable(customerData) {
      const newRow = customersTableBody.insertRow();
      newRow.innerHTML = `
        <td>${customerData.name}</td>
        <td>${customerData.email}</td>
        <td>${customerData.address}</td>
        <td>${customerData.type}</td>
        <td><button class="deleteBtn">Delete</button></td>
      `;
    }
  });
  