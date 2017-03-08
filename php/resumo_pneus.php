<?php 
include 'mysql.php';
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
  </head>
  <body >
      <div class="table-responsive">
   
</div>
      <br>
       
       <?php
        
        $queryrs = "SELECT numero_serie, marca,medida,modelo,banda,vida,eixo,roda,numero_chip_veiculo  FROM pneu "
                . ' where idpessoa='.$_REQUEST['idpessoa'] 
                   ." order by numero_serie";
        $conta=0;
       
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        echo "<table class=table width=100% id=falhas name=eixos >";
        echo '<tr><h4 class="text-center">Resumo Geral dos pneus</h4></tr>';
            echo "<tr> <th >MARCA DE FOGO</th>"
                    . "<th >MEDIDA</th>"
                    . "<th >MARCA</th>"
                    . "<th >MODELO</th>"
                    . "<th >BANDA</th>"
                    . "<th >VIDA</th>"
                    . "<th >VEÍCULO</th>"
                    . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            $veiculo="ALMOXARIFADO";
            if($rsan["numero_chip_veiculo"]!=="")
            {
                $cmd ="select placa_veiculo,registro_veiculo from veiculo where chip_veiculo in ('".$rsan["numero_chip_veiculo"]."')";
                $result = mysql_query($cmd);
                while($rs=  mysql_fetch_array($result))
                {
                    $veiculo=$rs["placa_veiculo"]." - ".$rs["registro_veiculo"];
                }
            }
            
            echo "<tr>";
            echo '<td >'.$rsan["numero_serie"].'</td>';
            echo '<td >'.$rsan["medida"].'</td>';
            echo '<td >'.$rsan["marca"].'</td>';
            echo '<td >'.$rsan["modelo"].'</td>';
            echo '<td >'.$rsan["banda"].'</td>';
            echo '<td style="text-align:center;" >'.$rsan["vida"].'</td>';
            echo '<td >'.$veiculo.'</td>';
            echo "</tr>";
        }
        echo "</table>"; 
        ?>
 
</body>
</html>