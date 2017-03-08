<?php
include 'mysql.php'; 
$idveiculo= $_REQUEST["idveiculo"];
$indeixo=$_REQUEST["indeixo"];
$idpessoa=$_REQUEST["idpessoa"];
$cmd2= "INSERT INTO eixo_veiculo(idpessoa,chip_veiculo,ideixo_veiculo,ideixos,qtdrodas)VALUES"
                        ."(".$idpessoa.",'".$idveiculo."',"
                        .$indeixo.",3,4)";
$result = mysql_query($cmd2);
echo $cmd2;
if(mysql_error()!= null)
{
    $response["success"] = 0;
    $response["message"] = "Eixos não criados:".mysql_error();

}
 else {
    $response["success"] = 1;
    $response["message"] = "Eixo criado com sucesso.";
}

echo json_encode($response);
