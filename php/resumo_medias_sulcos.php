<?php 
include 'mysql.php';
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
  </head>
  <body >
      <label class="text-info pull-right" style="margin:1rem;margin-right: 20px;"><i class="fa fa-arrow-circle-down" onclick="limpadiv('page-wrapper');" >Fechar</i></label>
      <div class="table-responsive">
   

      <h4 class="text-center">Média em MM dos sulcos de pneus</h4> 
      <button type="button" style="margin: 1rem;padding: 5px;" 
                id=export class="btn text-right" onclick="parent.exportatable('medidas');" >
          Exportar para CSV 
        </button>
       <?php
        
        $queryrs ="select distinct medida.numero_chip, numero_serie, "
                . " DATE_FORMAT(datamedida,'%d/%m/%Y') datamedida, "
                . " avg(medida.medida) media_sulcos, "
                ."pneu.marca, pneu.medida,pneu.modelo,banda,vida, pneu.numero_chip,"
                . "eixo,roda,registro_veiculo, placa_veiculo, numero_chip_veiculo"
            . " from pneu, medida, veiculo "
            . " where pneu.numero_chip=medida.numero_chip"
            . " and pneu.idpessoa=".$_REQUEST["idpessoa"] 
            . " and pneu.idpessoa=medida.idpessoa"
                . " and datamedida = "
                . "   (select max(datamedida) from medida c "
                . "     where pneu.idpessoa=c.idpessoa"
                . "       and pneu.numero_chip=c.numero_chip) "
            .  ' and numero_chip_veiculo = chip_veiculo'
            .  ' and medida.medida >0 '
            . " group by numero_serie, datamedida  "
                 ." order by avg(medida.medida), numero_serie, placa_veiculo, datamedida";
       
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
       
        echo mysql_error();
        echo '<table class="table" width=100% id=falhas name=eixos >';
            echo "<tr> <th >MARCA DE FOGO</th>"
                    . "<th >MEDIDA</th>"
                    . "<th >MARCA</th>"
                    . "<th >MODELO</th>"
                    . "<th >BANDA</th>"
                    . "<th >VIDA</th>"
                    . "<th >VEÍCULO</th>"
                    . "<th >EIXO</th>"
                    . "<th >RODA</th>"
                    . "<th >DATA</th>"
                    . "<th >MÉDIA<br>SULCOS</th>"
                    . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            if($rsan["media_sulcos"]<5)
            {
                echo '<tr style="color:white;background-color:red;">';
            }
            else 
            {
                echo '<tr style="color:white;background-color:green;">';
            }
                
            echo '<td ><a onclick="abrepneu('."'".$rsan["numero_chip_veiculo"]."','".$rsan["numero_chip"]."'".');" style="color:white;cursor:pointer;">'
                    .$rsan["numero_serie"].'</a></td>';
            echo '<td >'.$rsan["medida"].'</td>';
            echo '<td >'.$rsan["marca"].'</td>';
            echo '<td >'.$rsan["modelo"].'</td>';
            echo '<td >'.$rsan["banda"].'</td>';
            echo '<td style="text-align:center;" >'.$rsan["vida"].'</td>';
            echo '<td >'.$rsan["placa_veiculo"].'</td>';
            echo '<td >'.$rsan["eixo"].'</td>';
            echo '<td >'.$rsan["roda"].'</td>';
            if($rsan["datamedida"]!==""&&$rsan["datamedida"]!==null)
            {
                echo '<td >'.$rsan["datamedida"].'</td>';
            }
            else {
                echo '<td>sem data</td>';
            }
            echo '<td >'.$rsan["media_sulcos"].'</td>';
           echo "</tr>";
        }
        echo "</table>"; 
        ?>
 
</body>
</html>