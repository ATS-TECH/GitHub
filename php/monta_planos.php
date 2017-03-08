<ul class="nav navbar-nav navbar-right">
    <div class="container-fluid">
    <li class="dropdown">
        <a class="dropdown-toggle btn btn-danger" data-toggle="dropdown" href="#">Selecione<br>o plano
    </a>

    <ul class="dropdown-menu" style="font-size: 11px;letter-spacing: 1px;padding: 3px;">
        <?php
        include 'mysql.php';

        $cmd = "SELECT idplano_manutencao, nome_plano from plano_manutencao"
                . " where idplano_manutencao not in "
                . " (select idplano_manutencao from veiculo_plano "
                . "   where veiculo_plano.idplano_manutencao = plano_manutencao.idplano_manutencao"
                . "     and veiculo_plano.idpessoa = plano_manutencao.idpessoa"
                . "     and veiculo_plano.chip_veiculo = '".$_REQUEST["idveiculo"]."'"
                . "     and veiculo_plano.chip_veiculo = ".$_REQUEST["idpessoa"]
                . "     and plano_manutencao.idplano_manutencao=veiculo_plano.idplano_manutencao)";

        $result=  mysql_query($cmd);
        $conta=0;
        echo mysql_error();
        while ($row = mysql_fetch_array($result)) 
        {

           echo '<li role="presentation" '
           . ' onclick="associaplano('.$row["idplano_manutencao"].');" class="btn btn-info nav-tabs nav-justified" >'
                   .$row["nome_plano"].'</li><li class=divider></li>';
        }
        ?>
    </ul>
</li>
</ul>


