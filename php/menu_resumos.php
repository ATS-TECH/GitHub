<nav class="container-fluid navbar navbar-default navbar-left" style="width: 98%;padding:1rem;">
    <div class="input-group col-sm-3 pull-left">
        <label for="dataini">Data Inicial</label>
        <input type='date' lang="pt-BR" style="margin: 1rem;" class="datepicker" id=dataini data-provide="datepicker"  /> 
    </div>
    <div class="input-group col-sm-3 pull-left">    
        <label for="datafim">Data Final</label>
        <input type='date' lang="pt-BR" style="margin: 1rem;" class="datepicker" id=datafim data-provide="datepicker"  /> 
    </div>
    <button type="button" class="btn btn-primary pull-left" onclick="reloadresumo()">Redefinir Intervalo</button>
</nav>
<div id="areahist" class="container-fluid"></div>
    <script>
        $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
        $('.dataini').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '-3d'
        });
        
    </script>
</body>
</html>