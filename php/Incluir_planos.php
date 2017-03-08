<?php
 
$chip = $_REQUEST["chip"];
$nomeplano=$_REQUEST["nomeplano"];
$idpessoa=$_REQUEST["idpessoa"];
$idusuario=$_REQUEST["idusuario"];
$manda=$_REQUEST["manda"];

if(!isset($manda)||$manda==="")
{
    $manda="N";
}
include 'mysql.php';
$cmd="select max(idplano_manutencao)idplano from plano_manutencao where idpessoa in ('".$idpessoa."')";
$result = mysql_query($cmd);
$idplano=0;
while($rs=  mysql_fetch_array($result))
{
    $idplano=$rs["idplano"];
}
$idplano++;
$cmd = "INSERT INTO plano_manutencao(idplano_manutencao,idpessoa,nome_plano,data_criacao,usuario_criacao,mandatorio)"
        . "VALUES(".$idplano.",".$idpessoa.",'".$nomeplano."',now(),".$idusuario.",'".$manda."')";
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Plano registrado com sucesso.";
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);

?>