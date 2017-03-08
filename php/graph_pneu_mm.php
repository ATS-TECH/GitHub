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
      function drawChart() 
      {
           var data = new google.visualization.DataTable();
           //data.addColumn('string', 'mes');
           data.addColumn('string', 'Data das Medidas');
           data.addColumn('number', 'sulco 1');
           data.addColumn('number', 'sulco 2'); 
           data.addColumn('number', 'sulco 3'); 
           data.addColumn('number', 'sulco 4');
           data.addColumn('number', 'Média');
           
           
       <?php
         
        $queryrd = "SELECT sulco,DATE_FORMAT(datamedida,'%d/%m/%Y') datamedida, min(medida) medida"
                . " FROM medida where numero_chip in ('".$chip."') "
                . " and medida >0 "
                . " group by sulco,DATE_FORMAT(datamedida,'%Y/%m/%d')"
                . " order by  DATE_FORMAT(datamedida,'%Y/%m/%d') , sulco" ;
                   // ." and datamedida between '".$datainicio."' and '".$datafinal."'";
          
        $queryrd = mysql_query($queryrd);

        $virg="";
        $conta=0;
        $datamed="";
        $sulco1=0;
        $sulco2=0;
        $sulco3=0;
        $sulco4=0;
//        echo "data.addRows(1);\n";
//        echo "data.setValue(".$conta.",0,'Data ');\n";
//        echo "data.setValue(".$conta.",1,'sulco 1');\n";
//        echo "data.setValue(".$conta.",2,'sulco 2');\n";
//        echo "data.setValue(".$conta.",3,'sulco 3' );\n";
//        echo "data.setValue(".$conta.",4,'sulco 4');\n";
        //echo "data.addRows(1);\n";
        $conta=0;
        $qtdsulco=0;
        $totmede=0;
        $quebradata='';
        $datadone='';
        while($rsad=mysql_fetch_array($queryrd))
        {
            $datamed= $rsad['datamedida'];
            if($quebradata!=$datamed&&$quebradata!='')
            {
                $datadone=$datamed;
                echo "data.addRows(1);\n";
                echo "data.setValue(".$conta.",0,'".$datamed."');\n";
                echo "data.setValue(".$conta.",1,'".$sulco1."');\n";
                echo "data.setValue(".$conta.",2,'".$sulco2."');\n";
                echo "data.setValue(".$conta.",3,'".$sulco3."');\n";
                echo "data.setValue(".$conta.",4,'".$sulco4."');\n";
                $media=$totmede/$qtdsulco;
                echo "data.setValue(".$conta.",5,'".$media."');\n";
                $conta++;
                $totmede=0;
                $qtdsulco=0;
            }
            $quebradata=$datamed;
            if($rsad['medida']>0)
            {
                if($rsad['sulco']==1)
                {
                    $sulco1=$rsad['medida'];
                    $totmede+=$sulco1;
                    $qtdsulco++;
                }
                else 
                {
                   if($rsad['sulco']==2)
                    {
                        $sulco2=$rsad['medida']; 
                        $qtdsulco++;
                        $totmede+=$sulco2;
                    }
                    else
                    {
                        if($rsad['sulco']==3)
                        {
                            $sulco3=$rsad['medida'];
                            $qtdsulco++;
                            $totmede+=$sulco3;
                        }
                        else
                        {
                            if($rsad['sulco']==4)
                            {
                                $sulco4=$rsad['medida'];
                                $qtdsulco++;
                                $totmede+=$sulco4;
                            }
                        }

                    }
                }
               
            }
        }
        if($datadone!==$datamed)
        {
            echo "data.addRows(1);\n";
            echo "data.setValue(".$conta.",0,'".$datamed."');\n";
            echo "data.setValue(".$conta.",1,'".$sulco1."');\n";
            echo "data.setValue(".$conta.",2,'".$sulco2."');\n";
            echo "data.setValue(".$conta.",3,'".$sulco3."');\n";
            echo "data.setValue(".$conta.",4,'".$sulco4."');\n";
            $media=$totmede/$qtdsulco;
            echo "data.setValue(".$conta.",5,'".$media."');\n";
            $conta++;
            $totmede=0;
            $qtdsulco=0;
        }
        echo " var PNEU= '".$chip."';\n"; 
        ?>
        var chart = new google.charts.Line(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 0,
                        decimalSymbol: ",",
                        suffix: " mm",
                        decimalSymbol: ","});
        formatter.format(data, 1);
        formatter.format(data, 2);
        formatter.format(data, 3);
        formatter.format(data, 4);// Apply formatter to second column
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
                    titleFontSize:24},'width': '100%','height':'100%'
        };
        chart.draw(data,options);
                    
    }
window.addEventListener("resize", drawChart);    
 </script>
</head>
<body onplay='drawChart()'>
    <h4 class="text-center">Desgaste do pneu em MM</h4>
<div id="chart_div" class="contchart" ></div>
</body>
</html>