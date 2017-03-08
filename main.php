<body >
    <!-- Navbar -->
<?php
include 'php/mysql.php';
$idusuario=$_REQUEST["idusuario"];
$idpessoa=$_REQUEST["idpessoa"];
$cmd = "SELECT idusuario,gestor,adm_veiculo,adm_almox,adm_portaria,adm_usuario,adm_rastreado
FROM usuario_pessoa  where idpessoa=".$idpessoa." and idusuario in ('".$idusuario."')";

$result=  mysql_query($cmd);
if(mysql_error()!="")
{
    echo mysql_error()."2".$cmd;
}
while ($row = mysql_fetch_array($result)) 
{
    $gestor=$row["gestor"];
    $adm_veiculo=$row["adm_veiculo"];
    $adm_almox=$row["adm_almox"];
    $adm_portaria=$row["adm_portaria"];
    $adm_usuario=$row["adm_usuario"];
    $adm_rastreado=$row["adm_rastreado"];
}
?>
<nav class="nav navbar navbar-default ">
<!--    <ul class="nav navbar-nav">-->
<!--        <li class="navbar-header">-->
        <img width="150rem" class="img-responsive pull-left" style="margin: 1rem;" src="images/logotruck.png" />
        <!--</li>-->
        <a  class=" pull-right home" style="cursor:pointer;margin: 1rem;" role="presentation" onclick="mainNav()" >
            <label class="text-info pull-right" style="font-size: 12px;margin:1rem;margin-right: 20px;">
                    <i class="fa fa-home size-14"  ></i><span style="padding-left: 2px;">HOME</span>
            </label> 
        </a>
    <!--</ul>--> 
    <div id="emparea"></div>
     
</nav>
    
