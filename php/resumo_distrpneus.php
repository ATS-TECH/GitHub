<?php 
include 'mysql.php';
$chip=$_REQUEST['numero_chip'];
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css.css" rel="stylesheet" type="text/css">
    <link href="css_resumo.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  </head>
  <body >
      
<div class="container-fluid table-responsive">
        <h4 class="text-center">Distribuição dos pneus</h4> 
       <?php
        
        $queryrs = "SELECT placa_veiculo,modelo_veiculo, pneu.medida medida,pneu.marca marcapneu, pneu.modelo modpneu, count(*) qtdpneus "
                . " from pneu, veiculo"
                ." where veiculo.chip_veiculo=numero_chip_veiculo"
                . ' and pneu.idpessoa='.$_REQUEST['idpessoa'] 
                ." group by placa_veiculo,modelo_veiculo,medida,pneu.marca , pneu.modelo "
                . " order by placa_veiculo,modelo_veiculo,medida,pneu.marca , pneu.modelo";
        $conta=0;
        $salva=$queryrs;
         
        $resultado = mysql_query($queryrs);
        echo "<table class=table width=100% id=falhas name=eixos >";
            echo "<tr> <th  >PLACA</th>"
           
                    . "<th  >MODELO</th>"
                    . "<th  >MEDIDA</th>"
                    . "<th  >PNEU / MODELO</th>"
                     
                    . "<th  >QTD.</th>"
                    . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo '<td  >'.$rsan["placa_veiculo"].'</td>';
          
             echo '<td  >'.$rsan["modelo_veiculo"].'</td>';
            echo '<td  >'.$rsan["medida"].'</td>';
            echo '<td  >'.$rsan["marcapneu"]." / ".$rsan["modpneu"].'</td>';
            
            echo '<td  >'.$rsan["qtdpneus"].'</td>';
            echo "</tr>";
        }
        echo "</table>"; 
        ?>
    </fieldset> 
</body>
</html>