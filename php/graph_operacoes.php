<?php 
include 'mysql.php';
?>
<html>
  <head>
      <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
      <link href="../css/css_resumo.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["calendar"]});
      google.charts.setOnLoadCallback(drawChart);
    
   function drawChart() {
       var dataTable = new google.visualization.DataTable();
       dataTable.addColumn({ type: 'date', id: 'Data' });
       dataTable.addColumn({ type: 'number', id: 'Instalações' });
       
       
       <?php
        
        $queryrs = "SELECT distinct data_instalacao, count(*) qtd "
                . " FROM  componente_historico  "
                . ' where idpessoa='.$_REQUEST['idpessoa'] 
                . " and data_instalacao is not null"
                   ." group by data_instalacao";
        $conta=0;
//        echo $queryrs;
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        $total=  mysql_num_rows($resultado);
         
        while($rsan=mysql_fetch_array($resultado))
        {
            $mesant=date_format(date_create($rsan['data_instalacao']),"m")-1;
            echo "dataTable.addRows(1);\n";
            echo "dataTable.setValue(".$conta.",0,new Date(".date_format(date_create($rsan['data_instalacao']),"Y")
                    .",".$mesant
                    .",".date_format(date_create($rsan['data_instalacao']),"d")
                    ."));\n"; 
            echo "dataTable.setValue(".$conta.",1,".$rsan['qtd'].");\n"; 
           
            $conta++;
        }
        
                $queryrs = "SELECT distinct data_desmonte data_instalacao, count(*) qtd "
                . " FROM  componente_historico  "
                . ' where idpessoa='.$_REQUEST['idpessoa'] 
                . " and data_desmonte is not null"
                   ." group by data_desmonte";
        
//        echo $queryrs;
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        $total=  mysql_num_rows($resultado);
         
        while($rsan=mysql_fetch_array($resultado))
        {
            $mesant=date_format(date_create($rsan['data_instalacao']),"m")-1;
            echo "dataTable.addRows(1);\n";
            echo "dataTable.setValue(".$conta.",0,new Date(".date_format(date_create($rsan['data_instalacao']),"Y")
                    .",".$mesant
                    .",".date_format(date_create($rsan['data_instalacao']),"d")
                    ."));\n"; 
            echo "dataTable.setValue(".$conta.",1,".$rsan['qtd'].");\n"; 
           
            $conta++;
        }
        ?>
        var chart = new google.visualization.Calendar(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 0,
                        decimalSymbol: ","});
        formatter.format(dataTable, 1); // Apply form
        var options = {'title':'', 
            calendar: { cellSize: 15 },
            height: '100px',
            width: '100%',
            cellColor: {
            stroke: '#76a7fa',
            strokeOpacity: 0.5,
            strokeWidth: 1},
            noDataPattern: {
            backgroundColor: '#76a7fa',
            color: '#a0c3ff'},
            chartArea: {width: '100%',height:'100%'},
            tooltip: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            legend: {textStyle:  {fontName: 'Helvetica',fontSize: 9,bold: true}},
            fontSize:10, 
            titleFontSize:18, 
             hAxis: {title: "", 
                    titleColor:'#cc0000', 
                    titleFontSize:24},
            'width': '100%','height':'100%', allowHtml: true, is3D: true};
        function selectHandler() {
            var selectedItem = chart.getSelection()[0];
            if (selectedItem) {
                var irow=selectedItem.row;
                if(selectedItem.row!=null)
                {
                    var value = new Date(dataTable.getValue(irow, 0));
                    var dia = value.getDate();
                    var mes = value.getMonth() + 1;
                    window.parent.injeta("php/resumo_operacoes.php?idpessoa="+<?php echo $_REQUEST['idpessoa'];?>
                          +"&dataoperacao="+value.getFullYear()
                                  +'-'+mes+'-'+dia
                          ,'page-wrapper','chartmov','slide','page-wrapper');
                }
            }
        }
        google.visualization.events.addListener(chart, 'select', selectHandler);
        chart.draw(dataTable,options);
    } 
    

window.addEventListener("resize", drawChart); 

 </script>
</head>
<body onplay='drawChart()' >
    <div class="container-fluid bg-3"><h4 class="">Movimentação de pneus</h4>

<div id="chart_div" class="contchart"  ></div>
<div id="execmanu"></div>
</div>
</body>
</html>