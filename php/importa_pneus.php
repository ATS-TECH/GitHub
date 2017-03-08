<h4 class="text-center">Importação de pneus</h4>
<p class="container-fluid textarea">Dados de importação de pneus:<br>
    Arquivo CSV separado por ";":<br>
<br>
1) Registro do veiculo (Identificação ÚNICA do veículo na frota se montado)<br>
2) Marca de fogo (Identificação ÚNICA do pneu na frota)<br>
3) Medida do pneu <br>
4) Marca do pneu<br>
5) Modelo do pneu<br>
5) Vida (1,2,3...)<br>
6) Banda<br>
7) Eixo (1,2,3...)<br>
8) Roda (1,2,3 ou 4)<br>
</p>
 
<input type="file" id="file" name="files"  onchange="importaCSV();"  />
<output id="list"></output>
<div id="tabela"></div>
<script>
    var file = document.getElementById('file');
//    file.addEventListener('change', function() 
    {
        var reader = new FileReader();
        var f = file.files[0];
        reader.onload = function(e) 
        {
            makePneu(e.target.result); //this is where the csv array will be
        };
        reader.readAsText(f);
    }
    
</script>


