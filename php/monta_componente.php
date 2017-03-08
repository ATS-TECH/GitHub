<?php
$numero_serie= $_REQUEST["numero_serie"];
$chip = $_REQUEST["chip"];
$idpessoa=$_REQUEST["idpessoa"];
$chip_veiculo=$_REQUEST["chip_veiculo"];
$idcomponente=$_REQUEST["idcomponente"];

include 'mysql.php';

$cmd= "insert into componente_veiculo (idcomponente,numero_serie,numero_chip,idpessoa,chip_veiculo) values("
       .$idcomponente.",".$numero_serie.",'".$chip."',".$idpessoa.",'".$chip_veiculo."')";

if($numero_serie==null||$numero_serie=="")
{
    $response["success"] = 0;
    $response["message"] = "Insira o numero de série";
    echo json_encode($response);
    return;
}
else
{
    if($chip==null||$chip=="")
    {
        $response["success"] = 0;
        $response["message"] = "Instale e leia o chip do componente";
        echo json_encode($response);
        return;
    }
    else 
    {
       $result = mysql_query($cmd);
       $cmd = "Insert into componente_historico (idcomponente, chip_veiculo, numero_chip,  numero_serie, data_instalacao) values("
        .$idcomponente.",'".$chip_veiculo."','".$chip."','".$numero_serie."', now())";
       $result = mysql_query($cmd);
       if(mysql_error()== null)
       {
            $cmd = "update componente_almox set data_montagem=now(), numero_serie='".$numero_serie."'"
                    . " where numero_chip='".$chip."' and idcomponente=".$idcomponente." and idpessoa='".$idpessoa."'";
            $result = mysql_query($cmd);
            if(mysql_error()== null)
            {
                $response["success"] = 1;
                $response["message"] = "Componente montado com sucesso.";
            } 
             else 
            {
                // required field is missing
                $response["success"] = 0;
                $response["message"] = $cmd. mysql_error();
            }
       } 
       else 
       {
           // required field is missing
           $response["success"] = 0;
           $response["message"] = $cmd. mysql_error();
       }
        echo json_encode($response);
    }
}
 

?>