<?php 
include 'mysql.php';
$chip=$_REQUEST["numero_chip"];
$idpessoa=$_REQUEST["idpessoa"];
//$dtini=$_REQUEST["dtini"];
//$dtfim=$_REQUEST["dtfim"];

//$datainicio=  substr($dtini,6,4)."-".substr($dtini,3,2)."-".substr($dtini,0,2);
//$datafinal=  substr($dtfim,6,4)."-".substr($dtfim,3,2)."-".substr($dtfim,0,2);
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  </head>
 <body >
    <label class="text-info pull-right" style="margin:1rem;margin-right: 20px;"><i class="fa fa-arrow-circle-down" onclick="limpadiv('page-wrapper');" >Fechar</i></label>
     <div class='table-responsive'>
        <h2 >Resumo Geral das medições de sulcos</h4> 
        <?php
         echo "<table class=table id=falhas width=100% name=eixos >";
            echo "<tr> <th >DATA</th>"
                    . "<th >SULCO 01</th>"
                    . "<th >SULCO 02</th>"
                    . "<th >SULCO 03</th>"
                    . "<th >SULCO 04</th>"
                    . "<th >MËDIA</th>"
                    . "</tr>";  
         
        $queryrd = "SELECT sulco,year(datamedida) ano, month(datamedida) mes, "
                . "day(datamedida) dia, hour(datamedida) hora, minute(datamedida) minuto, medida "
                . " FROM medida where numero_chip in ('".$chip."') "
                . " and medida.idpessoa=".$idpessoa
                . " order by datamedida, sulco" ;
                   // ." and datamedida between '".$datainicio."' and '".$datafinal."'";
         
        $queryrd = mysql_query($queryrd);

        $virg="";
        $conta=0;
        $datamed="";
        $sulco1=0;
        $sulco2=0;
        $sulco3=0;
        $sulco4=0;

        $conta=0;
        $datamed="";
        $dataant="";
        while($rsad=mysql_fetch_array($queryrd))
        {
                $datamed= $rsad['dia']."/".$rsad['mes']."/".$rsad['ano']." ".$rsad['hora'].":".$rsad['minuto'];
                $conta++;
                if($rsad['sulco']==1)
                {
                    $sulco1=$rsad['medida']; 
                }
                else 
                {
                   if($rsad['sulco']==2)
                    {
                    $sulco2=$rsad['medida']; 
                    }
                    else
                    {
                        if($rsad['sulco']==3)
                        {
                            $sulco3=$rsad['medida']; 
                        }
                        else
                        {
                            if($rsad['sulco']==4)
                            {
                                $sulco4=$rsad['medida']; 
                            }
                        }
                     
                    }
                }
                if($dataant!=$datamed&&$dataant!="")
                {
                     echo "<tr>";
                     $media=($sulco1 + $sulco2 + $sulco3 + $sulco4)/4;
                    echo '<td  >'.$datamed.'</td>';
                    echo '<td  >'.$sulco1.'</td>';
                    echo '<td  >'.$sulco2.'</td>';
                    echo '<td  >'.$sulco3.'</td>';
                    echo '<td  >'.$sulco4.'</td>';
                    echo '<td  >'.$media.'</td>';
                    echo "</tr>";
                    $conta=0;
                }
//            }
                $dataant=$datamed;
//            
        }
        if($conta>0)
            {
                 echo "<tr>";
                 $media=($sulco1 + $sulco2 + $sulco3 + $sulco4)/4;
                echo '<td  >'.$datamed.'</td>';
                echo '<td  >'.$sulco1.'</td>';
                echo '<td  >'.$sulco2.'</td>';
                echo '<td  >'.$sulco3.'</td>';
                echo '<td  >'.$sulco4.'</td>';
                echo '<td  >'.$media.'</td>';
                echo "</tr>";
                $conta=0;
            }
        ?>
    </div>   
</body>
</html>