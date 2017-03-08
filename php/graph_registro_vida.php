<?php 
include 'mysql.php';
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
            data.addColumn('string', 'Data Registro');
            data.addColumn('number', 'Quantidade de pneus');
            data.addColumn( 'string', 'color');
            data.addColumn( 'string', 'annotation'); 
       <?php
       $vidas = array();
//        for ($ixmedia=0;$ixmedia<30;$ixmedia++) {
//           for($ixvida=0;$ixvida<7;$ixvida++)
//           {
//               $vidas[$ixmedia][$ixvida]="";
//           }
//        };
        $cmd = 'select distinct month(data_registro) mes, year(data_registro) ano, vida, count(*)qtd, '
                . 'sum(valor_unitario) valor '
                . ' from componente_almox,pneu '
                . ' where pneu.idpessoa=componente_almox.idpessoa'
                . ' and pneu.numero_chip=componente_almox.numero_chip'
                . ' and pneu.idpessoa in('.$_REQUEST["idpessoa"].")"
                . " group by year(data_registro),month(data_registro), vida"
                . " order by year(data_registro),month(data_registro), vida";
        
        $result=  mysql_query($cmd);
        echo mysql_error();
        
        $conta=0;
        while($rs=mysql_fetch_array($result))
        {
            echo "data.addRows(1);\n";
                $datakm = $rs["mes"]."/".$rs["ano"];
                switch($rs["vida"])
                {
                    case 0:
                    {
                        $color="black";
                        break;
                    }
                    case 1:
                    {
                        $color="gold";
                        break;
                    }
                    case 2:
                    {
                        $color="silver";
                        break;
                    }
                    case 3:
                    {
                        $color="green";
                        break;
                    }
                    case 4:
                    {
                        $color="red";
                        break;
                    }
                    case 5:
                    {
                        $color="brown";
                        break;
                    }
                    case 6:
                    {
                        $color="gray";
                        break;
                    }
                }
                echo "data.setValue(".$conta.",0,'".$datakm."');\n";
                echo "data.setValue(".$conta.",1,".$rs['qtd'].");\n";
                echo "data.setValue(".$conta.",2,'color:".$color."');\n";
                echo "data.setValue(".$conta.",3,"."'".$rs['vida']."');\n";
                $conta++;
        }   
        
        ?>
        
        var view = new google.visualization.DataView(data);
        
        view.setColumns([0, 1,
                        { calc: "stringify",
                         sourceColumn: 2,
                         type: "string",
                         role: "style" },
                        { calc: "stringify",
                         sourceColumn: 3,
                         type: "string",
                         role: "annotation" }]);
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 0,
                        decimalSymbol: ",",
                        suffix: " pneus"});
        
        formatter.format(data, 1);
                
        var options = {
        chart: {title: ''},
        chartArea: {width: '100%',height:'100%'},
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: false,   
        vAxis: {title: "Quantidade de´pneus", 
                titleFontSize:12},
        hAxis: {title: "Data de registro", 
                titleFontSize:12},'width': '100%','height':'100%',allowHtml: true, is3D: true
        };
        chart.draw(view,options);
        function selectHandler() {
            var selectedItem = chart.getSelection()[0];
            if (selectedItem) {
                var irow=selectedItem.row;
                if(selectedItem.row!=null)
                {
//                    var datareg = data.getValue(irow, 0).split("/");
//                    var mes=datareg[0];
                    var ano=data.getValue(irow, 0);
                    var params=ano.split('/');
                    var vida = data.getValue(irow, 3);
                    window.parent.injeta("php/resumo_inventario_pneus.php?idpessoa="+<?php echo $_REQUEST['idpessoa'];?>
                          +"&vida="+vida+"&ano="+params[1]+"&mes="+params[0]
                          ,'contgeral','page-wrapper','slide','contgeral');
                }
            }
        }
        google.visualization.events.addListener(chart, 'select', selectHandler);
    }
    
 window.addEventListener("resize", drawChart);    
 </script>
</head>
<body onplay='drawChart()'   >
    <div id="execmanu"></div>
    <h4 class="text-center">Quantidade de pneus registrada por data</h4>
<div id="chart_div" class="container-fluid"  ></div>
</body>
</html>