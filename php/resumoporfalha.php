<?php 
include 'mysql.php';
$chip=$_REQUEST['numero_chip'];
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css.css" rel="stylesheet" type="text/css">
    <link href="css_resumo.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  </head>
  <body >
      
      <div class="container"> 
          
       <?php
        
        $queryrs = "SELECT descrfalha, count(*) qtd FROM falhas_pneu, falhas"
                ." where idfalhas=idfalhas_pneu "
                ." where idfalhas=".$_REQUEST['idfalha']
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
                . " group by descrfalha order by descrfalha";
        $conta=0;
        $salva=$queryrs;
        
        $resultado = mysql_query($queryrs);
        echo "<table class=table-responsive id=falhas name=eixos >";
            echo "<tr> <th >DESCRIÇÃO DA FALHA</th>"
                    . "<th  >QTD.</th>"
                    . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            echo '<h4 class="text-center">'.$rsan["descrfalha"].' ('.$rsan["qtd"].')</h4>';
           
        }
        $cmd='select distinct numero_serie, numero_chip from pneu '
                . ' where idpessoa= '.$_REQUEST['idpessoa'] 
                ." and numero_chip in"
                ." (select distinct numero_chip  from falhas_pneu "
                . " where idfalhas_pneu=".$_REQUEST['idfalha']
                . " and idpessoa in (".$_REQUEST['idpessoa'].")";
        $resultado = mysql_query($cmd);
        while($rs=mysql_fetch_array($resultado))
        {
            $numero_chip=$rs["numero_chip"];
            $numero_serie=$rs["numero_serie"];
            echo '<div class="panel panel-primary" >'
            . '<div class="panel-heading text-left  " >'
                   . ' PNEU COM FALHA<span class="pull-right">Fechar <i class="fa fa-arrow-circle-right" '
            . ' onclick="limpadiv('."'".$rs["numero_chip"]."'".');"></i></span>'
            . '</div>' 
            . '<div class="panel-footer">'
                .'<div class=row style="padding:0.5rem;cursor:pointer;" '
                . ' onclick="mostracompalmox('."'".$rs["numero_chip"]."'".');"  >'
                    . '<span class="pull-right" >'
                    . 'Editar '.$numero_serie.' <i class="fa fa-arrow-circle-right"></i></span>  '
                .'</div>'
            . '</div>';
            echo '</div> ';
            echo '<div class=container id='.$rs["numero_chip"].'></div>';
        }
        ?>
    </div> 
</body>
</html>