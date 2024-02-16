<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Financial Report Generator</title>
<style>
.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
}
button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 10px;
}
button:hover {
    background-color: #0056b3;
}
#reportContainer {
    margin-top: 20px;
    text-align: left;
}
</style>
</head>
<body>
<div class="container">
    <h1>Financial Report Generator</h1>
    <form id="generateReportForm">
        <button type="submit" id="generateReportBtn">Generate Report</button>
        <button type="button" id="saveReportBtn">Save Report</button>
    </form>
    <div id="reportContainer"></div>
</div>
<script>
document.getElementById('generateReportForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    fetch('generate_report.php') // Change to your PHP file path
    .then(response => response.text())
    .then(data => {
        document.getElementById('reportContainer').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
});

document.getElementById('saveReportBtn').addEventListener('click', function() {
    var reportContent = document.getElementById('reportContainer').innerText;
    if (!reportContent) {
        alert('Please generate a report first.');
        return;
    }

    // AJAX request to save the report
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_report.php'); // Change to your PHP file path
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Report saved successfully!');
        } else {
            alert('Error saving report. Please try again.');
        }
    };
    xhr.send('reportContent=' + encodeURIComponent(reportContent));
});
</script>
</body>
</html>
