<?php
 
$chip = $_REQUEST["chip"];
$idcomponente=$_REQUEST["idcomponente"];
$idpessoa= $_REQUEST["idpessoa"];

include 'mysql.php';

$cmd = "update componente_almox set  data_baixa = now() "
        ." where idcomponente=".$idcomponente." and numero_chip in('".$chip."') and idpessoa='".$idpessoa."' ";

$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Componente baixado com sucesso.";
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = $cmd. mysql_error();
}
 echo json_encode($response);


?>