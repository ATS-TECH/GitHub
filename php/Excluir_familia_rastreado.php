<?php
 
$idrastreado = $_REQUEST["idrastreado"];
$idcomponente=$_REQUEST["idcomponente"];
$idpessoa=$_REQUEST["idpessoa"];
include 'mysql.php';

$cmd = "delete from familia_rastreado "
        . " where idrastreado=".$idrastreado." "
        . " and idcomponente = ".$idcomponente." and idpessoa=".$idpessoa;
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Família excluída com sucesso.";
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);

?>