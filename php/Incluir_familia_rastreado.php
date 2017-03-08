<?php
 
$idrastreado = $_REQUEST["idrastreado"];
$idcomponente=$_REQUEST["idcomponente"];
$idpessoa=$_REQUEST["idpessoa"];
include 'mysql.php';

$cmd = "INSERT INTO familia_rastreado(idrastreado,idcomponente,idpessoa)VALUES(".$idrastreado.",".$idcomponente.",".$idpessoa.")";
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Família registrada com sucesso.";
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);

?>