<?php
 
$chip = $_REQUEST["chip"];
$idfalha=$_REQUEST["idfalha"];
$idpessoa=$_REQUEST["idpessoa"];
include 'mysql.php';

$cmd = "INSERT INTO falhas_pneu(idfalhas_pneu,numero_chip,dataregistro, idpessoa)VALUES(".$idfalha.",'".$chip."',now(),".$idpessoa.")";
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Falha registrada com sucesso.";
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);

?>