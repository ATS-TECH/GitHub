<?php
include 'mysql.php';
$idusuario=$_REQUEST["idusuario"];
$idplano=$_REQUEST["idplano"];
$todokm=$_REQUEST["todokm"];
$tododia=$_REQUEST["tododia"];
$limitekm=$_REQUEST["limitekm"];
$alertakm=$_REQUEST["alertakm"];
$limitedia=$_REQUEST["limitedia"];
$alertadia=$_REQUEST["alertadia"];
$idpessoa=$_REQUEST['idpessoa'];
$nomeitem=$_REQUEST["nomeitem"];
$valor_item=$_REQUEST["valor_item"];
if($tododia=="N"&&$todokm=="N")
{
    $response["success"] = 0;
    $response["message"] = "Defina pelo menos um critério de alerta";
    echo json_encode($response);
    return;
}
if($tododia=="S"&&($limitedia==""||$limitedia==0))
{
    $response["success"] = 0;
    $response["message"] = "Informe a quantidade de dias de limite";
    echo json_encode($response);
    return; 
}
if($todokm=="S"&&($limitekm==""||$limitekm==0))
{
    $response["success"] = 0;
    $response["message"] = "Informe a quilometragem de limite";
    echo json_encode($response);
    return; 
}
if($valor_item=="")
{
    $valor_item=0;
}
$cmd="select max(iditem_manutencao) iditem_manutencao from item_manutencao where idpessoa=".$idpessoa." and idplano_manutencao in ('".$idplano."')";
$result = mysql_query($cmd);
echo mysql_error();
$iditem_manutencao=0;
while($rs=  mysql_fetch_array($result))
{
    $iditem_manutencao=$rs["iditem_manutencao"];
}
$iditem_manutencao++;
$cmd = "INSERT INTO item_manutencao(idpessoa,idplano_manutencao,iditem_manutencao,nome_item,"
        ."ind_km,limite_km,alerta_km,ind_periodo,limite_dias,alerta_dias,valor_item,status)VALUES("
        .$idpessoa.",".
        $idplano.",".
        $iditem_manutencao.",'".
        $nomeitem."','".
        $todokm."',".
        $limitekm.",".
        $alertakm.",'".
        $tododia."',".
        $limitedia.",".
        $alertadia.",".
        $valor_item.",'A')";

$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Item criado com sucesso.";
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}

 echo json_encode($response);
?>