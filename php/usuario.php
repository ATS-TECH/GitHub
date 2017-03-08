<div class="form-group">
<?php
include 'mysql.php';
$idpessoa=$_REQUEST["idpessoa"];
$idusuariot=$_REQUEST["idusuariot"];
$idusuario=$_REQUEST["idusuario"];
if($idusuariot===null||$idusuariot==="")
{
   $idusuariot=$idusuario; 
}

$cmd = 'SELECT idpessoa, idusuario,chip, nomeusuario,usuario,'
        . ' senha, idpessoa, telefone, email from usuario'
     .' where idpessoa='.$idpessoa." and idusuario in (".$idusuariot.") ";


$resultado=mysql_query($cmd);

if(mysql_error()!=="")
{
    echo mysql_error()."1".$cmd;
}

while ($row = mysql_fetch_array($resultado)) 
{

    $chip=$row["chip"];
    $nomeusuario=$row["nomeusuario"];
    $usuario=$row["usuario"];
    $idpessoa=$row["idpessoa"];
    $senhabanco=$row["senha"];
    $email=$row["email"];
    $telefone=$row["telefone"];
}
$cmd = "SELECT gestor,adm_veiculo,adm_almox,adm_portaria,adm_usuario,adm_rastreado
FROM usuario_pessoa  where idpessoa=".$idpessoa." and idusuario in ('".$idusuario."')";

$result=  mysql_query($cmd);
if(mysql_error()!="")
{
    echo mysql_error()."2".$cmd;
}
while ($row = mysql_fetch_array($result)) 
{
    $gestororg=$row["gestor"];
}
$cmd = "SELECT idusuario,gestor,adm_veiculo,adm_almox,adm_portaria,adm_usuario,adm_rastreado
FROM usuario_pessoa  where idpessoa=".$idpessoa." and idusuario in ('".$idusuariot."')";

$result=  mysql_query($cmd);
if(mysql_error()!="")
{
    echo mysql_error()."2".$cmd;
}
while ($row = mysql_fetch_array($result)) 
{
    $gestor=$row["gestor"];
    $adm_veiculo=$row["adm_veiculo"];
    $adm_almox=$row["adm_almox"];
    $adm_portaria=$row["adm_portaria"];
    $adm_usuario=$row["adm_usuario"];
    $adm_rastreado=$row["adm_rastreado"];
}
if($gestororg==="S")
{
    $cmd = "SELECT idusuario, nomeusuario from usuario "
         ."  where idpessoa=".$idpessoa." order by nomeusuario";

    $result=  mysql_query($cmd);
    if(mysql_error()!="")
    {
        echo mysql_error()."3".$cmd;
    }
    echo '<div class="container-fluid btn-group"><button type="button" class="btn dropdown-toggle"
                   role="button"  
                   data-toggle="dropdown" href="#">Selecione o usuário
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" 
                    style="cursor:pointer;font-size: 11px;letter-spacing: 1px;padding: 3px;width:270px;" 
                    role="menu">';
    while ($row = mysql_fetch_array($result)) 
    {
        echo '<li onclick="outrousu('.$row["idusuario"].');">'.$row["nomeusuario"].'</li>';
    }
    echo '</ul></div>';
}
?>

