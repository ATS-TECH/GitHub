<?php
$chip = $_REQUEST["chip"];  
$pressao = $_REQUEST["pressao"];
$sulco = $_REQUEST["sulco"];
$medida = $_REQUEST["medida"]; 
$idpessoa = $_REQUEST["idpessoa"];
include 'mysql.php'; 
$vertag=0;
if($pressao>0)
{
   $cmd="INSERT INTO pressao(idpessoa,numero_chip,datapressao,pressao)VALUES(".$idpessoa.",'".$chip."',now(),".$pressao.")";
}
if($sulco>0)
{
    $cmd="INSERT INTO medida(idpessoa,numero_chip,datamedida,medida,sulco)"
            . "VALUES(".$idpessoa.",'".$chip."',now(),".$medida.",".$sulco.")";
    
}
$result = mysql_query($cmd);
if(mysql_error()== null)
{
    $response["success"] = 1;
    $response["message"] = "Medida gravada com sucesso.";
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = mysql_error().$cmd;
}
 echo json_encode($response);
?>