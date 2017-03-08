<?php
$idcomponente=$_REQUEST["idcomponente"];  
$marca = $_REQUEST["marca"];  
$numero_serie= $_REQUEST["numero_serie"];
$medida = $_REQUEST["medida"];
$modelo = $_REQUEST["modelo"];
$vida = $_REQUEST["vida"];
$banda = $_REQUEST["banda"];
$chip = $_REQUEST["chip"];
$idpessoa = $_REQUEST["idpessoa"];
$valor = $_REQUEST["valor"];
$idpneu=$_REQUEST["idpneu"];
include 'mysql.php';
if($chip==="")
{
    $chip=$idpneu;
}

$cmd = "UPDATE pneu set marca='".$marca."' , modelo='".$modelo."', "
                     ."medida='".$medida."', numero_chip='".$chip."', "
                     ."vida=".$vida.", banda='".$banda."' "
        . " where numero_chip in ('".$idpneu."')"
        . " and idpessoa='".$idpessoa."'";  
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $cmd = "UPDATE componente_almox set valor_unitario='".$valor."'"
           . " where idcomponente=".$idcomponente 
           . " and idpessoa='".$idpessoa."'"
           . " and numero_chip in ('".$chip."')";  
        $result = mysql_query($cmd);
        if(mysql_error()== null)
        {
            $response["success"] = 1;
            $response["message"] = "Pneu atualizado com sucesso.";
        }
        else {
        // required field is missing
            $response["success"] = 0;
            $response["message"] = $cmd. mysql_error();
        }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);
?>