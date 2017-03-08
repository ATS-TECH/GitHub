<?php
$idcomponente = $_REQUEST["idcomponente"];
$chip = $_REQUEST["chip"];
$chipcomp = $_REQUEST["chipcomp"];
$numserie = $_REQUEST["numserie"];
$km = $_REQUEST["km"];
$status = $_REQUEST["status"];
include 'php/mysql.php'; 

$result = mysql_query("INSERT INTO componente_inspecao"
."(idcomponente,chip_veiculo,numero_chip,numero_serie,data_inspecao,kmveiculo,horaveiculo,status)VALUES("
."'".$idcomponente."','".$chip."','".$chipcomp."','".$numserie."',now(),'".$km."','0','".$status."')");

echo mysql_error();
if(mysql_error()!="")
{
    $response["success"] = 0;
    $response["message"] = "Problemas na gravação: ".mysql_error();
}
else {
    // successfully inserted into database
    $response["success"] = 1;
    $response["message"] = "Veículo inspecionado com sucesso.";

    // echoing JSON response
    
} 
echo json_encode($response);
?>