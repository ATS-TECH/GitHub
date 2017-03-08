<?php 
include 'mysql.php';
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
<div class="container-fluid bg-3">
      <?php
      if(isset($_REQUEST["vida"])&&$_REQUEST["vida"]!=="")
        {
           echo ' <label class="text-info pull-right" style="margin:1rem;margin-right: 20px;"><i class="fa fa-arrow-circle-down" onclick="window.parent.limpadiv('."'".'contgeral'."'".');" >Fechar</i></label>';
        
        }
        else 
        {
            echo '<label class="text-info pull-right" style="margin:1rem;margin-right: 20px;"><i class="fa fa-arrow-circle-down" onclick="limpadiv('."'".'page-wrapper'."'".');" >Fechar</i></label>';
        
        }
        ?>
    <div class="table-responsive">
      <button type="button" style="margin: 1rem;padding: 5px;" 
                id=export class="btn text-right" onclick="parent.exportatable('pneu');" >
          Exportar para CSV 
        </button>
       <?php
        
        $queryrs = "SELECT pneu.numero_serie, marca, medida,modelo,banda,vida, pneu.numero_chip,"
                . "eixo,roda,numero_chip_veiculo, data_registro  FROM pneu, componente_almox "
                . ' where pneu.idpessoa='.$_REQUEST['idpessoa']
                . ' and pneu.idpessoa=componente_almox.idpessoa';
        if(isset($_REQUEST["vida"])&&$_REQUEST["vida"]!=="")
        {
            $vida=$_REQUEST["vida"]*1;
            
            $queryrs .= ' and vida='.$vida
                    .' and month(data_registro)='.$_REQUEST["mes"]
                    .' and year(data_registro)='.$_REQUEST["ano"];
        }
        $queryrs .= ' and pneu.numero_chip=componente_almox.numero_chip'
                . ' and data_baixa is null'
                   ." order by data_registro";
        $conta=0;
                        
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        
        echo '<h4 class="text-center">Inventário Geral de pneus: '.  mysql_num_rows($resultado).' pneus encontrados</h4>';
        
        echo '<table class="table" width=100% id=falhas name=eixos >';
            echo "<tr> <th >MARCA DE FOGO</th>"
                    . "<th >REGISTRO</th>"        
                    . "<th >MEDIDA</th>"
                    . "<th >MARCA</th>"
                    . "<th >MODELO</th>"
                    . "<th >BANDA</th>"
                    . "<th >VIDA</th>"
                    . "<th >VEÍCULO</th>"
                    . "<th >EIXO</th>"
                    . "<th >RODA</th>"
                    . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "<tr>";
            if($rsan["numero_chip_veiculo"]!==null)
            {
                echo '<td ><a onclick="abrepneu('."'".$numero_chip_veiculo."','".$rsan["numero_chip"]."'".');" >'
                    .$rsan["numero_serie"].'</a></td>';
            }
            else
            {
                echo '<td><a onclick="abrepneualmox('."'".$rsan["numero_chip"]."'".');" >'
                    .$rsan["numero_serie"].'</a></td>';
            }
            echo '<td >'.date_format(date_create($rsan["data_registro"]),"d/m/Y H:i").'</td>';
            echo '<td >'.$rsan["medida"].'</td>';
            echo '<td >'.$rsan["marca"].'</td>';
            echo '<td >'.$rsan["modelo"].'</td>';
            echo '<td >'.$rsan["banda"].'</td>';
            echo '<td >'.$rsan["vida"].'</td>';
            $ideixo=$rsan["eixo"];
            if($rsan["numero_chip_veiculo"]!==null)
            {
                $cmd="select placa_veiculo from veiculo"
                        . " where chip_veiculo in ('".$rsan["numero_chip_veiculo"]."')"
                        . " and idpessoa=".$_REQUEST['idpessoa']
                        . " order by placa_veiculo";
                $result=  mysql_query($cmd);
                while($rs=  mysql_fetch_array($result))
                {
                    $placa=$rs["placa_veiculo"];
                    $numero_chip_veiculo=$rsan["numero_chip_veiculo"];
                }
                $cmd="select qtdrodas, ideixos from eixo_veiculo"
                        . " where ideixo_veiculo= ".$ideixo
                        . " and chip_veiculo in ('".$rsan["numero_chip_veiculo"]."')"
                        . " and idpessoa=".$_REQUEST['idpessoa']
                        . " order by qtdrodas";
                $result=  mysql_query($cmd);
                while($rs=  mysql_fetch_array($result))
                {
                    $qtdrodas=$rs["qtdrodas"];
                    $ideixos=$rs["ideixos"];
                    
                }
                echo '<td ><a onclick="abreveiculo('."'".$numero_chip_veiculo."'".');" >'
                        .$placa.'</a></td>';
                if($ideixo==0)
                {
                    echo '<td >ESTEPE</td>';
                }
                else
                {
                    $posicao="";
                    echo '<td >'.$ideixo.'</td>';
                    switch ($ideixos)
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

                        if($rsan["roda"]==1)
                        {

                            $posicao.="E";

                        }
                        else
                        {
                            $posicao.="D";
                        }
                    }
                    else
                    {
                        switch ($rsan["roda"])
                        {
                            case 1:
                                $posicao.="EE";
                                break;
                            case 2:
                                $posicao.="EI";
                                break;
                            case 3:
                                $posicao.="DI";
                                break;
                            case 4:
                                $posicao.="DE";
                                break;
                        }
                    }
                    echo '<td >'.$posicao.'</td>';
                }
            }
            else 
            {
                
                echo '<td >ALMOXARIFADO</td>';
            }
           echo "</tr>";
        }
        echo "</table>"; 
        ?>
    </div>
</div>
</body>
</html>