<?php
include 'mysql.php';
$chip = $_REQUEST["idveiculo"];
$idpessoa=$_REQUEST["idpessoa"];
$eixo=$_REQUEST["indeixo"];
$cmd="select count(*) conta from pneu where idpessoa=".$idpessoa." and numero_chip_veiculo in ('".$chip."') and eixo in ('".$eixo."')";

$result=  mysql_query($cmd);
while($rs=  mysql_fetch_array($result))
{
    $conta=$rs["conta"];
}
if($conta>0)
{
    $response["resposta"] = "NOK";
    $response["message"] = "Desmonte os pneus do eixo para excluir";
    $response["success"] = 0;
}
else
{

    $cmd="delete from eixo_veiculo "
        . "  where chip_veiculo in ('".$chip."') "
            . "and idpessoa in ('".$idpessoa."')" 
        . "and ideixo_veiculo in ('".$eixo."')";

    $result=  mysql_query($cmd);

    if(mysql_error()==null) 
    {
        if (mysql_error()!=null||  mysql_affected_rows()==0)
        {
            $response["resposta"] = "NOK";
            $response["message"] = "Problemas na exclusão: ".  mysql_error().$cmd;
            $response["success"] = 0;
        }
        else 
        {
            $response["resposta"] = "OK";
            $response["message"] = "Eixo removido com sucesso ";
            $response["success"] = 1;
        }
   }
}

echo json_encode($response);
?>
