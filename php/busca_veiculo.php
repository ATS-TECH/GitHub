<?php
include 'mysql.php';
$chip = $_REQUEST["chip"];
if($chip==null)
{
    $cmd="select `veiculo`.`chip_veiculo`,"
        . " `veiculo`.`placa_veiculo`,"
        . " `veiculo`.`marca`,"
        . " `veiculo`.`modelo_veiculo`,"
        . " `veiculo`.`ano_veiculo`,"
        . " `veiculo`.`cor_veiculo`,"
        . " `veiculo`.`ano_modelo_veiculo`,"
        . " `veiculo`.`registro_veiculo`,"
        . " `veiculo`.`qtdeixos`,"
        . " `veiculo`.`km_veiculo`,"
        . " `veiculo`.`hora_veiculo` "
        . "from veiculo";
}
else
{
    $cmd = "select `veiculo`.`chip_veiculo`,"
        . " `veiculo`.`placa_veiculo`,"
        . " `veiculo`.`marca`,"
        . " `veiculo`.`modelo_veiculo`,"
        . " `veiculo`.`ano_veiculo`,"
        . " `veiculo`.`cor_veiculo`,"
        . " `veiculo`.`ano_modelo_veiculo`,"
        . " `veiculo`.`registro_veiculo`,"
        . " `veiculo`.`qtdeixos`,"
        . " `veiculo`.`km_veiculo`,"
        . " `veiculo`.`hora_veiculo` "
        . "from veiculo where chip_veiculo=".$chip;
}

$qtditens=11;

include "enviamsg.php";

echo mysql_error();
?>
