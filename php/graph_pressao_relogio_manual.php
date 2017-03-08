<?php 
include 'mysql.php';
$chip=$_REQUEST['numero_chip'];
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load('visualization', '1', {packages: ['gauge']});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
 
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Pressão', 99]
        ]);
        
        var options = {
          'width': '100%','height':'100%',
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
        chart.draw(data, options);

        setInterval(function() {
          var kapa = <?php echo $rsan['pressao']?>;
          data.setValue(0, 1, kapa);
          chart.draw(data, options);
          }, 3000);
   }      
 window.addEventListener("resize", drawChart);    
 </script>
</head>
<body onplay='drawChart()'>
    <div class="container">
        <h4 class="text-center">Medição manual da pressão em libras</h4>
        <input type="number" id="medida" class="input-sm"/>
        <button type="button" class="btn btn-primary" onclick="parent.pressaomanual();" >Registra Pressão</button>
    </div>

<div id="chart_div" class="contchart" > </div>

</body>
</html>