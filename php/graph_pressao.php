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
        google.load('visualization', '1.1', {packages: ['line']});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
 
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Data');
        data.addColumn('number', 'Pressão');
        <?php
        
        $queryrs = "SELECT pressao, datapressao "
                . " from pressao where numero_chip='".$chip."' order by datapressao";
        $conta=0;
        
        $queryrs = mysql_query($queryrs);
        while($rsan=mysql_fetch_array($queryrs))
        {
            if($rsan['pressao']>0)
            {
                echo "data.addRows(1);\n";
                $datakm = date_format(date_create($rsan['datapressao']),"d/m/Y H:i");
                echo "data.setValue(".$conta.",0,'".$datakm."');\n";
                echo "data.setValue(".$conta.",1,".$rsan['pressao'].");\n";
                $conta++;
            }
        }
        ?>
        var chart = new google.charts.Line(document.getElementById('chart_div'));
//        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        
         
        var formatter = new google.visualization.NumberFormat(
                        {prefix: ' libras ', negativeColor: 'red', negativeParens: true, groupingSymbol: ".",
                        fractionDigits: 2,
                        decimalSymbol: ","});
        formatter.format(data, 1); // Apply formatter to second column
         
        var options = {
        chart: {
          title: '',
          subtitle: ''
        },chartArea: {width: '100%',height:'100%'},
            tooltip: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            legend: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            fontSize:10, 
            titleFontSize:18, 
             hAxis: {title: "MEDIDAS", 
                    titleColor:'#cc0000', 
                    titleFontSize:24},'width': '80%','height':'80%'
        };

        chart.draw(data,options);
   }      
window.addEventListener("resize", drawChart);    
 </script>
</head>
<body onplay='drawChart()'>
    <h4 class="text-center">Pressão do PNEU em Libras</h4>
<div id="chart_div" class="contchart" ></div>
</body>
</html>