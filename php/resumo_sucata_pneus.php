<?php 
include 'mysql.php';
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body >
      <label class="text-info pull-right" style="margin:1rem;margin-right: 20px;"><i class="fa fa-arrow-circle-down" onclick="limpadiv('page-wrapper');" >Fechar</i></label>
      <div class="table-responsive">
   
</div>
       
       <?php
        
        $queryrs = "SELECT pneu.numero_serie, marca, medida,modelo,banda,vida,eixo,roda, data_baixa FROM pneu, componente_almox"
                . ' where pneu.idpessoa='.$_REQUEST['idpessoa'] 
                .' and numero_chip_veiculo is null '
                .' and data_baixa is not null '
                . ' and pneu.numero_chip = componente_almox.numero_chip '
                   ." order by vida, data_baixa, numero_serie";
        $conta=0;
        
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        $total=  mysql_num_rows($resultado);
        echo'<h4 class="text-center">Pneus Sucateados - '.$total.' pneus</h4>';
        echo "<table class=table width=100% id=falhas name=eixos >";
            echo "<tr> <th >MARCA DE FOGO</th>"
                    . "<th >MEDIDA</th>"
                    . "<th >MARCA</th>"
                    . "<th >MODELO</th>"
                    . "<th >BANDA</th>"
                    . "<th >VIDA</th>"
                    . "<th> DATA DA BAIXA</th>"
                    . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo '<td >'.$rsan["numero_serie"].'</td>';
            echo '<td >'.$rsan["medida"].'</td>';
            echo '<td >'.$rsan["marca"].'</td>';
            echo '<td >'.$rsan["modelo"].'</td>';
            echo '<td >'.$rsan["banda"].'</td>';
            echo '<td >'.$rsan["vida"].'</td>';
            if ($rsan["data_baixa"]!=="")
            {
                echo '<td >'.date_format(date_create($rsan["data_baixa"]),"d/m/Y H:i").'</td>';
            }
           echo "</tr>";
        }
        echo "</table>"; 
        ?>
 
</body>
</html>