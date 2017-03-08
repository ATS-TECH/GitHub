<?php
//include 'mysql.php';


$cmd="select datamedida, medida FROM medida "
        . "where numero_chip='".$chip."' and sulco=".$sulco." having datamedida = (select max(d.datamedida) from medida d where d.numero_chip = '".$chip."' and sulco=".$sulco." )";
$resultado=  mysql_query($cmd);

$conta=0;

while ($row = mysql_fetch_array($resultado)) 
{
    echo date("d/m/Y H:i:s",strtotime ( $row["datamedida"])).": ".$row["medida"]." mm";
    $conta++;
}
if($conta==0) 
{
    echo "Medidas do pneu não encontradas";
     
}
 
?>
