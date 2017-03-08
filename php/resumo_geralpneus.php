<?php 
include 'mysql.php';
$chip=$_REQUEST['numero_chip'];
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  </head>
  <body >
     
      <div class="table-responsive" width=100%>
        <h4 class="text-center">Resumo Geral dos pneus</h4> 
       <?php
        
        $queryrs = "SELECT marca,medida,modelo,count(*) qtd FROM pneu "
                . ' where idpessoa='.$_REQUEST['idpessoa'] 
                   ." group by marca,medida,modelo order by marca,medida,modelo";
        $conta=0;
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        echo "<table class=table width=100% id=falhas name=eixos >";
            echo "<tr> <th  >MARCA</th>"
                    . "<th  >MEDIDA</th>"
                    . "<th  >MODELO</th>"
                    . "<th  >QUANTIDADE</th>"
                    . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo '<td  >'.$rsan["marca"].'</td>';
            echo '<td  >'.$rsan["medida"].'</td>';
            echo '<td  >'.$rsan["modelo"].'</td>';
          
            echo '<td  >'.$rsan["qtd"].'</td>';
            echo "</tr>";
        }
        echo "</table>"; 
        ?>
    </div> 
</body>
</html>