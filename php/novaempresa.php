<center>

    <h4 class="text-center">SEJA BEM VINDO AO TRUCK ID</h4>
    <form class="form-group"  >
        <div class="input-group">
            <label class="pull-left" for="nomeemp">Nome da empresa</label>
            <input type="text" style="margin:1rem;" class="input form-control" 
                   name="company" type="text" placeholder="Empresa" id="nomeemp" />
        </div>
        <div class="input-group">
            <label class="pull-left" for="cnpj">CNPJ</label>
            <input type="text" style="margin:1rem;" class="form-control" name="cnpj" type="text" placeholder="CNPJ" id="cnpj" />
        </div>
        <div class="input-group">
            <label class="pull-left" for="email">e_mail</label>
            <input type="email" style="margin:1rem;"  name="email" type="email" placeholder="Email" class="form-control"  id="email" />
        </div>
        <div class="input-group">
            <label class="pull-left" for="telefone">Telefone</label>
            <input type=tel style="margin:1rem;"  class="form-control"  name="telefone" type="tel" placeholder="Telefone" id="telefone" />
        </div>
        <button type=button class="btn btn-primary" onclick="criaemp();" >Cria a empresa</button>
    </form>
</center>