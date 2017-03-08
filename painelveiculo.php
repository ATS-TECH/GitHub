 
<?php
$numero_chip = $_REQUEST["numero_chip"];
$idpessoa = $_REQUEST["idpessoa"];
$idrastreado = $_REQUEST["idrastreado"];
$param='?idpessoa='.$idpessoa.'&numero_chip='.$numero_chip.'&idrastreado='.$idrastreado; 
$link1='php/detalhe_veiculo.php'.$param;
$link2='php/graph_KM.php'.$param;
$link3='php/graph_veiculo_pneus_mm.php'.$param;
$link4='php/graph_pneus_veiculo.php'.$param;
$link5='php/graph_veiculo_componentes.php'.$param;
$link6='php/componente_veiculo.php'.$param;
$link7='php/plantapneus.php'.$param;
$link8='php/listacompveiculo.php'.$param;
$link9="php/query_compo.php?idpessoa=".$idpessoa."&chip_veiculo=".$numero_chip;
$link10="php/planos_veiculo.php?idpessoa=".$idpessoa."&chip_veiculo=".$numero_chip;
$link11="php/graph_veiculo_custo.php?idpessoa=".$idpessoa."&chip_veiculo=".$numero_chip;
 
include 'php/mysql.php';
$idusuario=$_REQUEST["idusuario"];

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
 $cmd = "select * from veiculo where chip_veiculo in ('".$numero_chip. "') "
         . " and idpessoa =".$idpessoa;
    
     
    $res = mysql_query($cmd);
    echo mysql_error();
    while($rs = mysql_fetch_array($res))
    {
        $numchip=$rs["chip_veiculo"]; 
        $idpessoa=$rs["idpessoa"]; 
        $registro=$rs["registro_veiculo"];
        $marca= $rs["marca"];
        $modelo_veiculo = $rs["modelo_veiculo"];
        $cor_veiculo=$rs["cor_veiculo"];
        $ano_veiculo=$rs["ano_veiculo"];
        $ano_modelo=$rs["ano_modelo_veiculo"];
        $qtdeixos= $rs["qtdeixos"];
        $km_veiculo=$rs["km_veiculo"];
        $hora_veiculo=$rs["hora_veiculo"];
        $placa_veiculo=$rs["placa_veiculo"];
    }
    ?>
       
<input type=hidden value="<?php echo $numchip; ?>" id=idveiculo name=idveiculo/>
<input type=hidden value="<?php echo $km_veiculo; ?>" id=kmveiculo name=kmveiculo/>
<div style="width: 100%;height: 3px;background-color: #CACACA;"></div>
<nav class="navbar navbar-default " style='padding:10px;'>
<!--    <div class="container-fluid">
        <ul class="nav navbar-nav pull-right">
        <li class="navbar-header">-->
            <span class="pull-left navbar-text" >
                <?php echo "<strong>".$registro." "."</strong>Placa: ".$placa_veiculo
                    ."<br>".$marca." - ".$modelo_veiculo
                    ." - ".$cor_veiculo."<br>".number_format($km_veiculo,0,"",".")." KM";?>
            </span>
<!--        </li>-->
        
        <!--<li class="" style='margin-right:20px;'>-->
            <a class="dropdown pull-right dropdown-toggle" data-toggle="dropdown" href="#" style='margin:20px;'>
                <label class="text-info pull-right" style="font-size: 12px;">
                    <i class="fa fa-caret-square-o-down size-14"  ></i><span style="padding-left: 2px;">Serviços
                </label>
            </a>

                <ul class="dropdown-menu text-center pull-right" style='font-size: 11px;letter-spacing: 1px;padding: 3px;margin-right: 20px;'>
                    <?php if($adm_portaria==="S")
                    {?>
                    <li role="presentation"  style="width: 100%;"
                        class="btn btn-info nav-tabs nav-justified" 
                        onclick="novoresumo('<?php echo $link9;?>','veiculo');">
                            Inspecionar
                    </li><li class="divider"></li>
                    <?php }?>
                    <?php if($adm_veiculo==="S")
                    {?>
                    <li role="presentation"  style="width: 100%;"
                       class="btn btn-info nav-tabs nav-justified"
                      onclick="novoresumo('<?php echo $link10;?>','menu');">Manutenção
                    </li><li class="divider">
                    <?php }?>
                    <?php if($adm_rastreado==="S")
                    {?>
                    <li role="presentation"  style="width: 100%;"
                       class="btn btn-info nav-tabs nav-justified"
                      onclick="novoresumo('<?php echo $link11;?>','veicframe');">Custo de <br>Manutenção
                    </li><li class="divider">
                    <?php }?>
                    <?php if($adm_veiculo==="S")
                    {?>
                    <li role="presentation" style="width: 100%;" class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link1;?>','veiculo');" >
                            Detalhes
                    </li><li class="divider"></li>
                    <li role="presentation" style="width: 100%;" class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link8;?>','veiculo');" >
                            Instalados
                    </li><li class="divider"></li>
                    <li role="presentation" style="width: 100%;" class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link7;?>','veiculo');" >
                            Planta de pneus
                    </li><li class="divider"></li>
                    <li role="presentation" style="width: 100%;" class="btn btn-info nav-tabs nav-justified" 
                        onclick="novoresumo('<?php echo $link2;?>','veicframe');" >
                            KM do veículo
                    </li><li class="divider"></li>
                    <li role="presentation" style="width: 100%;" class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link3;?>','veicframe');" >
                            Consumo das bandas
                    </li><li class="divider"></li>
                    <li role="presentation" style="width: 100%;" class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link4;?>','veicframe');" >
                            Detalhes dos pneus
                    </li><li class="divider"></li>
                    <li role="presentation" style="width: 100%;" class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link5;?>','veicframe');" >
                            Componentes

                    </li>
                    <?php }?>
                    
                </ul>
<!--            </li>
        </ul>  

    </div>-->
<!--    <div id="drop1" class="pull-left"></div>
    <div id="drop2" class="pull-left"></div>-->
</nav>
<fieldset class="bg-5" id="tabkm">
   
        <!--<label class="pull-left" for="kmveiculo">Atualize o KM</label>-->
        <input type="text" id="kmveiculotxt" name="kmveiculo" class="form-group-lg pull-left" style="color:black;margin:1rem;padding:10px;width:250px;"
                       value="<?php echo number_format($km_veiculo,0,"","."); ?>"   />
        <button type="button" class="btn btn-primary pull-left" onclick="gravakm();">GRAVAR KM</button>   
    
</fieldset>