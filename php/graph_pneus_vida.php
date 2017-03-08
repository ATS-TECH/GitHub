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
           data.addColumn('string', 'Vida');
           data.addColumn('number', 'quantidade');
       <?php
        
        $queryrs = "SELECT vida  from pneu "
                ." where idpessoa in ('".$_REQUEST['idpessoa'] ."')";
        $conta=0;
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        $vidas=array(0,0,0,0,0,0,0,0,0,0);
        while($rsan=mysql_fetch_array($resultado))
        {
            $vida=$rsan["vida"];
            if($vida===""||$vida<1||$vida===null)
            {
                $vida=1;
            }
            $vidas[$vida]+=1;
        }
        for ($vida=1;$vida<11;$vida++)
        {
            if($vidas[$vida]!==null)
            {
                $modelo = $vida." vida";
                echo "data.addRows(1);\n";
                echo "var modelo = '".$vida."';\n";
                echo "var contador = '".$vidas[$vida]."';\n";
                $tabarray = $tabarray." ,['".$vida."',".$vidas[$vida]."]";
                echo "data.setValue(".$conta.",0,modelo);\n";
                echo "data.setValue(".$conta.",1,contador);\n";
                $conta++;
            }
        }
        ?>
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 0,
                        decimalSymbol: ",",
                        suffix: " pneus",
                        decimalSymbol: ","});
        formatter.format(data, 1); // Apply form
        var options = {'title':'', 
            chartArea: {width: '100%',height:'100%'},
            tooltip: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            legend: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            fontSize:10, 
            titleFontSize:18, 
             hAxis: {title: "Pneus", 
                    titleColor:'#cc0000', 
                    titleFontSize:24},
            'width': '100%','height':'100%', allowHtml: true, is3D: true};

        chart.draw(data,options);
    }      
</script>
</head>
<body onplay="drawChart();" >
    <div style="text-align:center">
    <br>
    <h4 class="text-center">Quantidade por pneus por vida</h4>
   
</div>
    <div id="chart_div" class="contchart"  ></div>
</body>
</html>