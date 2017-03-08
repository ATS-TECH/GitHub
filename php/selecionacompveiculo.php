<?php
include 'mysql.php';
$numero_chip = $_REQUEST["numero_chip"];
$idcomponente = $_REQUEST["idcomponente"];
$idpessoa = $_REQUEST["idpessoa"];

$idpneu=$numero_chip;
$cmd="select * from componente where idcomponente=".$_REQUEST['idcomponente']  
        . " and idpessoa=".$_REQUEST['idpessoa'];
 
$cmd=  mysql_query($cmd);
$ispneu="N";
while($rs=  mysql_fetch_array($cmd))
{
    $ispneu=$rs["ispneu"];
    $nomefamilia=$rs["descrComponente"];
    $cindqrcode=$rs["cindqrcode"];
    $cindbeacon=$rs["cindbeacon"];
    $cindchipado=$rs["cindchipado"];
    $cindbarras=$rs["cindbarras"];
    $cindmanual=$rs["cindmanual"];
}
if($ispneu==="S")
{
    include 'detalhepneu.php';    
}
else 
{
    include 'detalhecompveiculo.php'; 
}