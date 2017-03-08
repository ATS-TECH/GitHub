<?php
 
$chip = $_REQUEST["chip"];
$idfalha=$_REQUEST["idfalha"];
$idpessoa=$_REQUEST["idpessoa"];
include 'mysql.php';

$cmd = "delete from falhas_pneu where idfalhas_pneu=".$idfalha
        ." and numero_chip='".$chip."' and idpessoa in (".$idpessoa.")";
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Falha excluida com sucesso.";
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);

?>