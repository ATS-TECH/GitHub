<div class="container-fluid ">

    <table class=table style="margin:20px;width:100%;">
        <tr><th colspan="1">Identificação dos componentes</th></tr>
    <tr>
        <td><input placeholder="Nome da família de componentes" 
             class="col-sm-2 form-control" type=text name=nomefamilia value="" id=nomefamilia  /></td>
    
        <td class="col-sm-2" >
            <label for="cindpneu">Família de pneus</label>
                <input type="checkbox" class="checkbox-inline" id="cindpneu" 
               onclick="checkrastreado('cindpneu');" value="N" />
    </td>
    </tr> 
        
<!--        <td class="minicard" onclick="checkrastreado(7);"  width=16.65% style="text-align:center;" ><img id="ciqrcode" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccqrcode.'.png" class="backgroudimage" />
        </td><input name="cindqrcode" type="hidden"  value="N"  id="cindqrcode" />

        <td class="minicard" onclick="checkrastreado(8);"  width=16.65% style="text-align:center;"><img id="cibeacon" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccbeacon.'.png" class="backgroudimage" />
        </td><input name="cindbeacon" type="hidden"  value="N"   id="cindbeacon" />

        <td class="minicard" onclick="checkrastreado(9);"  width=16.65% style="text-align:center;"><img id="cichipado" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccchipado.'.png" class="backgroudimage" />
        </td><input name="cindchipado" type="hidden"  value="N"  id="cindchipado" />

        <td class="minicard" onclick="checkrastreado(10);"  width=16.65% style="text-align:center;"><img id="cibarras" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccbarras.'.png" class="backgroudimage" /> 
        </td><input name="cindbarras" type="hidden" value="N" id="cindbarras" />

        <td class="minicard" onclick="checkrastreado(11);"  width=16.65% style="text-align:center;"><img id="cimanual" style="float:none;padding-left:3px;padding-top:5px;" src="./images/'.$iccmanual.'.png" class="backgroudimage" />
        </td> <input name="cindmanual" type="hidden" value="N" id="cindmanual" />-->
    </table>
  <button  class="btn btn-primary" onclick="novafamilia();" >Cria a família</button>   
</div>