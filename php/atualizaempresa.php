<?php
$razao_social= $_REQUEST["razao_social"];
$cnpj= $_REQUEST["cnpj"];
$email=$_REQUEST["email"]; 
$telefone = $_REQUEST["telefone"];
$idpessoa = $_REQUEST["idpessoa"];
include 'mysql.php'; 
$vertag=0;

        
$cmd= "update pessoa_juridica set razao_social='$razao_social',"
        . " cnpj='".$cnpj."',"
        . " email='".$email."',"
        . " telefone='".$telefone."'"
        . " where idpessoa=".$idpessoa;       
$result = mysql_query($cmd);

if(mysql_error()!= null)
{
    $response["success"] = 0;
    $response["message"] =  mysql_error().$cmd;
}
else
{
    $response["success"] = 1;
    $response["message"] = "ATUALIZADO DOM SUCESSO.";
}
// echoing JSON response
echo json_encode($response);
 
