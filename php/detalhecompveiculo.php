
<?php
$cmd = "SELECT * from componente_almox" 
	. " where numero_chip='".$numero_chip."' "
        ." and idpessoa='".$idpessoa."'" 
        . " and idcomponente=".$idcomponente;
 
$cmd=  mysql_query($cmd);
echo mysql_error();
while($rs=  mysql_fetch_array($cmd))
 {
    $numchip =$rs["numero_chip"];
    $numserie = $rs["numero_serie"];
    $valor = $rs["valor_unitario"];
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
<div class="container-fluid form-group ">
    <div class="col-sm-3">
        <label for="numserie">Numero de série</label> 
        <input class=" form-control" type=text name=numserie id=numserie value="<?php echo $numserie ?>"/> 
    </div>
    <div class="col-sm-3">
        <label for="chipcomponente">TAG</label>
        <input disabled class=" form-control"   type="text" id=chipcomponente disabled name=chip value="<?php echo $mostrachip ?>"/> 
    </div>
        <div class="col-sm-3">
        <label for="valor">Valor de Aquisição</label>
        <input class=" form-control" id="valor"  type="number" id=chipcomponente name=valor value="<?php echo $valor ?>"/> 
    </div>

</div>
<div class="container-fluid">
    <button type=button class="btn btn-primary" onclick="atualizacompalmox();" id="regrastreado">ATUALIZAR O COMPONENTE</button>
    <button type=button class="btn btn-primary" onclick="lerchipalmox();" id="regrastreado">LER CHIP</button>

    <button type=button class="btn btn-primary" 
            onclick="desmontacomp(<?php echo $idcomponente.",'".$numero_chip."','".$numero_chip."'"; ?>);" 
            id="regrastreado">DESINSTALAR</button>
</div>
<div id="resultado"></div>
     

