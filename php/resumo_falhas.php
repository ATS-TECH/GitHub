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
      
      <div class="table-responsive"> 
          
       <?php
        
        $queryrs = "SELECT descrfalha, count(*) qtd FROM falhas_pneu, falhas"
                ." where idfalhas=idfalhas_pneu "
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
                . " group by descrfalha order by descrfalha";
        $conta=0;
        $salva=$queryrs;
        
        $resultado = mysql_query($queryrs);
        echo '<table class="container table" id=falhas name=eixos >';
        echo '<h4 class="text-center">Falhas registradas nos pneus</h4>';
            echo "<tr> <th >DESCRIÇÃO DA FALHA</th>"
                    . "<th  >QTD.</th>"
                    . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo '<td style="padding:5px;text-align:left;" '
            . ' onclik="php/resumoporfalha.php?idfalhas='.$rsan["idfalhas"].'" >'.$rsan["descrfalha"].'</td>';
            echo '<td style="padding:5px;text-align:right;"  >'.$rsan["qtd"].'</td>';
            echo "</tr>";
        }
        echo "</table>"; 
        ?>
    </div> 
</body>
</html>