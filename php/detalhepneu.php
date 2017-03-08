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

$cmd = "SELECT * from pneu, eixo_veiculo"
        . " where numero_chip in ('".$_REQUEST["numero_chip"]."') "
        . " and pneu.idpessoa='".$idpessoa."'"
        . " and eixo_veiculo.idpessoa=pneu.idpessoa"
        . " and ideixo_veiculo = pneu.eixo"
        . " and eixo_veiculo.chip_veiculo=numero_chip_veiculo";  

$cmd=  mysql_query($cmd);
echo mysql_error();
while($rs=  mysql_fetch_array($cmd))
{
      $marca=$rs["marca"];
      $modelo=$rs["modelo"];
      $medida=$rs["medida"];
      $numserie=$rs["numero_serie"];
      $numchip=$rs["numero_chip"];
      $vida=$rs["vida"];
      $banda=$rs["banda"];
      $eixo=$rs["eixo"];
      $roda=$rs["roda"];
      $ideixo=$rs["ideixos"];
      $qtdrodas=$rs["qtdrodas"];
}
//if($vida===""||$vida===0)
//{
//    $vida=1;
//}
//if($banda==""||$vida=1)
//{
//    $banda="ORIGINAL";
//}
$cmd = "SELECT idcomponente, valor_unitario from componente_almox where idpessoa=".$idpessoa." and numero_chip in ('".$idpneu."')" ;  

       $cmd=  mysql_query($cmd);
       echo mysql_error();
       while($rs=  mysql_fetch_array($cmd))
       {
             $idcomponente=$rs["idcomponente"];
             $valor=$rs["valor_unitario"];
       }
?>
<input type=hidden value="<?php echo $idcomponente; ?>" id=idcomponentealmox name=idcomponente/>   
<input type=hidden value="" id=idveiculo name=idveiculo/>
<input type=hidden value="<?php echo $numchip; ?>" id=idpneudet name=idpneudet/>
<div class="table-responsive">
    <table class=table>
        <tr><th >Medida</th><th >Marca</th><th >Modelo</th></tr>
        <tr><td>
                <input type="text" class="form-control" id="medida" value="<?php echo $medida; ?>">
            </td>
            <td>
                <input type="text" class="form-control" id="marca" value="<?php echo $marca; ?>"
            </td>    
            <td>
                <input type="text" class="form-control" id="selmodelo" value="<?php echo $modelo; ?>">
            </td> 
        </tr>
</table>
<div class="table-responsive">
    <table class=table>
        <tr><th >Marca<br> de Fogo</th>
            <th  >Banda de<br>rodagem</th>
            <th >Vida</th>
            <th >Posição</th>
             </tr>
        <tr >
            <td >
                <input style="min-width:80px;" disabled class="form-control" type="text" id=numserie name=numserie value="<?php echo $numserie ?>"/> 
            </td>
            <td  >   
                <input style="min-width:120px;" class="form-control" type="text" id=banda name=banda value="<?php echo $banda ?>"/> 
            </td>
      
            <td  >
                <select class="form-control" id=vida name=vida  style="min-width:60px;">
                <?php
                    for($ixvida=1;$ixvida<8;$ixvida++)
                    {
                        if($ixvida==$vida)
                        {
                            echo '<option selected value='.$ixvida.'>'.$ixvida.'</option>';
                        }
                        else
                        {
                            echo '<option value='.$ixvida.'>'.$ixvida.'</option>';
                        }
                    }

//                        echo $vida ?>
                </select>  
            </td>
                        
                <?php
                    // $ideixo, $qtdrodas, $roda
                    include "posicaopneu.php";
                    echo '<td  ><input style="min-width:30px;" class="form-control"   disabled value="'.$posicao.'" type="text" /></td>';
                ?>
        </tr>
    </table>
</div>
<div class="table-responsive">
    <table class=table>
        <tr><th >Chip Instalado</th><th>Valor de Aquisição</th></tr>
    <?php
    if($numchip===$numserie)
    {
        echo '<td><button type="button" class="btn btn-primary"  onclick="atualiza_chip_pneu('."'".$numserie."'".');">Ler chip</button>';
        echo '<input disabled  class="form-control input-sm" type="hidden" id=chip name=chip placeholder="Leia e Instale o chip" value=""/></td>';
    }
    else 
    { 
        echo '<td><input disabled class="form-control input-sm" type="text" id=chip name=chip value="'.$numchip.'"/></td>';
    }
       
           
    ?>
        <td><input class=" form-control input-sm" type="text" id="valor" value="<?php echo "R$ ".number_format($valor,2,",",".");?>" /></td></tr></table></div>
    <button type="button" class="btn btn-primary"  onclick="atualiza_pneu();">Atualiza o pneu</button>
    <div id="resultado"></div>
</div>
<?php include 'resumo_pneu_operacoes.php'; ?>
</body>
</html>