<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home</title>
    <link rel="stylesheet" href="../../css/home.css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        var button = document.getElementById('change-chart');
        var chartDiv = document.getElementById('chart_div');

        var data = google.visualization.arrayToDataTable([
          ['month', 'expense', 'income'],
          ['jan 2023', 300, 600],
          ['feb 2023', 700, 1300],
          ['March  2023', 3000, 4200],
          ['April 2023', 500, 700],
          ['May 2023', 600, 450]
        ]);

        var materialOptions = {
          width: 900,
          chart: {
            title: 'Income and Expenses',
            subtitle: ''
          },
          series: {
            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            y: {
              distance: {label: ''}, // Left y-axis.
              brightness: {side: 'right', label: ''} // Right y-axis.
            }
          }
        };

        var classicOptions = {
          width: 900,
          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1}
          },
          title: 'Income and Expenses ',
          vAxes: {
            // Adds titles to each axis.
            0: {title: ''},
            1: {title: ''}
          }
        };

        function drawMaterialChart() {
          var materialChart = new google.charts.Bar(chartDiv);
          materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
          button.innerText = 'Change to Classic';
          button.onclick = drawClassicChart;
        }

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicChart.draw(data, classicOptions);
          button.innerText = 'Change to Material';
          button.onclick = drawMaterialChart;
        }

        drawMaterialChart();
    };
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2021',  1000,      400],
          ['2022',  1170,      460],
          ['2023',  2000,       1120],
          ['2024',  1030,      540]
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
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Expensis', 'Expensis'],
          ['Hosting',   100],
          ['electricity',     200 ],
          ['Manufacurer', 400 ],
          ['delivery cost', 100],
          ['network', 30   ]
        ]);

        var options = {
          title: 'Expensis'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <style>
      #chart_div{
        width: 200px;
      }
    </style>
  </head>
  <body>
    <header>
      <h2>Dashboard</h2>
    </header>
    <div class="total-boxes" >
      <div class="box receivables">
        <h2 class="proghead">Total Receivables</h2>
        <div class="progress-bar" >
          <div class="progress-completed"></div>
          <div class="progress-incomplete"></div>
        </div>
        <dev class="money">
            <p>LEP 0.00</p>
            <p class="no">LBP 0.00</p>
        </dev>
      </div>
      <div class="box payables">
        <h2 class="proghead">Total Payables</h2>
        <div class="progress-bar">
          <div class="progress-completed"></div>
          <div class="progress-incomplete"></div>
        </div>
        <dev class="money">
          <p>LEP 0.00</p>
          <p class="no">LBP0.00</p>
        </dev>
      </div>
    </div>
    

    <div id="curve_chart" style="width: 950px; height: 300px; border: 0.2cm solid whitesmoke; border-radius: 20px; "></div>

      <div class="Fchart" style="width: 450px; margin-top: 30px;">
        <button id="change-chart">Change to Classic</button>
        <br>
        <div id="chart_div" style="width: 20%; height: 500px;"></div>
      </div>
      <div class="Schart">
        <div id="piechart" style="width: 500px; height: 500px;"></div>
      </div>




    <script src="../../js/home.js"></script>
    <script src="data.json"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <canvas id="myChart"></canvas>
 
  </body>
</html>
