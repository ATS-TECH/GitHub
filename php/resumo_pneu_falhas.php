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
      <label class="text-info pull-right" style="margin:1rem;margin-right: 20px;"><i class="fa fa-arrow-circle-down" onclick="limpadiv('page-wrapper');" >Fechar</i></label>
      <div class="table-bordered"> 
          
       <?php
        
        $queryrs = "SELECT idfalhas, descrfalha, dataregistro FROM falhas_pneu, falhas"
                ." where idfalhas=idfalhas_pneu "
                . " and numero_chip = '".$chip."'"
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
                . " order by dataregistro, descrfalha";
        $conta=0;
        $salva=$queryrs;
        
        $resultado = mysql_query($queryrs);
        echo '<table class="table" id=falhas name=eixos >';
        echo '<h4 class="text-center">Falhas registradas nos pneus</h4>';
            echo "<tr> <th >DESCRIÇÃO DA FALHA</th>"
                    . "<th  >DTA DE REGISTRO</th>"
                    . "<th  >Excluir</th>"
                    . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo '<td style="padding:5px;text-align:left;cursor:pointer" >'.$rsan["descrfalha"].'</td>';
            echo '<td style="padding:5px;text-align:left;"  >'.date_format(date_create($rsan["dataregistro"]),"d/m/Y h:i").'</td>';
            echo '<td class="btn" style="padding:5px;text-align:left;" onclick="excluifalha('
                    .$rsan["idfalhas"].",'".$rsan["dataregistro"]."'"
                    .')"><i class="fa fa-remove"></i></td>';
            echo "</tr>";
        }
        echo "</table>"; 
        ?>
    </div> 
      <div class="container-fluid">
            Registro de Falhas
            <button type="button" class="btn btn-primary dropdown-toggle"
                role="button"  
                data-toggle="dropdown" href="#">Selecione a falha a registrar
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" style='top: 0;font-size: 11px;letter-spacing: 1px;padding: 3px;' role="menu">

                <?php 
                    $cmd = "SELECT idfalhas,descrfalha FROM falhas order by descrfalha ";


                    $cmd=  mysql_query($cmd);
                    echo mysql_error();
                    while($rs=  mysql_fetch_array($cmd))
                    {
                        echo '<li class="divider"></li><li role="menu" class="btn nav-tabs nav-justified " style="width: 100%;"
                              onclick="falhaspneu('.$rs["idfalhas"].');" >'.$rs["descrfalha"].'</li>';

                    }
                ?>

        </div>

</body>
</html>