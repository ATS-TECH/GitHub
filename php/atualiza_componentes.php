
<?php
$idpessoa = $_REQUEST["idpessoa"];
$idrastreado = $_REQUEST["idrastreado"];
$nomerastreado = $_REQUEST["nomerastreado"];
$obs = $_REQUEST["obs"];
$indalmox = "S";
$indbeacon = $_REQUEST["indbeacon"];
$indchipado = $_REQUEST["indchipado"];
$indqrcode = $_REQUEST["indqrcode"];
$indmanual = $_REQUEST["indmanual"];
$indbarras = $_REQUEST["indbarras"];
$indveiculo = $_REQUEST["indveiculo"];

include 'mysql.php'; 

//USUÁRIO e CHIP são iguais !!!!!!
$cmd1="update rastreado set   "
        . "nomerastreado='".$nomerastreado."',"
        . "obs='".$obs."',"
        . "indalmox='".$indalmox."',"
        . "indbeacon='".$indbeacon."',"
        . "indchipado='".$indchipado."',"
        . "indqrcode='".$indqrcode."',"
        . "indmanual='".$indmanual."',"
        . "indbarras='".$indbarras."',"
        . "indveiculo='".$indveiculo."'"
        . " where idrastreado=".$idrastreado." and idpessoa=".$idpessoa;
       

$result1 = mysql_query($cmd1);
 
echo mysql_error();
if(mysql_error()!="")
{
    $response["success"] = 0;
    $response["message"] = "Problemas na atualização do rastreado: ".mysql_error();
}
else {
        $response["success"] = 1;
        $response["message"] = "Categoria de Rastreado atualizado com sucesso.";
} 
echo json_encode($response);
?>