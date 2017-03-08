<?php
include 'mysql.php';
 
$idcomponente = $_REQUEST["idcomponente"];
$idpessoa = $_REQUEST["idpessoa"];

$idpneu=$numero_chip;
$cmd="select ispneu,descrComponente from componente where idcomponente=".$_REQUEST['idcomponente']." and idpessoa=".$idpessoa;
$cmd=  mysql_query($cmd);
$ispneu="N";
while($rs=  mysql_fetch_array($cmd))
{
    $ispneu=$rs["ispneu"];
    $nomefamilia=$rs["descrComponente"];
}
if($ispneu==="S")
{
    include 'Incluipneu.php';    
}
else 
{
    include 'Incluicomponente.php'; 
}