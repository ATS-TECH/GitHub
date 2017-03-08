<?php 
include 'mysql.php';
$chip=$_REQUEST['numero_chip'];
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css.css" rel="stylesheet" type="text/css">
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
          'width': '100%','height':'80%',
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
//        var data = new google.visualization.DataTable();
//        data.addColumn('string', 'Label');
//        data.addColumn('number', 'Value');
        <?php
        
        $queryrs = "SELECT pressao, year(datapressao) ano, month(datapressao) mes, day(datapressao) dia "
                . " from pressao where numero_chip='".$chip."' order by datapressao";
        $conta=0;
        
        $queryrs = mysql_query($queryrs);
        $rsan=mysql_fetch_array($queryrs);
//        while($rsan=mysql_fetch_array($queryrs))
//        {
//            if($rsan['pressao']>0)
//            {
//                $conta=$rsan['pressao'];
//              
//            }
//        }
        ?>
        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
//        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        
         
//        var formatter = new google.visualization.NumberFormat(
//                        {prefix: ' libras ', negativeColor: 'red', negativeParens: true, groupingSymbol: ".",
//                        fractionDigits: 2,
//                        decimalSymbol: ","});
//        formatter.format(data, 1); // Apply formatter to second column
         
        

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
<button type="button" class="btn-primary" onclick="lermedidasulco(0)" >Medir Pressão</button>
<div id="chart_div" class="contchart" > </div>

</body>
</html>