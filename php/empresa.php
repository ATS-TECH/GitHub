<h4 class="text-center">Dados da empresa, mantenha atualizado</h4>

    <form class="container form-group">
<?php
  include 'mysql.php';
  $cmd="SELECT idpessoa,razao_social,cnpj,email,telefone FROM pessoa_juridica "
          . " where idpessoa  in (".$_REQUEST["idpessoa"].")";
  
  $result=  mysql_query($cmd);
  echo mysql_error();
  while($rs=  mysql_fetch_array($result))
  {
    echo  '<div class="input-group">
            <label class="pull-left" for="nomeemp">Nome da empresa</label>
            <input type="text" style="margin:1rem;" class="input form-control" 
                   name="company" type="text" placeholder="Empresa"value ="'.$rs["razao_social"].'" id="nomeemp" />
        </div>
        <div class="input-group">
            <label class="pull-left" for="cnpj">CNPJ</label>
            <input type="text" style="margin:1rem;" class="form-control" name="cnpj" type="text" value ="'.$rs["cnpj"].'" id="cnpj" />
        </div>
        <div class="input-group">
            <label class="pull-left" for="email">e_mail</label>
            <input type="email" style="margin:1rem;"  name="email" type="email" value ="'.$rs["email"].'" class="form-control"  id="email" />
        </div>
        <div class="input-group">
            <label class="pull-left" for="telefone">Telefone</label>
            <input type=tel style="margin:1rem;"  class="form-control"  name="telefone" type="tel" value ="'.$rs["telefone"].'" id="telefone" />
        </div>';
        

  }
  echo '<button  class="btn btn-primary" onclick="atualizaemp('.$rs["idpessoa"].');"  id="register">Atualiza empresa</button>';
?>
    </form>
    <div id=mensagememp></div>
