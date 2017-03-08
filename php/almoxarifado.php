       
    <nav class="navbar navbar-default ">
    <div class="container-fluid">
        <ul class="nav navbar-nav pull-right">
        <li class="navbar-header">
            <a class="navbar-brand" > Controle de Estoque</a>
        </li>
        
        <li class="dropdown pull-right" style='margin-right:20px;'>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Famílias de<br>Componentes
                        </a>

                        <ul class="dropdown-menu" style='font-size: 11px;letter-spacing: 1px;padding: 3px;'>
                            <?php
                            include 'mysql.php';
                            $cmd="select idcomponente, descrcomponente  from componente "
                                    . " where idpessoa =".$_REQUEST["idpessoa"]
                                    . " order by descrcomponente";
                            $result=  mysql_query($cmd);

                            echo mysql_error();
                            while($rs=  mysql_fetch_array($result))
                            {
                                echo '<li class=divider></li><li class="btn btn-info nav-tabs nav-justified" '
                                . 'onclick="listacomponenentes('.$rs["idcomponente"].');" >'.$rs["descrcomponente"].'</li>';
                            }
                            ?>
                        </ul>
                    </li>
                    
            </ul>
        </div>
    </div>
</nav>

