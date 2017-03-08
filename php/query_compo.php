<h4 class="text-center">Inspeção de componentes</h4>

<?php
include 'mysql.php';
$chip=$_REQUEST["chip_veiculo"];
$idpessoa=$_REQUEST["idpessoa"];

$cmd="SELECT pneu.numero_chip, idcomponente,"
        . "marca, medida, modelo, banda, vida, pneu.numero_serie, eixo, roda "
        . " FROM pneu, componente_almox"
        . " where numero_chip_veiculo='".$chip."' "
        . " and pneu.numero_chip=componente_almox.numero_chip"
        . " and pneu.idpessoa=componente_almox.idpessoa"
        . " order by eixo, roda";

$result=  mysql_query($cmd);
echo mysql_error();
$conta=0;
$imgclick='verificachip(lerchip());';

while ($row = mysql_fetch_array($result)) 
{
    $click="checachip('".$row["numero_chip"]."');";
    $qtditens++;
    echo '<button type=button class="btn badge" onclick="'.$imgclick.'" style="margin: 1rem;padding:1rem;"'
            . 'id="'.$row["numero_chip"].'" name="'.$row["numero_serie"].'">'
            . 'PNEU '.$row["numero_serie"]."<br>EIXO ".$row["eixo"]."<br>RODA ".$row["roda"]
            . '<input type="hidden" id="C'.$row["numero_chip"].'" value="'.$row["idcomponente"].'" />'
            . '<input disabled class="checkbox" type="checkbox" id="S'.$row["numero_chip"].'"  />'
            . '<img class="img-responsive" id="I'.$row["numero_chip"].'"  /></button>';
            
            
}
$cmd="SELECT componente.idcomponente, descrComponente, numero_chip , numero_serie,"
    ."cindbeacon,cindchipado,cindqrcode,cindbarras,cindmanual, idrastreado"
        . " FROM componente, componente_veiculo, veiculo"
        . " where componente.idcomponente = componente_veiculo.idcomponente"
        . " and componente_veiculo.chip_veiculo = veiculo.chip_veiculo "
        . " and componente_veiculo.idpessoa = veiculo.idpessoa "
        . " and componente.idpessoa=".$idpessoa
        . " and veiculo.chip_veiculo in ('".$chip."') order by idcomponente";
 
$result=  mysql_query($cmd);

while ($row = mysql_fetch_array($result)) 
{
    
    $cmdc="select cindbeacon,cindchipado,cindqrcode,cindbarras,cindmanual "
        . " from componente where idcomponente =".$row["idcomponente"]." and idpessoa in ('".$idpessoa."')";
    
    $cmdca=  mysql_query($cmdc);
    
    if(mysql_error()!="")
    {
        echo mysql_error().$cmdc;
    }
    $indbeacon=$row["cindbeacon"];
    $indchipado=$row["cindchipado"];
    $indqrcode=$row["cindqrcode"];
    $indbarras=$row["cindbarras"];
    $indmanual=$row["cindmanual"];
    
    $imgaction="RFID";
    $imgclick='verificachip(lerchip());';
    
    $qtditens++;
    
     echo '<button type=button class="btn btn-info" style="margin: 1rem;padding:1rem;" '
        . 'onclick="'.$imgclick.'" id="'.$row["numero_chip"].'" name="'.$row["numero_serie"].'" >'
        .$row["descrComponente"].'<br>'.$row["numero_serie"]
            . '<input type="hidden" id="C'.$row["numero_chip"].'" value="'.$row["idcomponente"].'" />'
        . '<input disabled class="checkbox" type="checkbox" id="S'.$row["numero_chip"].'"  />'
        . '<img class="img-responsive" id="I'.$row["numero_chip"].'"  /></button>';
}

echo  '<div class=container >'
    . 'Total de itens:<input type=text class="input" disabled id="qtditens"  name="qtditens" type="text" value="'.$qtditens.'" style="margin: 1rem;padding:1rem;" /></div> ';
echo  '<div class=container >Encontrados :<input type=text class="input" disabled id="qtdfound"  name="qtdfound" type="text" value="0" style="margin: 1rem;padding:1rem;" />'
    
    . '</div>';
?>
