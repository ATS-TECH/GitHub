<?php 
include 'mysql.php';
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
  </head>
  <body >
      <div id="execmanu"></div>
      <div class="table-responsive">
   

          <center><h4 class="text-center">Inventário do Almoxarifado</h4></center>
<!--      <button type="button" style="margin: 1rem;padding: 5px;" 
                id=export class="btn text-right" onclick="parent.exportatable('almoxarifado');" >
          Exportar para CSV 
        </button>-->
        <div id="execmanu"></div>
       <?php
        
        $queryrs = "SELECT * FROM componente "
                . ' where componente.idpessoa='.$_REQUEST['idpessoa'] 
                   ." order by descrComponente";
        $conta=0;
//       echo $queryrs;
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        echo '<table class="table" width=100% id=falhas name=eixos >';
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "<tr><th colspan=4>".$rsan["descrComponente"]."</th></tr>"; 
            $cmd="select * from componente_almox "
                    . " where idpessoa=".$rsan["idpessoa"]
                    ." and idcomponente=".$rsan["idcomponente"]
                    . ' and data_baixa is null'
                    . ' and data_montagem is null'
                    . ' order by numero_serie';
            $result=mysql_query($cmd);
            
            echo mysql_error();
            echo "<tr><th >Numero<br> de Série</th>"
            . "<th >Chip Instalado</th><th >Data de<br>Registro</th><th >Valor de<br>Aquisição</th></tr>";
            while($rs=  mysql_fetch_array($result))
            {
                $link = '"php/selecionacomponente.php?idpessoa='.$rs["idpessoa"].'&numero_chip='.$rs["numero_chip"]."','execmanu'";
                echo "<tr>";
                echo '<td ><a onclick="injeta('.$link.' );" >'.$rs["numero_serie"].'</a></td>';
                if($rs["numero_serie"]===$rs["numero_chip"])
                {
                    echo '<td >SEM CHIP</td>';
                }
                else
                {
                    echo '<td >'.$rs["numero_chip"].'</td>';
                }
                
                echo '<td >'.date_format(date_create($rs["data_registro"]),"d/m/Y H:i").'</td>';
                echo '<td >'."R$ ".number_format($rs["valor_unitario"],2,",",".").'</td>';

                echo "</tr>";
            }
        }
        echo "</table>"; 
        ?>
 
</body>
</html>