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

  // Handle delete and edit button click using event delegation
  itemsTableBody.addEventListener("click", (e) => {
    if (e.target.classList.contains("deleteBtn")) {
      const row = e.target.closest("tr");
      const index = row.rowIndex - 1; // Adjust for the table header
      row.remove();
      const savedItems = JSON.parse(localStorage.getItem("items"));
      savedItems.splice(index, 1);
      localStorage.setItem("items", JSON.stringify(savedItems));
    } else if (e.target.classList.contains("editBtn")) {
      const row = e.target.closest("tr");
      const index = row.rowIndex - 1; // Adjust for the table header
      const savedItems = JSON.parse(localStorage.getItem("items"));
      const itemToEdit = savedItems[index];
      editItem(itemToEdit, index);
    }
  });

  function addItemToTable(itemData) {
    const newRow = itemsTableBody.insertRow();
    newRow.innerHTML = `
        <td><img src="${itemData.image}" alt="" style="width: 50px; height: 50px; border-radius: 50%;"></td>
        <td>${itemData.name}</td>
        <td>${itemData.description}</td>
        <td>${itemData.price}</td>
        <td><button class="editBtn">Edit</button><button class="deleteBtn">Delete</button></td>
      `;
  }

  function editItem(item, index) {
    const itemImage = document.getElementById("itemImage");
    const itemName = document.getElementById("itemName");
    const itemDescription = document.getElementById("itemDescription");
    const itemPrice = document.getElementById("itemPrice");

    itemImage.value = item.image;
    itemName.value = item.name;
    itemDescription.value = item.description;
    itemPrice.value = item.price;

    saveItemBtn.onclick = function () {
      const updatedItemData = {
        image: itemImage.value,
        name: itemName.value,
        description: itemDescription.value,
        price: itemPrice.value,
      };

      let savedItems = JSON.parse(localStorage.getItem("items")) || [];
      savedItems[index] = updatedItemData;
      localStorage.setItem("items", JSON.stringify(savedItems));

      const row = itemsTableBody.children[index];
      row.children[0].innerHTML = `<img src="${updatedItemData.image}" alt="" style="width: 50px; height: 50px; border-radius: 50%;">`;
      row.children[1].textContent = updatedItemData.name;
      row.children[2].textContent = updatedItemData.description;
      row.children[3].textContent = updatedItemData.price;

      addItemModal.style.display = "none";
    };

    addItemModal.style.display = "block";
  }
});
