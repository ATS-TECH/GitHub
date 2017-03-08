<?php
 
$idplano=$_REQUEST["idplano"];
$idveiculo=$_REQUEST["idveiculo"];
$idusuario=$_REQUEST["idusuario"];
$ressalva=$_REQUEST["ressalva"];
$kmveiculo=$_REQUEST["kmveiculo"];
$iditem=$_REQUEST["iditem"];
$idpessoa=$_REQUEST["idpessoa"];
$valor=$_REQUEST["valor"];
include 'mysql.php';
if($ressalva==="")
{
    $ressalva="-";
}
$cmd = "INSERT INTO veiculo_manutencao(idpessoa,idplano_manutencao,iditem_manutencao,chip_veiculo,"
        ."idusuario,dataregistro,kmregistro,ressalvas,valor_custo)VALUES("
        .$idpessoa.",".$idplano.",".$iditem.",'".$idveiculo."',".$idusuario.",now(),".$kmveiculo.",'".$ressalva."','".$valor."' )";
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Manutenção registrada com sucesso.";
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);

?>