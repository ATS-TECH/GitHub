<?php
include 'mysql.php'; 
$idpessoa = $_REQUEST["idpessoa"];
$idrastreado = $_REQUEST["idrastreado"];
$numero_chip= $_REQUEST["numero_chip"];
$nomeitem= $_REQUEST["nomeitem"];
$chip_rastreado= $_REQUEST["chip_rastreado"];
$idcomponente= $_REQUEST["idcomponente"];
 


//USUÁRIO e CHIP são iguais !!!!!!
$cmd1="update componente_rastreado set   "
        . "numero_serie='".$nomeitem."',"
        . "idcomponente='".$idcomponente."'"
        . " where idrastreado=".$idrastreado." and idpessoa=".$idpessoa
        . " and numero_chip in ('".$numero_chip."') and chip_rastreado in ('".$chip_rastreado."')" ;
       
mysql_query($cmd1);
 
if(mysql_error()!='')
{
    echo mysql_error().$cmd1;
}
if(mysql_error()!="")
{
    $response["success"] = 0;
    $response["message"] = "Problemas na atualização do item rastreado: ".mysql_error().$cmd1;
}
else {
    if(mysql_affected_rows()==0)
    {
        $cmd1="INSERT INTO itemrastreado(`idrastreado`,`idpessoa`,`numero_chip`,`chip_rastreado`,`numero_serie`,idcomponente)VALUES("
        .$idrastreado.",".$idpessoa.",'".$numero_chip."','".$chip_rastreado."','".$nomeitem."',".$idcomponente.")";
    }
    mysql_query($cmd1);

    if(mysql_error()=="")
    { 
        $response["success"] = 0;
        $response["message"] = "Componente atualizado com sucesso.";
    }
    else {
        $response["success"] = 0;
        $response["message"] = "Problemas.".mysql_error().$cmd1;
    }
} 
echo json_encode($response);
?>