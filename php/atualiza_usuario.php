
<?php
$idpessoa = $_REQUEST["idpessoa"];
$idusuariot=$_REQUEST["idusuariot"];
$usuario=$_REQUEST["usuario"];
$senha=$_REQUEST["senha"];
$email=$_REQUEST["email"];
$gestor=$_REQUEST["gestor"];
$admveiculo=$_REQUEST["admveiculo"];
$admalmox=$_REQUEST["admalmox"];
$admusuario=$_REQUEST["admusuario"];
$admrastreado=$_REQUEST["admrastreado"];
$admportaria=$_REQUEST["admportaria"];
$telefone=$_REQUEST["telefone"];
$nomeusuario=$_REQUEST["nomeusuario"];

include 'mysql.php'; 

//USUÁRIO e CHIP são iguais !!!!!!
$cmd1="update usuario set   "
        . "nomeusuario='".$nomeusuario."',"
        . "telefone='".$telefone."',"
        . "email='".$email."',";
if($senha!==''&&$senha!==null)
{
    $cmd1 .=  "senha='".$senha."',";
}
  $cmd1 .= "usuario='".$usuario."' where idusuario=".$idusuariot." and idpessoa in (".$idpessoa.")";
       

$result1 = mysql_query($cmd1);
 
echo mysql_error();
if(mysql_error()!="")
{
    $response["success"] = 0;
    $response["message"] = "Problemas na atualização do usuário: ".mysql_error().$cmd1;
}
else {
        if($gestor!==""&&$gestor!==null)
        {
            $cmd="update usuario_pessoa set "
                    . "gestor='".$gestor."',"
                    . "adm_veiculo='".$admveiculo."',"
                    . "adm_almox='".$admalmox."',"
                    . "adm_portaria='".$admportaria."',"
                    . "adm_usuario='".$admusuario."',"
                    . "adm_rastreado='".$admrastreado."'"
                     . " where idusuario=".$idusuariot." and idpessoa in (".$idpessoa.")";
            $result=  mysql_query($cmd);
            mysql_error();
            if(mysql_error()!="")
            {
                $response["success"] = 0;
                $response["message"] = "Problemas na atualização do usuário: ".mysql_error().$cmd1;
            }
            else {
        
                $response["success"] = 1;
                $response["message"] = "Usuário atualizado com sucesso.";
            }
        }
        else {
        
            $response["success"] = 1;
            $response["message"] = "Usuário atualizado com sucesso.";
        }
} 
echo json_encode($response);
?>