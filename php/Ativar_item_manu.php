<?php
include 'mysql.php';

$idplano=$_REQUEST["idplano"];
$iditem=$_REQUEST['iditem'];
$idpessoa=$_REQUEST['idpessoa'];


$cmd="update item_manutencao set status ='A' where idpessoa=".$idpessoa
        ." and iditem_manutencao=".$iditem
        ."  and idplano_manutencao in ('".$idplano."')";
$result = mysql_query($cmd);
echo mysql_error();

if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Item excluído com sucesso.";
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}

 echo json_encode($response);
?>