<?php
include 'mysql.php';
$cmd = "SELECT * FROM rastreado"
        . " where idpessoa=".$_REQUEST['idpessoa']." and idrastreado=".$_REQUEST["idrastreado"];
 
$result=  mysql_query($cmd);
while($rs=  mysql_fetch_array($result))
{
    $idrastreado=$rs["idrastreado"];
    $nomerastreado=$rs["nomerastreado"];
    $indveiculo=$rs["indveiculo"];
    $indalmox=$rs["indalmox"];
    $indqrcode=$rs["indqrcode"];
    $indbeacon=$rs["indbeacon"];
    $indchipado=$rs["indchipado"];
    $indbarras=$rs["indbarras"];
    $indmanual=$rs["indmanual"];

}
echo '<div style="text-align:center">
    <br><br>
    <p>CRIAÇÃO DE ITEM '.$nomerastreado.'</p>
    <br><br>
</div>';

if($indveiculo==="S")
{
    include "inclui_veiculo.php";
}
else
{
    include "incluir_item.php";
}
?>

