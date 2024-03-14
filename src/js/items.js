document.addEventListener("DOMContentLoaded", function () {
  const addItemBtn = document.getElementById("addItemBtn");
  const addItemModal = document.getElementById("addItemModal");
  const closeBtn = document.querySelector(".close");
  const form = document.querySelector("#addItemModal form");
  const itemsTableBody = document.getElementById("itemsTableBody");

  // Show the add item modal
  addItemBtn.addEventListener("click", () => {
    addItemModal.style.display = "block";
  });

  // Close the modal when the close button is clicked
  closeBtn.addEventListener("click", () => {
    addItemModal.style.display = "none";
  });

  // Close the modal when clicking outside of it
  window.addEventListener("click", (e) => {
    if (e.target === addItemModal) {
      addItemModal.style.display = "none";
    }
  });

  // Handle form submission with AJAX
  form.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    const formData = new FormData(form);

    fetch("insert_item.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data); // Log the server response for debugging
        // Optionally, you can refresh the items list here or add the new item directly to the table
        window.location.reload(); // Simple way to refresh the items list after adding
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

  // Handle deletion of items
  itemsTableBody.addEventListener("click", function (e) {
    if (e.target.classList.contains("deleteBtn")) {
      const itemId = e.target.getAttribute("data-id");
      if (confirm("Are you sure you want to delete this item?")) {
        fetch("delete_item.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `id=${itemId}`,
        })
          .then((response) => response.text())
          .then((data) => {
            console.log(data);
            window.location.reload(); // Reload to update the item list
          })
          .catch((error) => console.error("Error:", error));
      }
    }
  });
});
