<?php
include 'mysql.php';
$usuario=$_REQUEST["usuario"];
$senha=$_REQUEST["senha"];

$cmd = "SELECT idusuario, chip, idpessoa, senha  from usuario"
     ."  where usuario='".$usuario."'";
 
$idusuario=0;
$pessoa=array();
$result=  mysql_query($cmd);
echo mysql_error();
while ($row = mysql_fetch_array($result)) 
{
    $idusuario=$row["idusuario"];
    $chip=$row["chip"];
    $idpessoa=$row["idpessoa"];
    $senhabanco=$row["senha"];
    
    $cmdup = "SELECT idusuario, adm_almox, adm_portaria, adm_veiculo, adm_usuario, adm_rastreado, gestor from usuario_pessoa"
            ." where idusuario='".$idusuario."' and idpessoa='".$idpessoa."'";
    $resultup=  mysql_query($cmdup);
    echo mysql_error();
    while ($rowup = mysql_fetch_array($resultup)) 
    {
        $adm_almox=$rowup["adm_almox"];
        $adm_portaria=$rowup["adm_portaria"];
        $adm_veiculo=$rowup["adm_veiculo"];
        $adm_usuario=$rowup["adm_usuario"];
        $adm_rastreado=$rowup["adm_rastreado"];
        $idusuario=$rowup["idusuario"];
        $gestor=$rowup["gestor"];
    }
    
    $cmdp = "SELECT razao_social from pessoa_juridica"
     ."  where idpessoa =".$idpessoa;
    $resultp=  mysql_query($cmdp);
    echo mysql_error();
    while ($rowp = mysql_fetch_array($resultp)) 
    {
        $razao_social=$rowp["razao_social"];
    }
}
if($idusuario>0)
{
    if($senha!=$senhabanco)
    {
        $response["success"] = 0;
        $response["message"] = "Senha inválida";
    }
    else 
    {
        $response["success"] = 1;
        $response["message"] = "OK";
        $response["idusuario"]=$idusuario;
        $response["idpessoa"]=$idpessoa;
        $response["razao_social"]=$razao_social;
        $response["adm_almox"]=$adm_almox;
        $response["adm_portaria"]=$adm_portaria;
        $response["adm_rastreado"]=$adm_rastreado;
        $response["adm_usuario"]=$adm_usuario;
        $response["adm_veiculo"]=$adm_veiculo;
        $response["gestor"]=$gestor;
     }
}
else
{        
    $response["success"] = 0;
    $response["message"] = "Usuário inexistente"; 
}
echo json_encode($response);