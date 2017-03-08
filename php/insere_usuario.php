<?php
$idpessoa = $_REQUEST["idpessoa"];
$nome = $_REQUEST["nomeusuario"];
$usuario = $_REQUEST["usuario"];
$senha = $_REQUEST["senha"];
$email = $_REQUEST["email"];
$gestor=$_REQUEST["gestor"];
$admveiculo=$_REQUEST["admveiculo"];
$admalmox=$_REQUEST["admalmox"];
$admusuario=$_REQUEST["admusuario"];
$admrastreado=$_REQUEST["admrastreado"];
include 'mysql.php'; 

$cmd="select usuario from usuario where usuario in ('".$usuario."')";

$result=  mysql_query($cmd);
$existe=false;
while($res= mysql_fetch_array($result))
{
    $response["success"] = 0;
    $response["message"] = "usuário já existente";
    $existe=true;
}
if(!$existe)
{
    $cmd="select max(idusuario) qtd from usuario where idpessoa=".$idpessoa;

    $result=  mysql_query($cmd);

    $res= mysql_fetch_array($result);

    $idusuario=$res["qtd"];
    $idusuario++;

    //USUÁRIO e CHIP são iguais !!!!!!
    $cmd1="INSERT INTO usuario(idusuario, idpessoa, email ,usuario, chip, senha, nomeusuario) VALUES ("
            .$idusuario.",".$idpessoa.",'".$email."','".$usuario."','".$usuario."','".$senha."','".$nome."')";

    $result1 = mysql_query($cmd1);

    echo mysql_error();
    if(mysql_error()!="")
    {
        $response["success"] = 0;
        $response["message"] = "Problemas na gravação usuario: ".mysql_error();
    }
    else {
        $cmd2="INSERT INTO usuario_pessoa "
             ."(idusuario,idpessoa,gestor,adm_veiculo,adm_almox,adm_usuario,adm_rastreado) VALUES ("
             .$idusuario.",".$idpessoa.",'".$gestor."','".$admveiculo."','".$admalmox."','".$admusuario."','".$admrastreado."')";
        $result2 = mysql_query($cmd2); 
        echo mysql_error();
        if(mysql_error()!="")
        {
            $response["success"] = 0;
            $response["message"] = "Problemas na gravação usuario_pessoa: ".mysql_error()." - ".$cmd2;
        }
        else  
        {
            $response["success"] = 1;
            $response["message"] = "Usuário criado com sucesso.";
        }
    } 
}

echo json_encode($response);
?>