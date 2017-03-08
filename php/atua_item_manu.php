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
$iditem_manutencao=$_REQUEST["iditem"];
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

$cmd = "update item_manutencao set ".
        " nome_item='".$nomeitem."',".
        " ind_km='".$todokm."',".
        " limite_km=".$limitekm.",".
        " alerta_km=".$alertakm.",".
        " ind_periodo='".$tododia."',".
        " limite_dias=".$limitedia.",".
        " alerta_dias=".$alertadia.",".
        " valor_item='".$valor_item."'"
        ." where idpessoa=".$idpessoa
        ." and iditem_manutencao=".$iditem_manutencao
        ." and idplano_manutencao in ('".$idplano."')";

$result = mysql_query($cmd);
if(mysql_error()== null&&  mysql_affected_rows()>0)
{
    $response["success"] = 1;
    $response["message"] = "Item atualizado com sucesso.";
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}

 echo json_encode($response);
?>