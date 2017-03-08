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
        data.addColumn('number', 'Valores');
        <?php
        
        $queryrs = "SELECT b.idcomponente, sum(valor_unitario) as valor, b.descrcomponente "
                 . "from componente as b, componente_almox c "
                 . "where b.idcomponente= c.idcomponente"
                 . " and b.idpessoa = c.idpessoa "
                 . " and c.data_baixa is null"
                 . " and c.data_montagem is null"
                 . " and b.idpessoa =".$_REQUEST["idpessoa"]
                 . " group by b.idcomponente";
        $conta=0;
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        $valortotal=0;
        while($rsan=mysql_fetch_array($resultado))
        {
            
                $valortotal+=$rsan["valor"];
                $modelo = $rsan["descrcomponente"];
                echo "data.addRows(1);\n";
                echo "var modelo = '".$modelo."';\n";
                echo "var valor = '".$rsan["valor"]."';\n";
                $tabarray = $tabarray." ,['".$modelo."',".$rsan['valor']."]";
                echo "data.setValue(".$conta.",0,modelo);\n"; 
                echo "data.setValue(".$conta.",1,valor);\n";
                $conta++;
        }
        ?>
                        
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 2,
                        decimalSymbol: ",",
                        preffix: "R$ ",
                        decimalSymbol: ","});
        formatter.format(data, 1); // Apply form
        var options = {'title':'', 
            chartArea: {width: '100%',height:'100%'},
            tooltip: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            legend: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            fontSize:10, 
            titleFontSize:18, 
             hAxis: {title: "", 
                    titleColor:'#cc0000', 
                    titleFontSize:24},
            'width': '100%','height':'100%', allowHtml: true, is3D: true};

        chart.draw(data,options);
    }
 window.addEventListener("resize", drawChart);    
 </script>
</head>
<body onplay="drawChart();">
    <h4 class="text-center">Famílias de componentes: <?php echo "R$ ".number_format($valortotal,2,",",".");?> </h4>
<div id="chart_div" class="contchart" ></div>
</body>
</html>