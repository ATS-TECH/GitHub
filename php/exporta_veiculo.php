<?php 
include 'mysql.php';
$queryrs = "SELECT placa_veiculo,registro_veiculo, marca, modelo_veiculo, km_veiculo," 
                    ."(select count(*)  from eixo_veiculo "
                    ." where veiculo.chip_veiculo=eixo_veiculo.chip_veiculo "
                    ."   and ideixo_veiculo>0) qtdeixos  ," 
                    ."(select sum(qtdrodas) from eixo_veiculo "
                    . "where veiculo.chip_veiculo=eixo_veiculo.chip_veiculo ) qtdrodas, "
                    ."(select count(*) from pneu where veiculo.chip_veiculo= numero_chip_veiculo) qtdpneus "
                    ." FROM veiculo "
                . " where idpessoa=".$_REQUEST["idpessoa"]
                . " order by placa_veiculo, modelo_veiculo";
$conta=0;

$salva=$queryrs;
$resultado = mysql_query($queryrs);
echo mysql_error();

include 'gerablob.php';

