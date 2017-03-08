
<?php
$numero_chip = $_REQUEST["numero_chip"];
$idcomponente = $_REQUEST["idcomponente"];
$idpessoa = $_REQUEST["idpessoa"];
$cmd = "SELECT * from componente_almox" 
	. " where numero_chip='".$_REQUEST["numero_chip"]."' "
        ." and idpessoa='".$_REQUEST["idpessoa"]."'" 
        . " and idcomponente =".$_REQUEST["idcomponente"]
        . ' order by numero_serie';

$cmd=  mysql_query($cmd);
echo mysql_error();
while($rs=  mysql_fetch_array($cmd))
 {
    $numchip =$rs["numero_chip"];
    $numserie = $rs["numero_serie"];
    $valor=$rs["valor_unitario"];
    $semchip=false; 
    if($numchip==$numserie)
    {
        $semchip=true;
        $mostrachip="Instale e leia a tag";
        $numchip="";
    }
    else {
        $mostrachip=$numero_chip;
        $chip=$numero_chip;
    } 
 }
 
$idpneu=$numero_chip;
echo '<input type=hidden value="'.$numero_chip.'" id=chipsalva name=chipsalva />';
echo '<input type=hidden value="'.$idcomponente.'" id=idcomponente name=idcomponente />'
    .'<input type="hidden" id="chip"  value="'.$chip.'" name="chip" /></div>';

 ?>
<div class="form-group container-fluid">
    <div class="col-sm-3">
        <label for="numserie" >Numero de série</label>
        <input class="form-control" type=text name=numserie id=numserie value="<?php echo $numserie ?>"/> 
    </div>
    <div class="col-sm-3">
        <label for="chipcomponente" >TAG</label>
        <input disabled class="form-control"   type="text" id=chipcomponente disabled name=chip value="<?php echo $mostrachip ?>"/> 
    </div>
    <div class="col-sm-3">
        <label for="valor" >Valor de Aquisição</label>
        <input class="form-control"   type="text" id=valor name=valor value="<?php echo $valor ?>"/> 
    </div>
    <?php
    $imagem="RFID";
    $link="lerchipalmox();"; 
    
    ?>
    <div class="btn-group list-inline" style="margin-left:1rem;">
        <button type="button" onclick="<?php echo $link;?>" class="btn btn-primary">
        LER O CHIP</button>



        <button type=button class="btn btn-primary" onclick="atualizacompalmox();" id="regrastreado">ATUALIZAR O COMPONENTE</button>
    </div>
    <div id="resultado"></div>
    <div class="bg-1" style="width:100%;height:3px;margin:10px;"></div>
</div>     
