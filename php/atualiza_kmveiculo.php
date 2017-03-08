<?php
$chip = $_REQUEST["chip"];  
$idveiculo= $_REQUEST["idveiculo"];
$hrveiculo= $_REQUEST["hrveiculo"];
$kmveiculo= $_REQUEST["kmveiculo"];

include 'mysql.php'; 
$vertag=0;
$cmd="update veiculo set "
        . " km_veiculo='".$kmveiculo."' "
        . " where chip_veiculo in('".$idveiculo."')";
 
mysql_query($cmd);

if(mysql_error()== null)
{
        $result = mysql_query("INSERT INTO seriekm(chip_veiculo,km,datakm)VALUES('$idveiculo','$kmveiculo',now())");
        if(mysql_error()== null)

        $response["success"] = 1;
        $response["message"] = "KM atualizado com sucesso.";
} else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = mysql_error();
 
    // echoing JSON response
    
}
echo json_encode($response);
?>