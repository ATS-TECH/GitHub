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
           
           
       <?php
       $vidas = array();
//        for ($ixmedia=0;$ixmedia<30;$ixmedia++) {
//           for($ixvida=0;$ixvida<7;$ixvida++)
//           {
//               $vidas[$ixmedia][$ixvida]="";
//           }
//        };
        $cmd = 'select * from pneu where idpessoa in('.$_REQUEST["idpessoa"].")";
        
        $result=  mysql_query($cmd);
        echo mysql_error();
        $totalpneus=  mysql_num_rows($result);
        while($rs=mysql_fetch_array($result))
        {
            $chip_veiculo=$rs["numero_chip_veiculo"];
            $numero_chip=$rs["numero_chip"];
            $vida=$rs["vida"];
            $media=0;
            $queryrs = "select distinct round(avg(a.medida)) media_sulcos "
            . " from medida a"
            . " where a.idpessoa=".$_REQUEST["idpessoa"]
                . " and a.numero_chip in ('".$numero_chip."')"
                . " and (a.medida >0 and a.medida < 25)"
                . " and date(datamedida) = "
                . "   (select max(date(datamedida)) from medida c "
                . "     where a.idpessoa=c.idpessoa"
                
                . "       and a.numero_chip=c.numero_chip) ";
            $resultado = mysql_query($queryrs);
            echo mysql_error();
            
            while($rsan=mysql_fetch_array($resultado))
            {
                $media=$rsan["media_sulcos"];
            }
            if($vida===0)
            {
                $vida=1;
            }
            $qtd=$vidas[$media][$vida];
            if($qtd==="")
            {
                $qtd=0;
            }
            $qtd++;
            $vidas[$media][$vida]=$qtd;
            $vidas[$media][0]=$vidas[$media][0] + 1;
            
        }   
        $contalinha=0;
        echo "var data = google.visualization.arrayToDataTable(["
            ."['Média', 'Vida 1', 'Vida 2', 'Vida 3', 'Vida 4',"
               . "'Vida 5', 'Vida 6', 'Vida 7' ]";
        $next=",";
        for ($ixmedia=0;$ixmedia<30;$ixmedia++) {
            if($vidas[$ixmedia]!==null)
            {
                echo $next.'['.$ixmedia;
                for($ixvida=0;$ixvida<7;$ixvida++)
                {
                    if($vidas[$ixmedia][$ixvida]!==null)
                    {
                        echo ",".$vidas[$ixmedia][$ixvida];
                    }
                    else
                    {
                        echo ",0";
                    }
                }
                echo "]";
                $next=",";
            }
        }
        echo ']);';
        ?>
        
        var view = new google.visualization.DataView(data);
        
        
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        var formatter = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 0,
                        decimalSymbol: ",",
                        suffix: " pneus"});
        var formatter2 = new google.visualization.NumberFormat(
                        {groupingSymbol: ".",
                        fractionDigits: 0,
                        decimalSymbol: ",",
                        suffix: " mm"}); 
        formatter.format(data, 1);
        formatter.format(data, 2);
        formatter.format(data, 3);
        formatter.format(data, 4);
        formatter.format(data, 5);
        formatter.format(data, 6);
        formatter.format(data, 7);
        formatter2.format(data, 0);
        var options = {
        chart: {title: ''},
        chartArea: {width: '100%',height:'100%'},
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        isStacked: true,   
        vAxis: {title: "Quantidade de´pneus", 
                titleFontSize:12},
        hAxis: {title: "Média de MM dos sulcos", 
                titleFontSize:12},'width': '100%','height':'100%',allowHtml: true, is3D: true
        };
        chart.draw(view,options);
    }
 window.addEventListener("resize", drawChart);    
 </script>
</head>
<body onplay='drawChart()'   >
    <h4 class="text-center">Quantidade de pneus X Média dos sulcos em MM - Total de pneus <?php echo number_format($totalpneus,0,"",".");?></h4>
<div id="chart_div" class="container-fluid"  ></div>
</body>
</html>