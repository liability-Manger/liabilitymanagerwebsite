<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiabilityManager</title>
    <link rel="stylesheet" href="../../css/Liabilitymanager.css">
    <style>
        
    </style>
    <script src="https://kit.fontawesome.com/bf045329d4.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="logo">
        <img src="../../images/lm.png" alt="Logo" width="70px" height="70px">
    </div>
    <div class="search">
        <input type="text" id="searchInput" placeholder="Search...">
        <button onclick="searchFunction()">Search</button> <!-- Add this button -->
    </div>
    
    <div class="user-profile" onclick="toggleProfileMenu()">
    <a href="settings.php">
    <img src="<?php echo isset($_SESSION['profile_image']) ? '../../uploads/' . $_SESSION['profile_image'] : '../../images/profile.png'; ?>" class="profile-circle">
    <div class="profile-menu" id="profileMenu">

    </div>
    </a>
</div>
    <div class="settings">
        <a href="#"><i class="fa-solid fa-gear"></i></a>
    </div>
    

    
</header>

    <div id="sidebar">
        <a href="#" onclick="loadPage('home.php')">Home test</a>
        <a href="#" onclick="loadPage('items.php')">Items</a>
        <a href="#" onclick="loadPage('banking.php')">Banking</a>
        <a href="#" onclick="loadPage('')">Sales</a>
        <a href="#" onclick="loadPage('Customers.php')">Customers</a>
        <a href="#" onclick="loadPage('SalesReceipts.php')">Sales Receipts</a>
        <a href="#" onclick="loadPage('PaymentsReceived.php')">Payments Received</a>
        <a href="#" onclick="loadPage('purchases.php')">Purchases</a>
        <a href="#" onclick="loadPage('time_tracking.php')">Time Tracking</a>
        <a href="#" onclick="loadPage('accountant.php')">Accountant</a>
        <a href="#" onclick="loadPage('reports.php')">Reports</a>
        <a href="#" onclick="loadPage('ChatBot.php')">ChatBot</a>
    </div>
    <div id="content">
        <iframe id="iframe" src="home.php"></iframe>
    </div>
    <script>
function toggleProfileMenu() {
    var menu = document.getElementById("profileMenu");
    // Toggle display
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}
</script>
    

    <script src="../../js/LiabilityManager.js"></script>
</body>
</html>
