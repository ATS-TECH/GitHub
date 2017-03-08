<?php

$marca = $_REQUEST["marca"];  
$numero_serie= $_REQUEST["numero_serie"];
$medida = $_REQUEST["medida"];
$modelo = $_REQUEST["modelo"];
$vida = $_REQUEST["vida"];
$banda = $_REQUEST["banda"];
$chip = $_REQUEST["idveiculo"];
$eixo = $_REQUEST["eixo"];
$roda = $_REQUEST["roda"];
$idcomponente = 2;
$idpessoa=$_REQUEST['idpessoa'];
include 'mysql.php';
if($chip==""||$chip==null)
{
    $chip = $numero_serie;
}
$cmd = "Insert into componente_almox ( idcomponente, numero_chip,  numero_serie, data_registro, idpessoa) values"
        ."(".$idcomponente.",'".$chip."','".$numero_serie."',now(),".$idpessoa.")";
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $cmd = "Insert into pneu ( numero_chip, marca, medida, modelo, vida, banda, numero_serie, idpessoa,eixo, roda) values("
        ."'".$chip."','".$marca."','".$medida."','".$modelo."','".$vida."','".$banda."','".$numero_serie."',".$idpessoa.",".$eixo.",".$roda." )";

    $result = mysql_query($cmd);
    if(mysql_error()== null)
    {
        $response["success"] = 1;
        $response["message"] = "Pneu criado com sucesso.";
    } else {
        // required field is missing
        $response["success"] = 0;
        $response["message"] = $cmd. mysql_error();
    }
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}

 echo json_encode($response);
?>