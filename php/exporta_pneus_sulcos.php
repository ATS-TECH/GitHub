<?php 
include 'mysql.php';
$queryrs ="select medida.numero_chip, numero_serie, DATE_FORMAT(datamedida,'%Y-%m-%d') datamedida, avg(medida.medida) media_sulcos, "
                ."pneu.marca, pneu.medida,pneu.modelo,banda,vida,"
                . "eixo,roda,registro_veiculo, placa_veiculo"
            . " from pneu, medida, veiculo "
            . " where pneu.numero_chip=medida.numero_chip"
            .  ' and numero_chip_veiculo = chip_veiculo'
            . " and pneu.idpessoa=".$_REQUEST["idpessoa"]  
            . " group by numero_chip, numero_serie, datamedida  "
                 ." order by numero_serie";
       
$salva=$queryrs;
$resultado = mysql_query($queryrs);
 
echo mysql_error();

include 'gerablob.php';

