<?php
$idpessoa = $_REQUEST["idpessoa"];
$idveiculo= $_REQUEST["idveiculo"];
$idplano= $_REQUEST["idplano"];
 
include 'mysql.php'; 

//USUÁRIO e CHIP são iguais !!!!!!
$cmd1="delete from veiculo_plano   "
        . " where chip_veiculo='".$idveiculo."'"
        . " and idplano_manutencao=".$idplano." and idpessoa in (".$idpessoa.") ";
    

mysql_query($cmd1);
 
echo mysql_error();
if(mysql_error()!="")
{
    $response["success"] = 0;
    $response["message"] = "Problemas na dissociação do plano: ".mysql_error();
}
else { 
        $response["success"] = 0;
        $response["message"] = "Plano dissociado com sucesso.";
    }
echo json_encode($response);
?>