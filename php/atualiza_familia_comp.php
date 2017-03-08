
<?php
$idpessoa = $_REQUEST["idpessoa"];
$idcomponente = $_REQUEST["idcomponente"];
$nomefamilia = $_REQUEST["nomefamilia"];
$indalmox = "S";
$cindbeacon = $_REQUEST["cindbeacon"];
$cindchipado = $_REQUEST["cindchipado"];
$cindqrcode = $_REQUEST["cindqrcode"];
$cindmanual = $_REQUEST["cindmanual"];
$cindbarras = $_REQUEST["cindbarras"];
$cindveiculo = $_REQUEST["cindveiculo"];
$cindpneu = $_REQUEST["cindpneu"]; 
include 'mysql.php'; 

$cmd= "select (select count(*) qtd from componente_almox "
        . " where componente.idcomponente=componente_almox.idcomponente"
        . " componente.idpessoa=componente_almox.idpessoa)"
        . "  , ispneu from componente " 
        . " and componente.idpessoa=".$idpessoa
        . " and componente.idcomponente in ('".$idcomponente."')";
$result = mysql_query($cmd);
echo mysql_error();
while($rs=  mysql_fetch_array($result))
{
    $qtd=$rs["qtd"];
    $ispneu=$rs["ispneu"];
}
if($ispneu==="S")
{
    if($cindpneu!=="S"&&$qtd>0)
    {
        $response["success"] = 0;
        $response["message"] = "Existem ".$qtd." ".$nomefamilia." criados.";
    }
    else
    {
        if($cindchipado!=="S")
        {
            $response["success"] = 0;
            $response["message"] = "PNEU TEM QUE SER IDENTIFICADO COM CHIP.";
        }
        else
        {
            $cindalmox="S";
            $cmd1="update componente set   "
                    . "descrcomponente='".$nomefamilia."',"
                    . "ispneu='".$cindpneu."',"
                    . "indalmox='".$cindalmox."',"
                    . "cindbeacon='".$cindbeacon."',"
                    . "cindchipado='".$cindchipado."',"
                    . "cindqrcode='".$cindqrcode."',"
                    . "cindmanual='".$cindmanual."',"
                    . "cindbarras='".$cindbarras."',"
                    . "cindveiculo='".$cindveiculo."'"
                    . " where idcomponente=".$idcomponente." and idpessoa=".$idpessoa;


            $result1 = mysql_query($cmd1);
            echo mysql_error();
            if(mysql_error()!="")
            {
                $response["success"] = 0;
                $response["message"] = "Problemas na atualização do rastreado: ".mysql_error();
            }
            else {
                $response["success"] = 1;
                $response["message"] = "Categoria de Rastreado atualizado com sucesso.";
            } 
        }
    }
}
else
{
    $cindalmox="S";
    $cmd1="update componente set   "
            . "descrcomponente='".$nomefamilia."',"
            . "ispneu='".$cindpneu."',"
            . "indalmox='".$cindalmox."',"
            . "cindbeacon='".$cindbeacon."',"
            . "cindchipado='".$cindchipado."',"
            . "cindqrcode='".$cindqrcode."',"
            . "cindmanual='".$cindmanual."',"
            . "cindbarras='".$cindbarras."',"
            . "cindveiculo='".$cindveiculo."'"
            . " where idcomponente=".$idcomponente." and idpessoa=".$idpessoa;


    $result1 = mysql_query($cmd1);
    echo mysql_error();
    if(mysql_error()!="")
    {
        $response["success"] = 0;
        $response["message"] = "Problemas na atualização do rastreado: ".mysql_error();
    }
    else {
        $response["success"] = 1;
        $response["message"] = "Categoria de Rastreado atualizado com sucesso.";
    } 
}
echo json_encode($response);
?>