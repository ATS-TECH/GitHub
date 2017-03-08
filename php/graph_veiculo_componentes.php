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
    google.load("visualization", "1.1", {packages:['corechart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
           //data.addColumn('string', 'mes');
           data.addColumn('string', 'Nome');
           data.addColumn('number', 'Quantidade');
       <?php
        $queryrs = "SELECT a.idcomponente, count(*) as contr, b.descrcomponente "
                 . "from componente_veiculo as a, componente as b "
                 . "where a.chip_veiculo in ('".$chip."') and b.idcomponente=a.idcomponente "
                 . "group by a.idcomponente";
        $conta=0;
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
         
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "data.addRows(1);\n";
            echo "data.setValue(".$conta.",0,'".$rsan['descrcomponente']."');\n"; 
            echo "data.setValue(".$conta.",1,".$rsan['contr'].");\n"; 
            $conta++;
        }
        ?>
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 0,
                        decimalSymbol: ",",
                        suffix: " ",
                        decimalSymbol: ","});
        formatter.format(data, 1); // Apply form
        var options = {'title':'', 
            chartArea: {width: '100%',height:'100%'},
            tooltip: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            legend: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            fontSize:10, 
            titleFontSize:18, 
             hAxis: {title: "MEDIDAS", 
                    titleColor:'#cc0000', 
                    titleFontSize:24},
            'width': '100%','height':'100%', allowHtml: true, is3D: true};
       
        chart.draw(data,options);
    } 
window.addEventListener("resize", drawChart);    
 </script>
</head>
<body onplay='drawChart()'>
<h4 class="text-center">Quantidade de componentes por carro</h4>
<div id="chart_div" class="contchart"  ></div>
</body>
</html>