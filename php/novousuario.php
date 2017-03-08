<h4 class="">Criação de Usuário</h4>
<form class="form-group"  >
    <div class="input-group">
        <input class="input form-control" type="text" placeholder="Nome" id="nameusu" style="margin:1rem" />
    </div>
    <div class="input-group">
        <input class="input form-control" name="email" type="email" placeholder="Email" id="email" style="margin:1rem"/>
    </div>
    <div class="input-group">    
        <input class="input form-control" name="username" type="text" placeholder="Usuário" id="username" style="margin:1rem"/>
    </div>
    <div class="input-group">
        <input class="input form-control" name="password" type="password" placeholder="Senha" id="passwordusu" style="margin:1rem"/>
    </div>
    <div class="input-group">
        <input class="input form-control" name="password2" type="password" placeholder="Confirma Senha" id="confirmpassword" style="margin:1rem"/>
    </div>  
    
<!--    <ul class="nav navbar-nav" style="margin:1rem">
        <li><a id="igestor" class="icon check"style="text-align:center">-->
            <input class="checkbox-inline" checked name="gestor" type="hidden"  value="S"  id="gestor" />
            <!--<label class="pressed" style="padding-left:8px" onclick="checkauto(0);">GESTOR</label>-->
<!--        </a></li>
        <li><a id="iadmveiculo" class="icon check"style="text-align:center">-->
            <input class="checkbox-inline" checked name="admveiculo" type="hidden"  value="S"  id="admveiculo" />
            <!--<label class="pressed" style="padding-left:8px" onclick="checkauto(1);" >VEÍCULOS</label>-->
<!--        </a></li>
        <li><a id="iadmalmox" class="icon check"style="text-align:center">-->
            <input class="checkbox-inline" checked name="admalmox" type="hidden"  value="S"   id="admalmox" />
<!--            <label class="pressed" style="padding-left:8px" onclick="checkauto(2);" >ALMOXARIFADO</label>-->
<!--        </a></li>
        <li><a id="iadmusuario" class="icon check"style="text-align:center">-->
            <input class="checkbox-inline" checked name="admusuario" type="hidden"  value="S"  id="admusuario" />
            <!--<label class="pressed" style="padding-left:8px" onclick="checkauto(3);" >USUÁRIO</label>-->
<!--        </a></li>
        <li><a id="iadmrastreado" class="icon check"style="text-align:center">-->
            <input class="checkbox-inline" checked name="admrastreado" type="hidden" value="S" id="admrastreado" />
            <!--<label class="pressed" style="padding-left:8px" onclick="checkauto(4);" >RASTREADO</label>-->
<!--        </a></li>
    </ul>-->
    <button type="button" class="btn btn-primary" onclick="signUp();" id="regusu">CRIA USUÁRIO</button>
    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
        </fb:login-button>

        <div id="status">
    </div>
 </form>
   

