google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Kategoria wydatku', 'Suma z wybranego okresu'],
    ['Jedzenie', 400.00],
    ['Mieszkanie', 1450.00],
    ['Transport', 300.00],
    ['Telekomunikacja', 100.00],
    ['Opieka zdrowotna', 150.00],
    ['Ubranie', 150.00],
    ['Higienia', 50.00],
    ['Dzieci', 0],
    ['Rozrywka', 150.00],
    ['Wycieczka', 70.00],
    ['Szkolenia', 1000.00],
    ['Książki', 25.00],
    ['Oszczędności', 100.00],
    ['Na złotą jesień, czyli emeryturę', 100.00],
    ['Spłata długów', 0.00],
    ['Darowizna', 0.00],
    ['Inne wydatki', 150.00]
  ]);

  var options = {
    title: 'Wydatki',
    is3D: true,
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  chart.draw(data, options);
}

$(window).resize(function(){
  drawChart();
});