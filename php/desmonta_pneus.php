<?php
include 'mysql.php';
$chip = $_REQUEST["chip"];
$idpessoa=$_REQUEST["idpessoa"];
$chip_veiculo = $_REQUEST["chip_veiculo"];

$cmd="select *  from veiculo where idpessoa=".$idpessoa
        ." and chip_veiculo in ('".$chip_veiculo."')";

$result=  mysql_query($cmd);
echo mysql_error();
while($rs=  mysql_fetch_array($result))
{
    $kmveiculo=$rs["km_veiculo"];
}
$cmd="select *  from componente_almox where idpessoa=".$idpessoa
        ." and numero_chip in ('".$chip."')";

$result=  mysql_query($cmd);
echo mysql_error();
while($rs=  mysql_fetch_array($result))
{
    $idcomponente=$rs["idcomponente"];
    $numero_serie=$rs["numero_serie"];
}
$cmd="select *  from pneu where idpessoa=".$idpessoa
        ." and numero_chip in ('".$chip."')";

$result=  mysql_query($cmd);
echo mysql_error();
while($rs=  mysql_fetch_array($result))
{
    $eixo=$rs["eixo"];
    $roda=$rs["roda"];
}

$cmd="update pneu set numero_chip_veiculo = null where idpessoa=".$idpessoa
        ." and numero_chip in ('".$chip."')";

$result=  mysql_query($cmd);

if(mysql_error()==null && mysql_affected_rows()>0) 
{
    $cmd="update componente_almox set data_montagem = null where idpessoa=".$idpessoa
            ." and numero_chip in ('".$chip."') ";

    $result=  mysql_query($cmd);

    if(mysql_error()==null) 
    {
        
        $cmd="insert into componente_historico (idpessoa,idcomponente,chip_veiculo,numero_chip,numero_serie,data_desmonte,kmveiculo,eixo,posicao)VALUES"
            ."(".$idpessoa.",".$idcomponente.",'".$chip_veiculo."','".$chip."','".$numero_serie."',now(),".$kmveiculo.",".$eixo.",".$roda.")";
        $result=  mysql_query($cmd);
        if (mysql_error()!=null)
        {
            $response["resposta"] = "NOK";
            $response["message"] = "Problemas na instalação: ".  mysql_error().$cmd;
            $response["success"] = 0;
        }
        else 
        {
            $response["resposta"] = "OK";
            $response["message"] = "Pneu desinstalado com sucesso ";
            $response["success"] = 1;
        }
   }
}
 else {
    $response["resposta"] = "NOK";
    $response["message"] = "Problemas: ".$cmd." - ".mysql_error();
    $response["success"] = 0;
}

echo json_encode($response);
?>
