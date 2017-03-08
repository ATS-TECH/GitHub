<?php 
include 'mysql.php';
$chip=$_REQUEST["numero_chip"];
$idpessoa=$_REQUEST["idpessoa"];

?>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load('visualization', '1', {packages: ['corechart']});
        google.setOnLoadCallback(drawChart);
        
      function drawChart() 
      {
           var data = new google.visualization.DataTable();
        data.addColumn('string', 'Mes');
        data.addColumn('number', 'KM');
        <?php
        $queryrs = "SELECT distinct km, year(datakm) ano, month(datakm) mes, "
        . "day(datakm) dia from seriekm where chip_veiculo"
        . " in ('".$chip."') group by datakm, km order by datakm";
        $conta=0;
         
        
        $queryrs = mysql_query($queryrs);
        while($rsan=mysql_fetch_array($queryrs))
        {
            if($rsan['km']>0)
            {
                echo "data.addRows(1);\n";
                $datakm = $rsan['dia']."/".$rsan['mes']."/".$rsan['ano'];
                echo "data.setValue(".$conta.",0,'".$datakm."');\n";
                echo "data.setValue(".$conta.",1,".$rsan['km'].");\n";
                $conta++;
            }
        }
        ?>
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1]);
        
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 0,
                        decimalSymbol: ",",
                        suffix: " KM"});
        
        formatter.format(data, 1);  
        var options = {
        chart: {title: 'KM do veículo'
        },chartArea: {width: '80%',height:'60%'},
           
        vAxis: {title: "Kilometragem", 
                titleFontSize:18},
        hAxis: {title: "Datas informadas", 
                titleFontSize:18},'width': '100%','height':'60%',allowHtml: true, is3D: true
        };
        chart.draw(view,options);
    }
    window.addEventListener("resize", drawChart);    
        
 
</script>
</head>
<body onpageshow="drawChart();">
    <h4 class="text-center">KM do veículo X Tempo</h4>
<div id="chart_div" class="contchart" ></div>
</body>
</html>