<div class="container-fluid sidenav " id="myNavbar">
    <h4 class="text-center">Painel de Navegação</h4>
    <div class="container-fluid text-center" role="menu" >
        <?php if($adm_veiculo==="S"||$adm_rastreado==="S"||$adm_portaria==="S")
        {?>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle"
               role="button"  
               data-toggle="dropdown" href="#">Veículos
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" 
                style='cursor:pointer;font-size: 11px;letter-spacing: 1px;padding: 3px;width:270px;' 
                role="menu">
                <?php if($adm_veiculo==="S"||$adm_portaria==="S")
                {?>
                <li class="menu" >
                    <div class="btn btn-info nav-tabs nav-justified"
                         onclick="novoveiculo();" style="width: 48%;">
                        Inserir<br>Novo
                    </div>
                
                    <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                      onclick="pesq();" >
                        Busca<br>Veículo
                    </div>
                </li>
                <?php }  if($adm_rastreado==="S"){?>
                <li class="divider"></li>
                <li class="menu" >
                    <div class="btn btn-info nav-tabs nav-justified"
                         onclick="novoresumo('php/importa_veiculo.php?idpessoa=<?php echo $_REQUEST["idpessoa"] ?>','almox');" style="width: 48%;">
                        Importa<br>CSV
                    </div>
                
                    <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                      onclick="novoresumo('php/graph_custo.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veicframe');" >
                        Custo de<br>Manutenção
                    </div>
                </li>
                <li class="divider"></li>
                <li class="menu" >
                    <div class="btn btn-info nav-tabs nav-justified"
                         onclick="novoresumo('php/graph_resumo.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veiculo');" style="width: 48%;">
                        Frota<br>CSV
                    </div>
                
                    <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                      onclick="menuresumo('php/resumo_operacoes.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','areahist');" >
                        Resumo de<br>Operações
                    </div>
                </li>
                <li class="divider"></li>
                <li class="menu" >
                    <div class="btn btn-info nav-tabs nav-justified"
                          onclick="novoresumo('php/resumo_falhas.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veiculo');" style="width: 48%;">
                        Registros<br>de falhas
                    </div>
                
                    <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                      onclick="novoresumo('php/graph_medias_sulcos.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','iframe');" >
                        Desgaste de<br>Pneus
                    </div>
                </li>
                <?php }?>
            </ul>
        </div>
        <?php }?>
        <?php if($adm_veiculo==="S"||$adm_rastreado==="S")
                {?>
        <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle"
                   role="button" aria-expanded="false" data-toggle="dropdown">Pneus
                <span class="caret"></span>
                </button>

                <ul class="dropdown-menu text-center pull-right" 
                    style='font-size: 11px;letter-spacing: 1px;padding: 3px;width:270px;'>
                    <?php if($adm_veiculo==="S")
                    {?>
                    <li class="menu" >
                        <div class="btn btn-info nav-tabs nav-justified"
                              onclick="injeta('php/pesquisa_pneu.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','contgeral','pesqpneu','slide','contgeral');" style="width: 48%;">
                            Busca<br>de pneu
                        </div>

                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                          onclick="novoresumo('php/resumo_distrpneus.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veiculo');">
                            Distribuição<br>dos Pneus
                        </div>
                    </li>
                    <?php }?>
                    <?php if($adm_rastreado==="S")
                    {?>
                    <li class="divider"></li>
                    <li class="menu" >
                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                             onclick="novoresumo('php/resumo_inventario_pneus.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veiculo');" style="width: 48%;">
                            Inventário<br>de pneus(CSV)
                        </div>

                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                            onclick="novoresumo('php/importa_pneus.php?idpessoa=<?php echo $_REQUEST["idpessoa"] ?>','almox');">
                            Importa<br>Pneus(CSV)
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li class="menu" >
                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                            onclick="novoresumo('php/graph_pneus_medidas.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','iframe');">
                            Gráfico de<br>Medidas
                        </div>
                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                            onclick="novoresumo('php/graph_pneus_frota.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','iframe');">
                            Gráfico de<br>Marca / Modelo
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li class="menu" >
                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                              onclick="novoresumo('php/graph_pneus_bandas.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','iframe');">
                            Gráfico<br>por Bandas
                        </div>

                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                            onclick="novoresumo('php/resumo_geralpneus.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veiculo');">
                            Resumo por<br>Marca / Medida
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li class="menu" >
                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                              onclick="novoresumo('php/resumo_pneus.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veiculo');">
                            Resumo<br>Geral de pneus
                        </div>

                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                            onclick="novoresumo('php/resumo_sucata_pneus.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veiculo');">
                            Sucata<br>de pneus
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div>
        <?php }?>
        <?php if($adm_almox==="S"){?>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle"
                   role="button" aria-expanded="false" data-toggle="dropdown">Almoxarifado
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style='font-size: 11px;letter-spacing: 1px;padding:3ps;width:270px;' role="menu">
                    <li class="menu" >
                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                              onclick="novoresumo('php/almoxarifado.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','almox');">
                            Controle<br>de Estoque
                        </div>

                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                            onclick="novoresumo('php/resumo_inventario_almox.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','almox');">
                            Inventário de<br>Estoque
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li class="menu" >
                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                              onclick="novoresumo('php/graph_geral_componentes.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','iframe');">
                            Gráfico<br>de Componentes
                        </div>

                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                            onclick="novoresumo('php/resumo_inventario_almox.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','almox');">
                            Inventário de<br>Estoque
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li class="menu" >
                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                              onclick="novoresumo('php/resumo_sucata_pneus.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','almox');">
                            Sucata<br>de Pneus
                        </div>

                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                            onclick="novoresumo('php/novafamilia.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','almox');">
                            Nova Família<br> de Componentes
                        </div>
                    </li>                    
                    <li class="divider"></li>
                    <li class="menu" >
                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                            onclick="novoresumo('php/graph_data_registro.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','iframe');">
                            Registros<br> de pneus

                        </div>

                        <div class="btn btn-info nav-tabs nav-justified" style="width: 48%;"
                             onclick="novoresumo('php/graph_registro_vida.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','iframe');">
                            Registros<br> por vidas
                        </div>
                    </li>
                    
                </ul>
            </div>
        <?php } ?>
        <?php if($adm_rastreado==="S"){?>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle"
                   role="button" aria-expanded="false" data-toggle="dropdown">Manutenção
                    <span class="caret"></span>
                </button>
                    <ul class="dropdown-menu" style='font-size: 11px;letter-spacing: 1px'>
                       <li class="dropdown">
                            <li role="presentation" class=" btn btn-info nav-tabs nav-justified" 
                                onclick="planos();">Planos
                            </li>
                            <li class="divider"></li>
                            <li class=" btn btn-info nav-tabs nav-justified" 
                                onclick="novoresumo('php/novo_plano.php?nada=nada','veiculo' );" >
                                NOVO PLANO</li>
                    </ul>
            </div>
        
        
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle"
                   role="button" aria-expanded="false" data-toggle="dropdown">Exportações
                <span class="caret"></span>
                </button>

                <ul class="dropdown-menu" style='width:200px;font-size: 11px;letter-spacing: 1px'>
                    <li role="presentation"  
                           class=" btn btn-info nav-tabs nav-justified"  onclick="novoresumo('php/graph_resumo.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','iframe');">Exportação<br> de veículos</li>
                    <li class="divider"></li>
                    <li role="presentation"  
                           class=" btn btn-info nav-tabs nav-justified"  onclick="novoresumo('php/resumo_inventario_pneus.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veiculo');">Exportação<br> de pneus</li>
                    <li class="divider"></li>
                    <li role="presentation"  
                           class=" btn btn-info nav-tabs nav-justified"  onclick="novoresumo('php/resumo_medias_sulcos.php?idpessoa=<?php echo $_REQUEST["idpessoa"]; ?>','veiculo');">Exportação de<br> Média de Sulcos</li>

                </ul>
            </div>
        <?php } ?>
        <?php if($adm_usuario==="S"){?>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle"
                   role="button" aria-expanded="false" data-toggle="dropdown">Institucional
                <span class="caret"></span>
                </button>

                <ul class="dropdown-menu text-center" style='font-size: 11px;letter-spacing: 1px;padding: 3px;'>
                    <li  role="presentation" style="width: 100%;"  class=" btn btn-info nav-tabs nav-justified"  onclick="mostraempresa(<?php echo $_REQUEST["idpessoa"]; ?>);" >EMPRESA</li>                    
                    <li class="divider"></li>
                    <li  role="presentation" style="width: 100%;"  class=" btn btn-info nav-tabs nav-justified" onclick="montausu();"  >USUÁRIOS</li>
                </ul>
            </div>
        <?php } ?>
     </div>
</div>



<div class="container-high pull-left " id="restocont"> 
    <div id="contgeral" class="container-fluid"></div>
    <div class="container-fluid" id="tabmenu"></div> 
    <div class="container-fluid" id="page-wrapper">
        
    </div>
    
</div>
<div class="container-fluid" id="containermsg"></div>
<script src="js/jquery.js" type="text/javascript"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
