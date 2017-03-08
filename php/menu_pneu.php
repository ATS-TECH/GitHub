<?php
include 'mysql.php';
$numchip = $_REQUEST["numero_chip"];
$plataforma = $_REQUEST["plataforma"];
$idpessoa=$_REQUEST["idpessoa"];

// SERVIÇO 
  
$link1="php/detalhepneu.php?numero_chip=".$numchip; 
$link2="php/graph_pneu_mm.php?numero_chip=".$numchip;
$link3="php/graph_pressao.php?numero_chip=".$numchip;

$link5="php/resumo_pneu_falhas.php?numero_chip=".$numchip;
$link6="php/resumo_pneu_mm.php?numero_chip=".$numchip;
$linkh="'php/resumo_pneu_hist.php?numero_chip=".$numchip."'";
if(isset($plataforma)&&$plataforma!=='')
{
    $link8="php/medir_pneu.php?numero_chip=".$numchip;
    $link4="'php/graph_pressao_relogio.php?numero_chip=".$numchip."','pneuframe'";
}
else
{
    $link8="php/medir_pneu_manual.php?numero_chip=".$numchip;
    $link4="'php/graph_pressao_relogio_manual.php?numero_chip=".$numchip."','pneu'";
}



$cmd = "SELECT * from pneu where idpessoa=".$idpessoa." and numero_chip in ('".$numchip."')";  

$cmd=  mysql_query($cmd);
echo mysql_error();
while($rs=  mysql_fetch_array($cmd))
{
      $marca=$rs["marca"];
      $modelo=$rs["modelo"];
      $medida=$rs["medida"];
      $numserie=$rs["numero_serie"];
      $numchip=$rs["numero_chip"];
      $vida=$rs["vida"];
      $banda=$rs["banda"];
      $eixo=$rs["eixo"];
      $roda=$rs["roda"];
}

?>
<input type=hidden value="<?php echo $_REQUEST["idcomponente"]; ?>" id=idcomponente name=idcomponente/>   
<input type=hidden value="" id=idveiculo name=idveiculo/>
<input type=hidden value="<?php echo $numchip; ?>" id=idpneu name=idpneu/>
<nav class="navbar navbar-default ">
    <div class='container-fluid' style='padding:10px;'>
        <span class="navbar-text pull-left" >
            <?php echo "<strong>".$numserie."</strong><br>".$medida."<br>".$marca." / ".$modelo;?></span> 
        <a class="dropdown pull-right dropdown-toggle" data-toggle="dropdown" href="#" style='margin: 20px;'>
            <label class="text-info pull-right" style="font-size: 12px;">
             <i class="fa fa-caret-square-o-down size-14"  ></i><span style="padding-left: 2px;">Manutenção</span>
            </label>
        </a>
    
        <ul class="dropdown-menu pull-right" style='font-size: 11px;letter-spacing: 1px;padding: 3px;margin-right: 20px;' role="menu">
                <li role="menu" class="btn btn-info nav-tabs nav-justified " style="width: 100%;"
                 onclick="novoresumo('<?php echo $link1;?>','pneu');">
                 Detalhes do pneu
             </li><li class=divider></li>
             <li role="presentation"  style="width: 100%;"
                 class="btn btn-info nav-tabs nav-justified" onclick="desmontapneu('<?php echo $numchip;?>','pneu');">
                 Desmontar
             </li>
             <li class=divider></li>
             <li role="presentation"  style="width: 100%;"
                 class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link5;?>','pneu');">
                 Registro de falhas<br>
             </li>
             <li class=divider></li>
              <li role="presentation"  style="width: 100%;"
                 class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link8;?>','pneu');">
                 Medir sulcos
             </li><li class=divider></li>
             <li role="presentation"  style="width: 100%;"
                 class="btn btn-info nav-tabs nav-justified" onclick="novoresumo(<?php echo $link4;?>);">
                 Medir Pressão
             <li class="divider"></li>
             <li role="presentation"  
                 class="btn btn-info nav-tabs nav-justified" style="width: 100%;"
                 onclick="menuresumo(<?php echo $linkh;?>,'areahist');">
                 Histórico do pneu</li>
             </li><li class=divider></li>

             <li role="presentation"  style="width: 100%;"
                 class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link3;?>','pneuframe');">
                 Resumo da Pressão
             </li><li class=divider></li>
             <li role="presentation"  style="width: 100%;"
                 class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link2;?>','pneuframe');">
                 Gráfico de sulcos
             </li><li class=divider></li>

             <li role="presentation"  style="width: 100%;"
                 class="btn btn-info nav-tabs nav-justified" onclick="novoresumo('<?php echo $link6;?>','pneu');">
                 Resumo de medidas<br> dos sulcos
             </li>

         </ul>
        </div>
</nav>

<div class="container-fluid" id="tabpneu"></div>
<div class="container-fluid" id="tabhist"></div>
<div class="container-fluid bg-3" id="areahist"></div>

    <script src="js/jquery.js" type="text/javascript"></script>
     
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>



    