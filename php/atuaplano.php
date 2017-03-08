<?php
$idpessoa = $_REQUEST["idpessoa"];
$nomeplano= $_REQUEST["nomeplano"];
$idplano= $_REQUEST["idplano"];
$manda= $_REQUEST["manda"];
 
include 'mysql.php'; 

//USUÁRIO e CHIP são iguais !!!!!!
$cmd1="update plano_manutencao set   "
        . "nome_plano='".$nomeplano."',"
        . "mandatorio='".$manda."'"
        . " where idplano_manutencao=".$idplano." and idpessoa in (".$idpessoa.") ";
    

mysql_query($cmd1);
 
echo mysql_error();
if(mysql_error()!="")
{
    $response["success"] = 0;
    $response["message"] = "Problemas na atualização da família: ".mysql_error();
}
else { 
        $response["success"] = 0;
        $response["message"] = "Família atualizada com sucesso.";
    }
echo json_encode($response);
?>