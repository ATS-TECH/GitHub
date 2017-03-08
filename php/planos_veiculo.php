       
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">  
            <div class="navbar-header" style='margin-right:20px;'>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navplan">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span> 
                </button>

                <div class="navbar-brand"><span class="pull-left navbar-text" >Manutenção</span></div>
                <div id="emparea"></div>
            </div>
            <div class="collapse navbar-collapse navbar-right " id="Navplan">
                
                <ul class="nav navbar-nav" role="menu">
                    <li class="dropdown" style='margin:0 0 20px 20px;'>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <label class="text-info pull-right" style="font-size: 12px;">
                            <i class="fa fa-caret-square-o-down size-14"  ></i><span style="padding-left: 2px;">Planos<br>Associados</span>
                            </label>
                        </a>

                        <ul class="dropdown-menu" style='font-size: 11px;letter-spacing: 1px;padding: 3px;'>
                            <?php
                            include 'mysql.php';
                            $cmd="select idplano_manutencao, nome_plano "
                                    . " from  plano_manutencao "
                                    . " where idpessoa =".$_REQUEST["idpessoa"]
                                    . " and mandatorio='S'";
                            $result=  mysql_query($cmd);

                            echo mysql_error();
                            while($rs=  mysql_fetch_array($result))
                            {
                                echo '<li class=divider></li><li class="btn btn-info nav-tabs nav-justified" '
                                . 'onclick="manutencao('.$rs["idplano_manutencao"].');" >'.$rs["nome_plano"].'</li>';
                            }
                            
                            $cmd="select veiculo_plano.idplano_manutencao, nome_plano "
                                    . " from veiculo_plano, plano_manutencao "
                                    . " where veiculo_plano.idpessoa =".$_REQUEST["idpessoa"]
                                    . " and mandatorio='N'"
                                    . " and veiculo_plano.chip_veiculo='".$_REQUEST["chip_veiculo"]."'"
                                    . " and veiculo_plano.idplano_manutencao=plano_manutencao.idplano_manutencao" 
                                    . " and veiculo_plano.idpessoa=plano_manutencao.idpessoa";
                            $result=  mysql_query($cmd);

                            echo mysql_error();
                            while($rs=  mysql_fetch_array($result))
                            {
                                echo '<li class=divider></li><li class="btn btn-info nav-tabs nav-justified" '
                                . 'onclick="manutencao('.$rs["idplano_manutencao"].');" >'.$rs["nome_plano"].'</li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="dropdown" style='margin-right: 20px;'>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <label class="text-info pull-left" style="font-size: 12px;">
                            <i class="fa fa-caret-square-o-down size-14"  ></i><span style="padding-left: 2px;">Associar<br>Planos</span>
                            </label
                    </a>

                    <ul class="dropdown-menu" style="margin-right: 20px;font-size: 11px;letter-spacing: 1px;padding: 3px;">
                        <?php
                        include 'mysql.php';

                        $cmd = "SELECT idplano_manutencao, nome_plano from plano_manutencao"
                                . " where idplano_manutencao not in "
                                . " (select idplano_manutencao from veiculo_plano "
                                . "   where veiculo_plano.idplano_manutencao = plano_manutencao.idplano_manutencao"
                                . "     and veiculo_plano.idpessoa = plano_manutencao.idpessoa"
                                . "     and mandatorio='N'"
                                . "     and veiculo_plano.chip_veiculo = '".$_REQUEST["idveiculo"]."'"
                                . "     and veiculo_plano.chip_veiculo = ".$_REQUEST["idpessoa"]
                                . "     and plano_manutencao.idplano_manutencao=veiculo_plano.idplano_manutencao)";

                        $result=  mysql_query($cmd);
                        $conta=0;
                        echo mysql_error();
                        while ($row = mysql_fetch_array($result)) 
                        {

                           echo '<li class=divider></li><li role="presentation" '
                           . ' onclick="associaplano('.$row["idplano_manutencao"].');" class="btn btn-info nav-tabs nav-justified" >'
                                   .$row["nome_plano"].'</li>';
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

