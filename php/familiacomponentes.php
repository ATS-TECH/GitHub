
<?php
include 'mysql.php';
$idcomponente = $_REQUEST["idcomponente"];
echo '<input type=hidden id=idcomponente value="'.$idcomponente.'" />'; 

$idpessoa = $_REQUEST["idpessoa"];

$idpneu=$numero_chip;
$cmd="select * from componente where idcomponente=".$_REQUEST['idcomponente']." and idpessoa=".$idpessoa;
$cmd=  mysql_query($cmd);
$ispneu="N";
while($rs= mysql_fetch_array($cmd))
{
    $ispneu=$rs["ispneu"];
    $nomefamilia=$rs["descrComponente"];
    $cindqrcode=$rs["cindqrcode"];
    $cindbeacon=$rs["cindbeacon"];
    $cindchipado=$rs["cindchipado"];
    $cindbarras=$rs["cindbarras"];
    $cindmanual=$rs["cindmanual"];
}
echo '<input placeholder="Nome da família de componentes"  type=text name=nomefamilia value="'.$nomefamilia.'" id=nomefamilia  />';
if($ispneu==="S"){$icpneu="OKpneu";} else {$icpneu="pneu";};
if ($cindqrcode==="S"){$iccqrcode="OKqrcode";} else {$iccqrcode="qrcode";};
if ($cindbeacon==="S"){$iccbeacon="OKbeacon";} else {$iccbeacon="beacon";};
if ($cindchipado==="S"){$iccchipado="OKrfid";} else {$iccchipado="rfid";};
if ($cindbarras==="S"){$iccbarras="OKcodbarras";} else {$iccbarras="codbarras";};
if ($cindmanual==="S"){$iccmanual="OKlupa";} else {$iccmanual="lupa";};
echo '<h4 class="text-center">Identificação de '.$nomefamilia.'</h4>';
echo '<div class=row >
        <div class="col-xs-1 text-center" onclick="checkcomponente(12);" >
        <div class=row >PNEU</div>
        <div class=row ><img id="ciqrcode" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$icpneu.'.png" class="backgroudimage" />
        </div></div><input name="cindpneu" type="hidden"  value="'.$ispneu.'"  id="cindpneu" />
        
        <div  class="col-xs-1  text-center" onclick="checkcomponente(7);"   style="text-align:center;" >
        <div class=row >QRCODE</div>
        <div class=row ><img id="ciqrcode" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccqrcode.'.png" class="backgroudimage" />
        </div></div><input name="cindqrcode" type="hidden"  value="'.$cindqrcode.'"  id="cindqrcode" />

        <div  class="col-xs-1  text-center" onclick="checkcomponente(8);"   style="text-align:center;">
        <div class=row >BEACON</div>
        <div class=row ><img id="cibeacon" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccbeacon.'.png" class="backgroudimage" />
        </div></div><input name="cindbeacon" type="hidden"  value="'.$cindbeacon.'"   id="cindbeacon" />

        <div  class="col-xs-1  text-center" onclick="checkcomponente(9);"   style="text-align:center;">
        <div class=row >RFID</div>
        <div class=row ><img id="cichipado" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccchipado.'.png" class="backgroudimage" />
        </div></div><input name="cindchipado" type="hidden"  value="'.$cindchipado.'"  id="cindchipado" />

        <div  class="col-xs-1  text-center" onclick="checkcomponente(10);"   style="text-align:center;">
        <div class=row >BARCODE</div>
        <div class=row ><img id="cibarras" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccbarras.'.png" class="backgroudimage" /> 
        </div></div><input name="cindbarras" type="hidden" value="'.$cindbarras.'" id="cindbarras" />

        <div  class="col-xs-1  text-center" onclick="checkcomponente(11);"   style="text-align:center;">
        <div class=row >VISUAL</div>
        <div class=row ><img id="cimanual" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccmanual.'.png" class="backgroudimage" />
        </div></div> <input name="cindmanual" type="hidden" value="'.$cindmanual.'" id="cindmanual" />
    </div> 
  <button type="button" class="btn-primary" onclick="atualizafamilia();" >Atualiza a família</button>
  
  <button type="button" class="btn-primary" onclick="listacomponenentes();" >Componentes</button>';
?>
