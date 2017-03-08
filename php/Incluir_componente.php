<?php
 
$numero_serie = $_REQUEST["numero_serie"];
$numero_chip=$_REQUEST["numero_chip"];
$idpessoa=$_REQUEST["idpessoa"];
$idcomponente=$_REQUEST["idcomponente"];
$valor=$_REQUEST["valor"];
include 'mysql.php';

$cmd = "INSERT INTO componente_almox(idcomponente,numero_chip,numero_serie,data_registro,idpessoa,valor_unitario"
        . ")VALUES(".$idcomponente.",'".$numero_chip."','".$numero_serie."',now(),".$idpessoa.",".$valor.")";
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Componente Incluído com sucesso.";
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);

?>