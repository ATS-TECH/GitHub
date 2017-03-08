<?php 
include 'mysql.php';
$chip=$_REQUEST["numero_chip"];
//$dtini=$_REQUEST["dtini"];
//$dtfim=$_REQUEST["dtfim"];

//$datainicio=  substr($dtini,6,4)."-".substr($dtini,3,2)."-".substr($dtini,0,2);
//$datafinal=  substr($dtfim,6,4)."-".substr($dtfim,3,2)."-".substr($dtfim,0,2);
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
           data.addColumn('string', 'Número de Série');
           data.addColumn('number', 'Média dos sulcos ');
       <?php
        $numserie=array();
        $medidas=array();
        $numero_chip=array();
        $contanumseries=0;
        $ind=1;
        $conta=0;
        $totalcol=0;
        $quebradata='';
        $cmd="select medida.numero_chip, numero_serie, DATE_FORMAT(max(datamedida),'%Y-%m-%d') datamedida "
                . " from pneu, medida "
                . " where numero_chip_veiculo in ('".$chip."')  "
                ." and pneu.numero_chip=medida.numero_chip"
                . " group by numero_chip, numero_serie  ";
         
        $result=mysql_query($cmd);
       
        while($rs=mysql_fetch_array($result))
        {
            $datamedida=$rs["datamedida"];
            $numeroserie=$rs["numero_serie"];
            $numero_chip=$rs["numero_chip"];
            $cmda="select numero_chip, avg(medida.medida) medida "
                    . " from medida "
                    . " where medida.numero_chip in ('".$numero_chip."') "
                    . " and date(datamedida)=date('".$datamedida."') "
                    . " group by numero_chip  ";
            $resulta=mysql_query($cmda);
            $area="";
            $virgula='';
            while($rsa=mysql_fetch_array($resulta))
            {
                echo "data.addRows(1);\n";
                $mostradata=date_format(date_create($datamedida),"d/m/Y");
                echo "data.setValue(".$contanumseries.",0,'".$numeroserie." em ".$mostradata."');\n";
                echo "data.setValue(".$contanumseries.",1,".$rsa["medida"].");\n";
            }
            $contanumseries++;
        }
        echo " var PNEU= '".$chip."';\n"; 
        ?>
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1]);
        
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 2,
                        decimalSymbol: ",",
                        suffix: " mm"});
         
        formatter.format(data, 1); 
        var options = {
        chart: {title: ''},
        chartArea: {width: '80%',height:'80%'},
           
        vAxis: {title: "Médias dos sulcos(mm)", 
                titleFontSize:12},
        hAxis: {title: "Últimas medidas por Marca de Fogo do pneu", 
                titleFontSize:12},'width': '100%','height':'100%',allowHtml: true, is3D: true
        };
        chart.draw(view,options);
    }
 window.addEventListener("resize", drawChart);    
 </script>
</head>
<body onplay='drawChart()'   >
    <h4 class="text-center">Média dos pneus em MM</h4>
<div id="chart_div" class="container"  ></div>
</body>
</html>