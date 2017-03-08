
<?php
 
$numero_serie = $_REQUEST["numero_serie"];
$numero_chip = $_REQUEST["numero_chip"];
$chip = $_REQUEST["chip"];
$idcomponente = $_REQUEST["idcomponente"];
$idpessoa = $_REQUEST["idpessoa"];
$valor= $_REQUEST["valor"];

include 'mysql.php'; 

//USUÁRIO e CHIP são iguais !!!!!!
$cmd1="update componente_almox set   "
        . "numero_chip='".$numero_chip."',"
        . " numero_serie='".$numero_serie."', "
        . " valor_unitario='".$valor."' "
        . " where idcomponente=".$idcomponente." "
        . " and idpessoa=".$idpessoa
        . " and numero_chip in ('".$numero_chip."')";
       

$result1 = mysql_query($cmd1);
 
echo mysql_error();
if(mysql_error()!="")
{
    $response["success"] = 0;
    $response["message"] = "Problemas na atualização do rastreado: ".mysql_error();
}
else {
        $response["success"] = 1;
        $response["message"] = "Componente atualizado com sucesso.";
} 
echo json_encode($response);
?>