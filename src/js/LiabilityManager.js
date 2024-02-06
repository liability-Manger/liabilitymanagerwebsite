function searchFunction() {
    var searchInput = document.getElementById("searchInput");
    var searchTerm = searchInput.value.trim();
    
    if (searchTerm !== '') {
        var searchResults = []; // Array to store search results
        var allContent = document.querySelectorAll('.content-to-search'); // Adjust this selector to match the content you want to search through
        
        // Loop through each content element
        allContent.forEach(function(element) {
            var contentText = element.innerText.toLowerCase();
            // Check if the content contains the search term
            if (contentText.includes(searchTerm.toLowerCase())) {
                searchResults.push(element);
            }
        });

        if (searchResults.length > 0) {
            // Display or handle search results
            alert("Found " + searchResults.length + " results for: " + searchTerm);
            // Example: Display search results in console
            console.log(searchResults);
        } else {
            alert("No results found for: " + searchTerm);
        }
    } else {
        alert("Please enter a search term.");
    }
}

function loadPage(page) {
    document.getElementById('iframe').src = page;
}

function toggleProfileMenu() {
    var menu = document.getElementById("profileMenu");
    menu.classList.toggle("show");
}

// Close the menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.user-profile')) {
        var menus = document.getElementsByClassName("profile-menu");
        for (var i = 0; i < menus.length; i++) {
            var menu = menus[i];
            if (menu.classList.contains('show')) {
                menu.classList.remove('show');
            }
        }
    }
}
