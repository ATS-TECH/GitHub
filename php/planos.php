<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
          
    </head>
<body>
<input type="hidden" id="idplano" />
<!--<div class="container">-->
    <nav class="navbar navbar-default" style='font-size: 11px;letter-spacing: 1px;padding: 20px;'>

       <ul class="nav navbar-nav">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <label class="text-info pull-right" style="font-size: 12px;">
                    <i class="fa fa-caret-square-o-down size-14"  ></i><span style="padding-left: 2px;">Planos</span>
                    </label>
                </a>

                <ul class="dropdown-menu" style='font-size: 11px;letter-spacing: 1px;padding: 3px;'>
                                    

                    <?php
                    include 'mysql.php';
                    $cmd="select * from plano_manutencao where idpessoa in ('".$_REQUEST["idpessoa"]."')";
                    $result=  mysql_query($cmd);
                    while($rs=  mysql_fetch_array($result))
                    {
                        echo '<li width=100% class="btn btn-info nav-tabs nav-justified" onclick="abreplano('.$rs["idplano_manutencao"].' );" >'.$rs["nome_plano"].'</li>'
                                . '<li class="divider"></li>';
                    }
                    ?>
                </ul>
    </nav>
<!--</div>-->
    
</body>
</html>
