<?php
include 'mysql.php';
echo '<input type=hidden id=idrastreado value=1 />'
. '<input type=hidden id="chip_rastreado" value='.$_REQUEST['numero_chip'].' />';
$cmd= "select componente.idcomponente, descrComponente,ispneu, componente_almox.numero_chip, componente_almox.numero_serie   "
        . " from componente, componente_almox, componente_veiculo "
        . " where componente.idcomponente = componente_veiculo.idcomponente "
        . " and componente_veiculo.numero_chip = componente_almox.numero_chip"
        . " and componente.idpessoa in ('".$_REQUEST['idpessoa']."')"
        . " and  componente_veiculo.chip_veiculo='".$_REQUEST['numero_chip']."'"
        . " and data_baixa is null "
        . " and data_montagem is not null "
        . " and componente_almox.idpessoa=".$_REQUEST['idpessoa'];
$cmd=  mysql_query($cmd);
echo mysql_error();
echo '<div id=execmanu></div><div class="container-fluid">';
while($rs=mysql_fetch_array($cmd))
{
    $numero_chip=$rs["numero_chip"];
    $numero_serie=$rs["numero_serie"];
    $link='mostracompveiculo('.$rs["idcomponente"].",'".$rs["numero_chip"]."');";
    echo '<div class="col-sm-3">'
            . '<div class="btn btn-info" onclick="'.$link.'" style="margin:1rem;" >'
                   . ' '.$rs["descrComponente"]
                    . '<br>'.$rs["numero_serie"]
            .'</div>'
        . '</div>';
    
}
echo '</div>';

?>
<button type="button" class="btn btn-primary" 
        onclick="novocomponenterastreado();"  >MONTAR COMPONENTE</button>
