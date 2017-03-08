<?php 
include 'mysql.php';
$queryrs = "SELECT numero_serie, pneu.marca, pneu.medida,pneu.modelo,banda,vida,"
        . "eixo,roda,registro_veiculo, placa_veiculo  FROM pneu, veiculo "
                . ' where pneu.idpessoa='.$_REQUEST['idpessoa'] 
                .  ' and numero_chip_veiculo = chip_veiculo'
                   ." order by numero_serie";
$conta=0;

$salva=$queryrs;
$resultado = mysql_query($queryrs);

echo mysql_error();

include 'gerablob.php';

