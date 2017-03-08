<ul class="nav navbar-nav navbar-default">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Selecione<br>o pneu
                    </a>
                   
                    <ul class="dropdown-menu" style="font-size: 11px;letter-spacing: 1px;padding: 3px;">
<?php
include 'mysql.php';
$tag = $_REQUEST["tag"];
$eixo=$_REQUEST["eixo"];
$roda=$_REQUEST["roda"];
 
$cmd = "SELECT pneu.numero_serie, pneu.numero_chip, pneu.medida, pneu.marca, pneu.modelo "
        . "from componente_almox, componente, pneu" 
	. " where ispneu='S' "
        . " and componente_almox.idcomponente = componente.idcomponente"
        . " and componente_almox.idpessoa=".$_REQUEST["idpessoa"]
        . " and componente_almox.idpessoa=componente.idpessoa"
        . " and componente_almox.idpessoa=pneu.idpessoa"
        . " and componente_almox.numero_chip=pneu.numero_chip"
        . " and data_montagem is null"
        . " and data_baixa is null"
        . " order by pneu.numero_serie " ;

$result=  mysql_query($cmd);
$conta=0;
echo mysql_error();
while ($row = mysql_fetch_array($result)) 
{
     
   echo '<li role="presentation" '
   . ' onclick="instalapneu('.$eixo.','.$roda.','."'".$row["numero_chip"]."'".');" class="navbar-text" >'
           .$row["numero_serie"]."<br>"
           .$row["medida"]."<br>"
           .$row["marca"]." / "
           .$row["modelo"] 
           .'</li>';
}
?>
            </li>
        </ul>
    </li>
</ul>