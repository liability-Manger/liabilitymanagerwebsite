
  // Sample JSON data
  var jsonData = [
    { label: 'Category A', value: 20 },
    { label: 'Category B', value: 40 },
    { label: 'Category C', value: 30 },
  ];

  // Get the canvas element
  var ctx = document.getElementById('myChart').getContext('2d');

  // Create a chart
  var myChart = new Chart(ctx, {
    type: 'bar', // Change the chart type as needed (bar, line, pie, etc.)
    data: {
      labels: jsonData.map(item => item.label),
      datasets: [{
        label: 'Chart Title',
        data: jsonData.map(item => item.value),
        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Adjust colors as needed
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false, // Set to true if you want to maintain aspect ratio
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
