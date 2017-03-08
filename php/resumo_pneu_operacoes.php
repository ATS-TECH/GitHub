
<div class="bg-3">
   
      <br>
       
       <?php
        
        if(isset($numchip)&&$numchip!=="")
        {
            $queryrs = "SELECT pneu.numero_serie, marca,medida,modelo,banda,vida,"
                . "componente_historico.eixo,componente_historico.posicao roda,"
                . "chip_veiculo, "
                . "(CASE WHEN data_instalacao is null THEN data_desmonte "
                . " ELSE data_instalacao END) data_operacao,"
                . "(CASE WHEN data_instalacao is null THEN 'REMOVIDO' "
                . " ELSE 'INSTALADO' END) operacao,"
                . "data_instalacao,data_desmonte, kmveiculo "
                . " FROM pneu, componente_historico  "
                . ' where pneu.idpessoa='.$_REQUEST['idpessoa'];
            if(isset($numchip)&&$numchip!=="")
            {
                $queryrs .= " and pneu.numero_chip='".$numchip."'";
            }
            if(isset($_REQUEST["dataoperacao"])&&$_REQUEST["dataoperacao"]!=="")
            {
                $queryrs .= " and date(data_instalacao)=date('".$_REQUEST["dataoperacao"]."')";
            }
            if((isset($_REQUEST["dataini"])&&$_REQUEST["dataini"]!=="")&&
                (isset($_REQUEST["datafim"])&&$_REQUEST["datafim"]!==""))
            {
                $queryrs .= " and ((date(data_instalacao) between date('".$_REQUEST["dataini"]."') and date('".$_REQUEST["datafim"]."')) or"
                        . "        (date(data_desmonte) between date('".$_REQUEST["dataini"]."') and date('".$_REQUEST["datafim"]."'))) ";
            }
            $queryrs .=' and pneu.numero_chip=componente_historico.numero_chip'
                       ." order by pneu.numero_serie,CASE WHEN data_instalacao is null THEN data_desmonte "
                       . " ELSE data_instalacao END";
            $conta=0;
    //        echo $queryrs;
            $salva=$queryrs;
            $resultado = mysql_query($queryrs);
            echo mysql_error();
            $total=  mysql_num_rows($resultado);
            echo "<table class=table width=100% id=falhas name=eixos >";

                echo '<tr>'
                    . '<h4 >Histórico de movimentação do pneu</h4></tr>';


                echo "<tr> <th >VEÍCULO</th>"
                        . "<th >KM</th>"
                        . "<th >DATA OP</th>"
                        . "<th >OPERAÇÃO</th>"
                        . "<th >POSIÇÃO</th>"
                        . "</tr>"; 
            while($rsan=mysql_fetch_array($resultado))
            {
                $eixo=$rsan["eixo"];
                $roda=$rsan["roda"];
                if($rsan["chip_veiculo"]!=="")
                {
                    $cmd ="select placa_veiculo,registro_veiculo from veiculo where chip_veiculo in ('".$rsan["chip_veiculo"]."')";
                    $result = mysql_query($cmd);
                    while($rs=  mysql_fetch_array($result))
                    {
                        $veiculo=$rs["placa_veiculo"]." - ".$rs["registro_veiculo"];
                    }
                    $eixo=$rsan["eixo"];
                    $cmd ="select qtdrodas, ideixos from eixo_veiculo "
                        . " where ideixo_veiculo=".$eixo." and chip_veiculo in ('".$rsan["chip_veiculo"]."')";
                    $result = mysql_query($cmd);
                    while($rs=  mysql_fetch_array($result))
                    {
                        $qtdrodas=$rs["qtdrodas"];
                        $ideixo=$rs["ideixos"];
                    }
                }

                echo "<tr>";

                echo '<td ><a onclick="detalhesmenu('."'".$rsan["chip_veiculo"]."'".' , 1,'."'S'".');" style="cursor:pointer;">'.$veiculo.'</a></td>';
                echo '<td >'.number_format($rsan["kmveiculo"],0,"",".").'</td>';
                echo '<td style="text-align:left;" >'.date_format(date_create($rsan["data_operacao"]),"d/m/Y H:i").'</td>';
                echo '<td style="text-align:left;" >'.$rsan["operacao"].'</td>';
                // $ideixo, $qtdrodas, $roda
                include "posicaopneu.php";
                echo '<td>'.$posicao.'</td>';
                echo "</tr>";
            }
            echo "</table></div>"; 
        }
?>
 
