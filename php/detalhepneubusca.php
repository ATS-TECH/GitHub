<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script>

</script>
</head>
<body>

<?php
$idpessoa=$_REQUEST["idpessoa"];
include 'mysql.php';

$cmd = "SELECT * from pneu"
        . " where ";
if(isset($_REQUEST["numero_chip"]))
{
    $cmd .= "  numero_chip='".$_REQUEST["numero_chip"]."'";
}
 else {
    $cmd .= "  numero_serie in ('".$_REQUEST["numero_serie"]."')";
}
              
$cmd .=" and pneu.idpessoa in (".$idpessoa.")";

$result=  mysql_query($cmd);
if(mysql_num_rows($result)===0)
{
    echo '<h4 class="text-center">PNEU NÃO ENCONTRADO</h4>';
    return;
}
if(mysql_error()!=="")
{
    echo mysql_error().$cmd;
}
while($rs=  mysql_fetch_array($result))
{
      $marca=$rs["marca"];
      $modelo=$rs["modelo"];
      $medida=$rs["medida"];
      $numserie=$rs["numero_serie"];
      $numchip=$rs["numero_chip"];
      $chipveiculo=$rs["numero_chip_veiculo"];
}

$cmd = "SELECT idcomponente,data_montagem, data_baixa, valor_unitario from componente_almox"
        . " where idpessoa=".$idpessoa." and numero_chip in ('".$numchip."')" ;  

$result=  mysql_query($cmd);
if(mysql_error()!=="")
{
    echo mysql_error().$cmd;
}
while($rs=  mysql_fetch_array($result))
{
      $idcomponente=$rs["idcomponente"];
      $valor=$rs["valor_unitario"];
      $datamonta=$rs["data_montagem"];
      $databaixa=$rs["data_baixa"];
//      echo $databaixa." baixa";
//      echo $datamonta." monta";
}
if(isset($chipveiculo)&&$chipveiculo!=="")
{
    $cmd = "SELECT * from veiculo "
            . " where idpessoa=".$idpessoa." and chip_veiculo in ('".$chipveiculo."')" ;  
    
    $result=  mysql_query($cmd);
    if(mysql_error()!=="")
    {
        echo mysql_error().$cmd;
    }
    while($rs=  mysql_fetch_array($result))
    {
          $placa=$rs["placa_veiculo"];
          $registro=$rs["registro_veiculo"];
    }
}
echo '<div class=container-fluid>';
if(isset($databaixa))
{
    echo '<h4>PNEU SUCATEADO EM '.date-format(date_create($databaixa),"d/m/Y H:i").'</h4>';
}
else
{
    if(isset($placa))
    {
        echo '<h4>PNEU MONTADO EM '.$placa." - ".$registro.'</h4>';
        include 'detalhepneu.php';
    }
    else
    {
        echo '<h4>PNEU NO ALMOXARIFADO </h4>';
        $idpneu=$numchip;
        include 'detalhepneualmox.php';
    }
}
echo '</div>';
//$numchip=$_REQUEST["numero_chip"];
//include 'resumo_pneu_operacoes.php'; 
?>
</body>
</html>