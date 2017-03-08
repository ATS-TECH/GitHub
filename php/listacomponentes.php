<?php
include 'mysql.php';
$cmd= "select * from  componente" 
    . " where componente.idcomponente=".$_REQUEST['idcomponente']
    . " and componente.idpessoa in ('".$_REQUEST['idpessoa']."')";
$idcomponente = $_REQUEST["idcomponente"];
echo '<input type=hidden id=idpneu value="" />'; 
$link1="novocompalmox($idcomponente);";
$cmd=  mysql_query($cmd);
echo mysql_error();
while($rs=mysql_fetch_array($cmd))
{
    $descrComponente=$rs["descrComponente"];
    $ispneu=$rs["ispneu"];
}
echo  '<input id=idcomponentealmox value="'.$_REQUEST['idcomponente'].'" type=hidden />';

$indveiculo="N";
$link='mostracompalmox('.$idcomponente.');';
 
echo '<div id=execmanu></div><div class=container-fluid><div class=divider></div>';
$cmd= "select numero_chip, numero_serie from componente_almox "
        . " where componente_almox.idcomponente=".$_REQUEST['idcomponente']
        . " and data_baixa is null "
        . " and data_montagem is null "
        . " and componente_almox.idpessoa=".$_REQUEST['idpessoa'].' order by numero_serie';
$cmd=  mysql_query($cmd);
echo mysql_error();
while($rs=mysql_fetch_array($cmd))
{
    $numero_chip=$rs["numero_chip"];
    $numero_serie=$rs["numero_serie"];
    echo '<div class="btn btn-info" style="margin: 1rem;padding:1rem;font-size:12px" ' 
            . ' onclick="mostracompalmox('."'".$rs["numero_chip"]."'".');" style="margin:auto;"  >'
                    . ' '.$descrComponente 
                    . '<br>'
                    .$numero_serie 
                .'</div>';
   
}
echo '</div> ';
?>
<button type="button" class="btn btn-primary" 
        onclick="novocompalmox(<?php echo $idcomponente;?>);"  >INSERIR <?php echo $descrComponente; ?></button>
