<html>
<?php
include 'mysql.php';
$pesquisa=$_REQUEST['pesquisa'];
if($pesquisa!==null&&$pesquisa!="")
{
    $cmdr = "select chip_veiculo , imagem, "
        . "  marca,modelo_veiculo,ano_veiculo,obsveiculo obsitem," 
        . "  placa_veiculo,registro_veiculo,qtdeixos  " 
        . "  from veiculo where idpessoa=".$_REQUEST['idpessoa']." "
        . " and ((placa_veiculo like '%".$pesquisa."%' ) or "    
        . "      (registro_veiculo like '%".$pesquisa."%' )) "
        . " order by registro_veiculo";
}
else
{
      $cmdr = "select chip_veiculo , imagem, "
        . "  marca,modelo_veiculo,ano_veiculo,obsveiculo obsitem," 
        . "  placa_veiculo,registro_veiculo,qtdeixos  " 
        . "  from veiculo where idpessoa=".$_REQUEST['idpessoa']." "
        . " aidrastreado=".$_REQUEST['idrastreado']." order by placa_veiculo";
}
$cmdr=  mysql_query($cmdr);

while($rsr=  mysql_fetch_array($cmdr))
{
    
        $numero_chip=$rsr["chip_veiculo"];
        $nomeitemrastreado=" ".$rsr["registro_veiculo"]."<br><br><strong>".$rsr["placa_veiculo"]."</strong>";
        $imagem=$rsr["imagem"];
        $obsitem=$rsr["obsveiculo"];
        $idrastreado=$_REQUEST['idrastreado'];
        $imagem=$rsr["imagem"];
        $detalhes=$rsr["marca"]." "
                .$rsr["modelo_veiculo"]." / "
                .$rsr["ano_veiculo"];
        $obsitem=$detalhes;
        manual($idrastreado,$numero_chip,$nomeitemrastreado,$obsitem,$indveiculo);    
    

}
function manual($idrastreado,$numero_chip,$nomeitemrastreado,$obsitem,$indveiculo)
{
    $linka=  'abrecomp('.$idrastreado.','.$indveiculo.',"'.$numero_chip.'" );"';
    $linkb= "detalhesmenu('".$numero_chip."',".$idrastreado.",'".$indveiculo."');";
    $linkc= "inspecao('".$numero_chip."',".$idrastreado.");";
    
    echo  '<div class="btn btn-info" style="margin: 1rem;padding:1rem;font-size:12px" onclick="'.$linkb.'">'
        . '<i class="fa fa-truck">'.$nomeitemrastreado."  ".$detalhes.'</i>  '
        . '</div>'; 
}
?>
 