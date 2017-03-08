<?php
$qtdrodas= $_REQUEST["qtdrodas"];
$ideixos= $_REQUEST["ideixos"];
$chip_veiculo=$_REQUEST["chip_veiculo"]; 
$ideixo_veiculo = $_REQUEST["ideixo_veiculo"];
$idpessoa = $_REQUEST["idpessoa"];
include 'mysql.php'; 
$cmd="select * from eixo_veiculo"
        . " where ideixo_veiculo =".$ideixo_veiculo
        . " and chip_veiculo in ('".$chip_veiculo."')"
        . " and idpessoa=".$idpessoa
        . " order by ideixo_veiculo";
$result = mysql_query($cmd);
if(mysql_num_rows($result)==0)
{
    $cmd= "insert into eixo_veiculo(idpessoa,chip_veiculo,ideixo_veiculo,ideixos,qtdrodas)values("
            .$idpessoa.",'".$chip_veiculo."',".$ideixo_veiculo.",".$ideixos.",".$qtdrodas.")";
             
    $result = mysql_query($cmd);

    if(mysql_error()!= null)
    {
        $response["success"] = 0;
        $response["message"] =  mysql_error().$cmd;
    }
    else
    {
        $response["success"] = 1;
        $response["message"] = "Eixo atualizado com sucesso.";
    }
}
else
{
    $cmd= "update eixo_veiculo set qtdrodas='$qtdrodas',"
            . "ideixos =".$ideixos
            . " where ideixo_veiculo =".$ideixo_veiculo
            . " and chip_veiculo in ('".$chip_veiculo."')";       
    $result = mysql_query($cmd);

    if(mysql_error()!= null)
    {
        $response["success"] = 0;
        $response["message"] =  mysql_error().$cmd;
    }
    else
    {
        $response["success"] = 1;
        $response["message"] = "Eixo atualizado com sucesso.";
    }
}
// echoing JSON response
echo json_encode($response);