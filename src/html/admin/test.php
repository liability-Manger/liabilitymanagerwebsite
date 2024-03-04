<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Example</title>
    <link rel="stylesheet" href="styles.css">
    <style>

        body, html {

            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: whight ;
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
            background: #2C2C2C;
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
            color: #FBFBFB;
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
</head>
<body style="">
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
    
    <div class="graph2">
        <select id="monthSelect">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">Augest</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <canvas id="incomeExpensesChart"></canvas>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('incomeExpensesChart').getContext('2d');
                var incomeExpensesChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [],
                        datasets: [{
                            label: 'Income',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            data: []
                        }, {
                            label: 'Expenses',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            data: []
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value;
                                    }
                                }
                            },
                            x: {
                                ticks: {
                                    callback: function(value, index, values) {
                                        return 'Day ' + value;
                                    }
                                }
                            }
                        }
                    }
                });
            
                function updateChartData(month) {
                    fetch('fetch_data.php?month=' + month)
                        .then(response => response.json())
                        .then(data => {
                            incomeExpensesChart.data.labels = data.dates;
                            incomeExpensesChart.data.datasets[0].data = data.incomeData;
                            incomeExpensesChart.data.datasets[1].data = data.expensesData;
                            incomeExpensesChart.update();
                        });
                }
            
                document.getElementById('monthSelect').addEventListener('change', function() {
                    updateChartData(this.value);
                });
            
                var currentMonth = new Date().getMonth() + 1;
                document.getElementById('monthSelect').value = currentMonth;
                updateChartData(currentMonth);
            });
        </script>

    </div>
    
</body>
</html>





