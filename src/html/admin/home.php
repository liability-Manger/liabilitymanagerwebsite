<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home</title>
    <link rel="stylesheet" href="../../css/home.css" />
    <style>
      
      .total-boxes {
          display: flex;
          justify-content: space-between;
          margin: 20px 0;
        }
        
        .box {
          background-color: #fff;
          padding: 20px;
          border-radius: 5px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
          width: 50%;
        }
        
        .receivables {
          border-right: 1px solid #ddd;
        }
        
        h2 {
          margin-bottom: 10px;
        }
        
        p {
          margin-bottom: 0;
        }
      
        .box.payables {
          margin-left: 10px;
        }
      
        .progress-bar {
          width: 100%;
          height: 20px; /* Adjust height as needed */
          background-color: orange; /* Set default color for incomplete portion */
          position: relative;
          border-radius: 20px;
        }
        
        .progress-completed {
          height: 100%;
          background-color: blue; /* Set color for completed portion */
          width: 40%;
          border-radius: 20px;
        }
        
        .progress-incomplete {
          position: absolute;
          top: 0;
          left: 0;
          height: 100%;
          width: 60%; /* Adjust width dynamically based on completion percentage */
        }
      
        .money {
          display: flex;
          flex-direction: row;
        }
      
        .no {
          margin-left: 200px;
        }
      
        #chart_div{
          width: 200px;
        }
      
        body, html {
          margin: 0;
          padding: 0;
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

      }
      
        .dashboard {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        
        .dashboard-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .dashboard-card {
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex-basis: calc(33.333% - 20px);
            color: #FBFBFB;
        }
        
        .dashboard-card h2, .dashboard-card h3 {
            margin: 0;
            padding: 0;
            color: #777;
        }
        
        .dashboard-value {
            font-size: 2.5em;
            margin: 10px 0;
            color: black;
        }
        
        .dashboard-change {
            font-size: 0.9em;
            margin: 0;
        }
        
        .negative {
            color: #e74c3c;
        }
        
        .positive {
            color: #2ecc71;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2021',  100,      100],
          ['2022',  100,      100],
          ['2023',  100,      100],
          ['2024',  1450,     450]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script> 
    <style>
      #chart_div{
        width: 200px;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
  </head>
  <body>
    <header>
      <h2>Dashboard</h2>
    </header>
    <div class="dashboard">
        <div class="dashboard-row" style=" margin-bottom: 20px;">
            <div class="dashboard-card" id="income">
                <h2>This Month (<?php echo date('M j', strtotime('first day of this month')); ?> - <?php echo date('M j', strtotime('last day of this month')); ?>)</h2>
                <h3>Income</h3>
                <?php
                // Include your database connection file
                include 'db_connection.php';

                // Retrieve and display income
                $income_query = "SELECT SUM(amount) AS total_income FROM income_table WHERE MONTH(date) = MONTH(CURRENT_DATE())";
                $income_result = $conn->query($income_query);
                if ($income_result->num_rows > 0) {
                    $row = $income_result->fetch_assoc();
                    $total_income = $row['total_income'];
                    echo "<p class='dashboard-value'>$" . number_format($total_income, 2) . "</p>";
                    // You can calculate and output the change percentage here
                } else {
                    echo "<p class='dashboard-value'>$0.00</p>";
                }
                ?>
            </div>
            <div class="dashboard-card" id="net-income">
                <h2>Year to Date (Jan 1 - <?php echo date('M j'); ?>)</h2>
                <h3>Net Income</h3>
                <?php
                // Retrieve and display net income
                $net_income_query = "SELECT SUM(amount) AS net_income FROM income_table WHERE YEAR(date) = YEAR(CURRENT_DATE())";
                $net_income_result = $conn->query($net_income_query);
                if ($net_income_result->num_rows > 0) {
                    $row = $net_income_result->fetch_assoc();
                    $net_income = $row['net_income'];
                    echo "<p class='dashboard-value'>$" . number_format($net_income, 2) . "</p>";
                    // You can calculate and output the change percentage here
                } else {
                    echo "<p class='dashboard-value'>$0.00</p>";
                }
                ?>
            </div>
            <div class="dashboard-card" id="expenses">
                <h2>This Month (<?php echo date('M j', strtotime('first day of this month')); ?> - <?php echo date('M j', strtotime('last day of this month')); ?>)</h2>
                <h3>Expenses</h3>
                <?php
                // Retrieve and display expenses
                $expenses_query = "SELECT SUM(amount) AS total_expenses FROM expenses_table WHERE MONTH(date) = MONTH(CURRENT_DATE())";
                $expenses_result = $conn->query($expenses_query);
                if ($expenses_result->num_rows > 0) {
                    $row = $expenses_result->fetch_assoc();
                    $total_expenses = $row['total_expenses'];
                    echo "<p class='dashboard-value'>$" . number_format($total_expenses, 2) . "</p>";
                    // You can calculate and output the change percentage here
                } else {
                    echo "<p class='dashboard-value'>$0.00</p>";
                }
                ?>
            </div>
        </div>
        <!-- Add more rows and cards as needed -->
    </div>
    

    <div id="curve_chart" style="width: 950px; height: 200px; border: 0.2cm solid whitesmoke; border-radius: 20px; "></div>


        
      </div>
      <br>
      <br>

      <div class="pie">
      <canvas id="expensesChart" width="400" height="400"></canvas>

    <script>
      
    <?php
    // Fetch data from the expenses table to create the pie graph
    include 'db_connection.php';
    
    $sql = "SELECT category, SUM(amount) AS total_amount FROM expenses GROUP BY category";
    $result = $conn->query($sql);
    
    $categories = [];
    $amounts = [];
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $categories[] = $row["category"];
            $amounts[] = $row["total_amount"];
        }
    }
    ?>
    
    var ctx = document.getElementById('expensesChart').getContext('2d');
    var expensesChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($categories); ?>,
            datasets: [{
                label: 'Expenses',
                data: <?php echo json_encode($amounts); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false
        }
    });
    </script>
      </div>
      




    <script src="../../js/home.js"></script>
    <script src="data.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <canvas id="myChart"></canvas>
 
  </body>
</html>