<div class="container-fluid">
    <input class="form-control" name="nameusu" type="hidden"
              value="<?php echo $idusuariot; ?>"  id="idusuariot" />
    <h4>Cadastro do usuário</h4>
    <div class="input-group col-sm-4">
        <label class="labellegend" for="nameusu">Nome</label>
        <input class="form-control" name="nameusu" type="text"
              value="<?php echo $nomeusuario; ?>"  id="nameusu" />
    </div>
    <div class="input-group col-sm-4">
        <label class="labellegend" for="email">Email</label>
        <input class=" form-control"  name="email" type="text" 
               value="<?php echo $email; ?>" id="email" /></div>
    <div class="input-group col-sm-3">
        <label class="labellegend" for="telefone" >telefone</label>
        <input class="form-control"  name="telefone" type="text" 
               value="<?php echo $telefone; ?>" id="telefone" /></div>
    <div class="input-group">
        <label class="labellegend" for="usuario" >Usuário</label>
        <input class="form-control" name="username" type="text" 
               value="<?php echo $usuario; ?>" id="username" /></div>
    <div class="input-group">
        <label class="labellegend" for="senha">Senha</label> 
        <input class="form-control" name="password" type="password" 
               placeholder="Senha" id="passwordusu" /></div>
    <div class="input-group">
        <label class="labellegend" for="confsenha">Confirma Password</label>
        <input class="form-control" name="password2" type="password" 
               placeholder="Confirma Password" id="confirmpassword" /></div>
    <br>           
    
        <?php 
        if($gestororg==='S')
        {
            echo '<fieldset><legend>Autoridades</legend>';
            echo '<div class="input-group col-sm pull-left" style="padding:10px;">';
            echo '<label class="labellegend" for="Lgestor">Gestor</label><br>';
            if($gestor==='S')
            {
                echo '<label id=Lgestor class="switch">
                       <input checked type="checkbox"  value="'.$gestor.'"  id="gestor"  onchange="checkauto(0);"/>
                       <div class="slider round"></div>
                   </label>';
            }
            else
            {
                echo '<label  id=Lgestor class="switch">
                       <input  type="checkbox"  value="'.$gestor.'"  id="gestor"  onchange="checkauto(0);"/>
                       <div class="slider round"></div>
                   </label>';
            }
            echo '</div>';

            echo '<div class="input-group col-sm pull-left" style="padding:10px;">';
            echo '<label class="labellegend" for="Lveiculo">Veículo</label><br>';
           if($adm_veiculo==='S')
            {
                echo '<label  id=Lveiculo class="switch">
                       <input checked type="checkbox"  value="'.$adm_veiculo.'"  id="veiculo"  onchange="checkauto(1);"/>
                       <div class="slider round"></div>
                   </label>';         }
            else
            {
                echo '<label  id=Lveiculo class="switch">
                       <input type="checkbox"  value="'.$adm_veiculo.'"  id="veiculo"  onchange="checkauto(1);"/>
                       <div class="slider round"></div>
                   </label>';         }
            echo '</div>';
            echo '<div class="input-group col-sm  pull-left" style="padding:10px;">';
            echo '<label labelfor="Lalmox" class="labellegend">Almoxarifado</label><br>';
            if($adm_almox==='S')
            {
                echo  '<label  id=Lveiculo class="switch">
                       <input checked type="checkbox"  value="'.$adm_almox.'"  id="almox" class="" onchange="checkauto(2);" />';
                echo  '<div class="slider round"></div>
                   </label>';
            }
            else
            {
                echo  '<label  id=Lveiculo class="switch">
                       <input type="checkbox"  value="'.$adm_almox.'"  id="almox" class="" onchange="checkauto(2);" />';
                echo  '<div class="slider round"></div>
                   </label>';
            }
            echo '</div>';

            echo '<div class="input-group col-sm  pull-left" style="padding:10px;">';
            echo '<label labelfor="Lusu" class="labellegend">Institucional</label><br>';
            if($adm_usuario==='S')
            {
                echo  '<label  id=Lusu class="switch">
                       <input checked type="checkbox"  value="'.$adm_usuario.'"  id="usu" class="" onchange="checkauto(3);"/>';
                echo  '<div class="slider round"></div>
                   </label>';
            }
            else
            {
                echo  '<label  id=Lusu class="switch">
                       <input type="checkbox"  value="'.$adm_usuario.'"  id="usu" class="" onchange="checkauto(3);"/>';
                echo  '<div class="slider round"></div>
                   </label>';
            }
            echo '</div>';

            echo '<div class="input-group col-sm  pull-left" style="padding:10px;">';
            echo '<label labelfor="Lporta" class="labellegend">Inspeção</label><br>';
            if($adm_portaria==='S')
            {
                echo  '<label  id=Lporta class="switch">
                       <input checked type="checkbox"  value="'.$adm_portaria.'"  id="portaria" class="" onchange="checkauto(4);"/>';
                echo  '<div class="slider round"></div>
                   </label>';
            }
            else
            {
                echo  '<label  id=Lporta class="switch">
                       <input type="checkbox"  value="'.$adm_portaria.'"  id="portaria" class="" onchange="checkauto(4);"/>';
                echo  '<div class="slider round"></div>
                   </label>';
            }
            echo '</div>';
            echo '<div class="input-group col-sm  pull-left" style="padding:10px;">';
            echo '<label labelfor="Lporta" class="labellegend">Administrador</label><br>';
            if($adm_rastreado==='S')
            {
                echo  '<label  id=Lrastro class="switch">
                       <input checked type="checkbox"  value="'.$adm_rastreado.'"  id="rastro" class="" onchange="checkauto(5);"/>';
                echo  '<div class="slider round"></div>
                   </label>';
            }
            else
            {
                echo  '<label  id=Lrastro class="switch">
                       <input type="checkbox"  value="'.$adm_rastreado.'"  id="rastro" class="" onchange="checkauto(5);"/>';
                echo  '<div class="slider round"></div>
                   </label>';
            }
            echo '</div></fieldset>';
        }
        
        ?>
    
</div> 
<div class='form-group'>
    <br>
    <input class="form-control" type=hidden id=idusuariot value="<?php echo $idusuario;?>" />
    <button class="btn btn-primary" onclick="atualizausuario();" id="regusu">Atualiza Usuário</button>  
    <button class="btn btn-primary" onclick="injeta('php/novousuario.php','page-wrapper','page-wrapper', 'slide','page-wrapper');" id="regusu">Novo Usuário</button>';
</div>

</div> 