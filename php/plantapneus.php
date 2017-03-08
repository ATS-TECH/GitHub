

<div class="container-fluid" id="areamonta"></div>
<div class="table-condensed">
    <center>
<table class="table-condensed"   >
<h4 class="text-center">Planta de pneus</h4>
   <?php
    include 'mysql.php';
    $chip = $_REQUEST["numero_chip"];
    $cmda="select * from eixo_veiculo where chip_veiculo in ('".$chip."') and ideixo_veiculo > 0";
            
    $result= mysql_query($cmda);
    $eixoant="";
            
    while($rsa=  mysql_fetch_array($result))
    {
        $eixo=$rsa["ideixo_veiculo"];
        echo '<tr><td>';        
        $ideixo=$rsa["ideixos"];
        $qtdrodas=$rsa["qtdrodas"];
        $foieixo="pull-left";
        $posicao= $eixo;
        switch ($ideixo)
        {
            case 1:
                $posicao.="D";

                break;
            case 2:
                $posicao.="T";

                break;
            case 3:
                $posicao.="L";
                break;
            case 4:
                $posicao.="R";
                break;
        }

        if($qtdrodas==2)
        {
            $cmd="SELECT numero_chip,"
                . "marca, medida, modelo, banda, vida, numero_serie, eixo, roda "
                . " FROM pneu where numero_chip_veiculo='".$chip."' and roda>0 and "
                . " eixo=".$eixo." and roda=1";
            $resultb=  mysql_query($cmd);
            $numero_serie="";
            $mostrapos=$posicao."E";
             while ($row = mysql_fetch_array($resultb)) 
            {
                $numero_serie=$row["numero_serie"];
                montapneu($eixo,1,1,$numero_serie,$row["numero_chip"],$mostrapos);
                $existe=true;
            }
            if($numero_serie==="")
            {
                montapneu($eixo,1,1,"","",$mostrapos);
            }
            montaeixo($ideixo);
            $cmd="SELECT numero_chip,"
                . "marca, medida, modelo, banda, vida, numero_serie, eixo, roda "
                . " FROM pneu where numero_chip_veiculo='".$chip."' and roda>0 and "
                . " eixo=".$eixo." and roda=2";
            $resultb=  mysql_query($cmd);
            $numero_serie="";
            $mostrapos=$posicao."D";
             while ($row = mysql_fetch_array($resultb)) 
            {
                $numero_serie=$row["numero_serie"];
                montapneu($eixo,2,2,$row["numero_serie"],$row["numero_chip"],$mostrapos);
                $existe=true;
            }
            if($numero_serie==="")
            {
                 montapneu($eixo,2,2,"","",$mostrapos);
                $existe=true;
            }
        }
        else 
        {
            $cmd="SELECT numero_chip,"
                . "marca, medida, modelo, banda, vida, numero_serie, eixo, roda "
                . " FROM pneu where numero_chip_veiculo='".$chip."' and roda>0 and "
                . " eixo=".$eixo." and roda=1";
            $resultb=  mysql_query($cmd);
            $numero_serie="";
            $mostrapos=$posicao."EE";
             while ($row = mysql_fetch_array($resultb)) 
            {
                $numero_serie=$row["numero_serie"];
                montapneu($eixo,1,1,$row["numero_serie"],$row["numero_chip"],$mostrapos);
                $existe=true;
            }
            if($numero_serie==="")
            {
                montapneu($eixo,1,1,"","",$mostrapos);
            }
           $cmd="SELECT numero_chip,"
                . "marca, medida, modelo, banda, vida, numero_serie, eixo, roda "
                . " FROM pneu where numero_chip_veiculo='".$chip."' and roda>0 and "
                . " eixo=".$eixo." and roda=2";
            $resultb=  mysql_query($cmd);
            $numero_serie="";
            $mostrapos=$posicao."EI";
            while ($row = mysql_fetch_array($resultb)) 
            {
                $numero_serie=$row["numero_serie"];
                if($numero_serie!=="")
                {
                    montapneu($eixo,2,2,$row["numero_serie"],$row["numero_chip"],$mostrapos);
                }
                $existe=true;
            }
            if($numero_serie==="")
            {
                montapneu($eixo,2,2,"","",$mostrapos);
            }
            montaeixo($eixo);
           $cmd="SELECT numero_chip,"
                . "marca, medida, modelo, banda, vida, numero_serie, eixo, roda "
                . " FROM pneu where numero_chip_veiculo='".$chip."' and roda>0 and "
                . " eixo=".$eixo." and roda=3";
            $resultb=  mysql_query($cmd);
            $numero_serie="";
            $mostrapos=$posicao."DI";
            $existe=false;
            while ($row = mysql_fetch_array($resultb)) 
            {
                $numero_serie=$row["numero_serie"];
                montapneu($eixo,3,3,$row["numero_serie"],$row["numero_chip"],$mostrapos);
                $existe=true;
            }
            if($numero_serie===""&&!$existe)
            {
                montapneu($eixo,3,3,"","",$mostrapos);
            }
           $cmd="SELECT numero_chip,"
                . "marca, medida, modelo, banda, vida, numero_serie, eixo, roda "
                . " FROM pneu where numero_chip_veiculo='".$chip."' and roda>0 and "
                . " eixo=".$eixo." and roda=4";
            $resultb=  mysql_query($cmd);
            $existe=false;
            $numero_serie="";
            $mostrapos=$posicao."DE";
            while ($row = mysql_fetch_array($resultb)) 
            {
                $numero_serie=$row["numero_serie"];
                montapneu($eixo,4,4,$row["numero_serie"],$row["numero_chip"],$mostrapos);
                $existe=true;
            }
            if($numero_serie==="")
            {
                montapneu($eixo,4,4,"","",$mostrapos);
            }
        }
        echo '</td></tr>';
    }
        $cmda="select * from eixo_veiculo where chip_veiculo in ('".$chip."') and ideixo_veiculo = 0";
          
        $result= mysql_query($cmda);
        $eixoant="";
        echo '<th>Estepes</th><tr><td>';    
        while($rsa=  mysql_fetch_array($result))
        {
            $eixo=$rsa["ideixo_veiculo"];
                    
            $ideixo=$rsa["ideixos"];
            $qtdrodas=$rsa["qtdrodas"];
            
            $foieixo="pull-left";
            $ixroda=1;
            
            while($ixroda<$qtdrodas+1)
            {
                
                $cmd="SELECT numero_chip,"
                    . "marca, medida, modelo, banda, vida, numero_serie, eixo, roda "
                    . " FROM pneu where numero_chip_veiculo='".$chip."' and roda>0 and "
                    . " eixo=0 and roda in ('".$ixroda."')";
                
                $resultb=  mysql_query($cmd);
                $numero_serie="";
                if(mysql_num_rows($resultb)==0)
                {
                    montapneu(0,$ixroda,$ixroda,$numero_serie,$row["numero_chip"],"");
                }
                else
                {
                    while ($row = mysql_fetch_array($resultb)) 
                    {
                        $numero_serie=$row["numero_serie"];
                        montapneu(0,$ixroda,$ixroda,$numero_serie,$row["numero_chip"],"");
                        $existe=true;
                    }
                }
                $ixroda++;
            }
        }
        echo '</td></tr>';
    echo '</table></center></div>';
    function montaeixo($eixo)
    {
        
        echo '<div class=container-eixodes>';
        switch ($eixo)
        {
            case 1:
            {
                echo'<img class="img-responsive" src="images/eixodirecao.png" />';
                break;
            }
             case 2:
            {

                echo'<img class="img-responsive" src="images/eixotracao.png" />';

                break;
            }
            case 3:
            {
                 echo '<img class="img-responsive" src="images/eixolivre.png" />';
                 break;
            }
            case 4:
            {
                 echo '<img class="img-responsive" src="images/eixolivre.png" />';
                  break;
            }
            default :
            {
                 echo '<img class="img-responsive" src="images/eixolivre.png" />';
                  break;
            }    
            
        }
        echo '</div>'; 
     
    }
    function montapneu($ideixo,$roda,$posicao,$numserie,$chip,$mostrapos)
    {
            
        echo '<div class="page-primary container-pneu" >';
        if($numserie!=="")
        {
             echo '<button class="btn btn-info" onclick='.'"'."novoresumo('php/menu_pneu.php?numero_chip=".$chip."' ,'menu');".'" style="font-size:12px;" >'
                    .$numserie.'<br>'.$mostrapos  
                .'</button>';
         }
        else 
        { 
            $tag="'".$ideixo."*".$roda."*".$posicao."*".$chip."'";
            echo '<div  class="btn btn-danger" id='.$tag.'  style="font-size:12px;">'
                .'<label class=label onclick="mostrapneualmox('.$tag.')">XXXX<br>'.$mostrapos.'</label>'
                .'</div><div id='.$tag.'></div>';
            
        }
        echo '</div>';
    }
  
?>



