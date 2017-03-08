<?php
$chip = $_REQUEST["chip"];  
$numero_serie= $_REQUEST["numero_serie"];

include 'mysql.php'; 
$vertag=0;
$result = mysql_query("update pneu set numero_chip='".$chip."' where numero_chip='".$numero_serie."'");

if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Veículo atualizado com sucesso.";
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = mysql_error();
}
 echo json_encode($response);
?>