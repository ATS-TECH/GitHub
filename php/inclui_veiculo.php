<input type=hidden value="" id=idveiculo name=idveiculo/>  
<div class="table-responsive">
    <h4 class="text-center">Inclusão de veículo</h4>
    <table class="table">
        <tr><th>Placa</th><th>Registro na empresa</th></tr>
        <tr><td>  
                <input class="input form-control" type="text" placeholder="Placa do veículo" id=placa_veiculo name=placa_veiculo value=""/> 
            </td>
            <td>  
                <input class="input form-control" type="text" placeholder="Registro na empresa" id=registro name=registro value=""/> 
            </td>
        </tr>
    </table>
    <table class="table">
        <tr><th>Marca</th><th>Modelo</th><th>Cor</th></tr>
        <tr>
            <td>
                <input class="input form-control" type="text" placeholder="Marca do veículo" id=marca name=marca value=""/> 
            </td>
            <td>
                <input class="input form-control" type="text" placeholder="Modelo do veículo" id=modelo name=modelo value=""/> 
            </td>
            <td>
                <input class="input form-control" type="text" placeholder="Cor do veículo" id=cor name=cor value=""/> 
            </td>
        </tr>
    </table>
    <table class="table">
        <tr><th>Ano de<BR>Fabricação</th><th>Ano do<br>Modelo</th><th>Chip Instalado</th><th>Eixos</th></tr>
        <tr>
            <td><input class="form-control" type="text" placeholder="Ano de fabricação" id=ano name=ano value=""/> 
            </td>
            <td><input class="form-control" type="text" placeholder="Ano do modelo" id=anomodelo name=anomodelo value=""/>
            </td>
            <td><input disabled class="form-control" placeholder="Leia o chip do veículo" type="text" id=chip name=hora value=""/>
            </td>
            <td><input disabled class="form-control"  type="text" id=qtd name=hora value="2"/>
            </td>
        </tr>
    </table>
        <button type="button" class="btn btn-primary" onclick="lerchipveiculo();" id="regrastreado">LER CHIP</button> 
        <button type="button" class="btn btn-primary" onclick="atualizaveiculo('novo');" id="regrastreado">NOVO VEÍCULO</button> 
    <div id="resultado"></div>
</div> 

    

     