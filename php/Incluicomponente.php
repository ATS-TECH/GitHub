<!DOCTYPE html>
<body>

<?php
include 'mysql.php';
 
$idcomponente = $_REQUEST["idcomponente"];
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
 

?>

    <input type="hidden" id="idcomponente" name="idcomponente" value="<?php echo $idcomponente;?>"/>
    <input type=hidden value="<?php echo $_REQUEST['idpessoa']; ?>" id=idpessoa name=idpessoa/>
    <div class="container-fluid">
        
        <h4 class="text-center">INCLUSÃO DE <?php echo $nomefamilia;?>  NO ALMOXARIFADO</h4>
        
        <div class="form-group row" >
        <div class="col-sm-3">
            <input class="form-control" placeholder="Numero de série"  type=text name=numserie id=numserie />
        </div> 
        <div class="col-sm-3">
            <input class="form-control" disabled placeholder="Numero da tag"  type="text" id=chipcomponente disabled name=chip value=""/>
        </div>
        <div class="col-sm-3">
            <input class="form-control" placeholder="Valor de Aquisição"  type="text" id=valor name=valor />
        </div>
         
    </div>
     <div class="row">
         <button type="button" class="btn btn-primary " onclick="lerchipcomponente();" >Ler chip instalado</button> 
         <button type="button" class="btn btn-primary " onclick="incluicomponente();" >Atualizar componente</button> 
     </div>
        <div class="bg-1" style="width:100%;height:3px;margin:10px;"></div>

    
</body> 
</html>
