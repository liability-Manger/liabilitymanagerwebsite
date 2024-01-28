document.addEventListener("DOMContentLoaded", function () {
  const addItemBtn = document.getElementById("addItemBtn");
  const addItemModal = document.getElementById("addItemModal");
  const closeBtn = document.querySelector(".close");
  const saveItemBtn = document.getElementById("saveItemBtn");
  const itemsTableBody = document.getElementById("itemsTableBody");

  // Load data from local storage on page load
  window.addEventListener("load", () => {
    const savedItems = JSON.parse(localStorage.getItem("items")) || [];
    savedItems.forEach((item) => {
      addItemToTable(item);
    });
  });

  addItemBtn.addEventListener("click", () => {
    addItemModal.style.display = "block";
  });

  closeBtn.addEventListener("click", () => {
    addItemModal.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target === addItemModal) {
      addItemModal.style.display = "none";
    }
  });

  // Handle save item button click
  saveItemBtn.addEventListener("click", () => {
    const itemImage = document.getElementById("itemImage").value;
    const itemName = document.getElementById("itemName").value;
    const itemDescription = document.getElementById("itemDescription").value;
    const itemPrice = document.getElementById("itemPrice").value;

    const itemData = {
      image: itemImage,
      name: itemName,
      description: itemDescription,
      price: itemPrice,
    };

    // Save item to local storage
    let savedItems = JSON.parse(localStorage.getItem("items")) || [];
    savedItems.push(itemData);
    localStorage.setItem("items", JSON.stringify(savedItems));

    addItemToTable(itemData);

    addItemModal.style.display = "none";
  });

  // Handle delete button click
  itemsTableBody.addEventListener("click", (e) => {
    if (e.target.classList.contains("deleteBtn")) {
      const row = e.target.closest("tr");
      row.remove();

      // Remove item from local storage
      const savedItems = JSON.parse(localStorage.getItem("items"));
      const index = Array.from(row.parentNode.children).indexOf(row) - 1; // -1 to adjust for the table header
      savedItems.splice(index, 1);
      localStorage.setItem("items", JSON.stringify(savedItems));
    }
  });

  function addItemToTable(itemData) {
    const newRow = itemsTableBody.insertRow();
    newRow.innerHTML = `
        <td><img src="${itemData.image}" alt="" style="width: 50px; height: 50px; border-radius: 50%;"></td>
        <td>${itemData.name}</td>
        <td>${itemData.description}</td>
        <td>${itemData.price}</td>
        <td><button class="deleteBtn">Delete</button></td>
      `;
  }
});


