<?php
 
$idpessoa=$_REQUEST["idpessoa"];
$idcomponente=$_REQUEST["idcomponente"];
$nomecomponente=$_REQUEST["nomecomponente"];
$cindpneu=$_REQUEST["cindpneu"];
include 'mysql.php';
$idcomponente=0;
$cmd="select max(idcomponente) idcomponente from componente where idpessoa in ('".$idpessoa."')";
$result = mysql_query($cmd);
while($rs=  mysql_fetch_array($result))
{
    $idcomponente=$rs["idcomponente"];
}
$idcomponente++;
$cmd = "INSERT INTO componente(idcomponente,descrComponente,ispneu,idpessoa)"
        . "VALUES(".$idcomponente.",'".$nomecomponente."','".$cindpneu."',".$idpessoa.")";
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