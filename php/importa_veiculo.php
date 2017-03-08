<div class="container-fluid bg-2" style="padding-left: 20px;">
    <h4 class="container-fluid text-center">Importação de veículos</h4>
    
    <p class="textarea">Dados de importação de Veículos:<br>
        Arquivo CSV separado por ";":<br>
    <br>
    1) Registro do veiculo (Identificação ÚNICA do veículo na frota)<br>
    2) Placa do veiculo <br>
    3) Marca<br>
    4) Modelo do veiculo<br>
    5) Ano do veiculo<br>
    6) Cor do veiculo<br>
    7) Ano do modelo do veiculo<br>
    
    </p>

    <input type="file" id="file" name="files"  onchange="importaCSV();" 
           class="filestyle" data-icon="false" data-buttonText="Arquivo"
           data-buttonName="btn-primary" data-size="sm" data-placeholder="Arquivo CSV a ser importado" />
    <output id="list"></output>

    <div id="tabela"></div>
    
</div>
<script>
    var file = document.getElementById('file');
//    file.addEventListener('change', function() 
    {
        var reader = new FileReader();
        var f = file.files[0];
        reader.onload = function(e) 
        {
            makeTable(e.target.result); //this is where the csv array will be
        };
        reader.readAsText(f);
    });
</script>


