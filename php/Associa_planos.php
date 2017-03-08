<?php
$idusuario = $_REQUEST["idusuario"]; 
$idveiculo = $_REQUEST["idveiculo"];
$idplano=$_REQUEST["idplano"];
$idpessoa=$_REQUEST["idpessoa"];
include 'mysql.php';

$cmd = "INSERT INTO veiculo_plano(idpessoa,idplano_manutencao,chip_veiculo,idusuario,dataregistro )VALUES("
        .$idpessoa.",".$idplano.",'".$idveiculo."','".$idusuario."',now())";
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Plano associado com sucesso.";
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);

?>