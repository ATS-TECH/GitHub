<?php 
include 'mysql.php';
$chip=$_REQUEST['chip_veiculo'];
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
           data.addColumn('string', 'Item de Manutenção');
           data.addColumn('number', 'Custo');
       <?php
        $queryrs = $queryrs = "SELECT distinct nome_item, count(*) qtd, sum(valor_custo) custo  "
                . " from item_manutencao,veiculo_manutencao "
                ." where item_manutencao.idplano_manutencao=veiculo_manutencao.idplano_manutencao" 
                . ' and item_manutencao.iditem_manutencao=veiculo_manutencao.iditem_manutencao' 
                . ' and item_manutencao.idpessoa='.$_REQUEST['idpessoa']
                . " and chip_veiculo='".$chip."'"
                . ' and item_manutencao.idpessoa=veiculo_manutencao.idpessoa'
                . ' and valor_custo > 0'
                . " group by nome_item";
        $conta=0;
        $salva=$queryrs;
        
        $resultado = mysql_query($queryrs);
        $total=0; 
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "data.addRows(1);\n";
            echo "data.setValue(".$conta.",0,'".$rsan['nome_item']."');\n"; 
            echo "data.setValue(".$conta.",1,".$rsan['custo'].");\n"; 
            $conta++;
            $total+=$rsan['custo'];
        }
        ?>
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 2,
                        decimalSymbol: ",",
                        prefix: "R$ ",
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
<body onplay='drawChart()'>
<h4 class="text-center">Custo de manutenção do veículo:<?php echo "R$ ".number_format($total,2,",","."); ?></h4>

<div id="chart_div" class="contchart"  ></div>
</body>
</html>