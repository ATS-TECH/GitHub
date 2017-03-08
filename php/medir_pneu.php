<?php
$numchip = $_REQUEST["numero_chip"];
// SERVIÇO 
  
$link1="php/detalhepneu.php?numero_chip=".$numchip; 
$link2="php/graph_pneu_mm.php?numero_chip=".$numchip;
$link3="php/graph_pressao.php?numero_chip=".$numchip;
$link4="php/graph_pressao_relogio.php?numero_chip=".$numchip;
$link5="php/graph_pneus_falhas.php?numero_chip=".$numchip;
$link6="php/resumo_pneu_mm.php?numero_chip=".$numchip;
 
$link8="php/resumo_pneu_mm.php?numero_chip=".$numchip;

$idpessoa=$_REQUEST["idpessoa"];
include 'mysql.php';
$cmd = "SELECT * from pneu where numero_chip in ('".$_REQUEST["numero_chip"]."') and idpessoa='".$idpessoa."'";  

$cmd=  mysql_query($cmd);
echo mysql_error();
while($rs=  mysql_fetch_array($cmd))
{
      $marca=$rs["marca"];
      $modelo=$rs["modelo"];
      $medida=$rs["medida"];
      $numserie=$rs["numero_serie"];
      $numchip=$rs["numero_chip"];
      $vida=$rs["vida"];
      $banda=$rs["banda"];
      $eixo=$rs["eixo"];
      $roda=$rs["roda"];
}

?>
<input type=hidden value="<?php echo $_REQUEST["idcomponente"]; ?>" id=idcomponente name=idcomponente/>   
<input type=hidden value="<?php echo $numchip; ?>" id=idpneu name=idpneu/>
<div class="container-fluid form-group input-group-sm">
     <div class="col-sm-5">
        <input class="form-control" type="text" class="input" id="sulco1" placeholder="SULCO 01"/>
        <?php 
           $chip = $numchip;
           $sulco = 1;
           include 'mostra_sulco.php';
        ?>
        <button type="button" class="btn btn-primary" onclick="lermedidasulco(1)" >Medir Sulco 01</button>
     </div>
     <div class="col-sm-5">
        <input class="form-control" type="text" class="input" id="sulco2" placeholder="SULCO 02"/>
        <?php 
           $chip = $numchip;
           $sulco = 2;
           include 'mostra_sulco.php';
        ?>
        <button type="button" class="btn btn-primary" onclick="lermedidasulco(2)" >Medir Sulco 02</button>
       
    </div>
    <div class="col-sm-5">  
         <input class="form-control" type="text" class="input" id="sulco3" placeholder="SULCO 03"/>
        <?php 
           $chip = $numchip;
           $sulco = 3;
           include 'mostra_sulco.php';
        ?> 
        <button type="button" class="btn btn-primary" onclick="lermedidasulco(3)" >Medir Sulco 03</button>
    </div>
     <div class="col-sm-5">
        <input class="form-control" type="text" class="input" id="sulco4" placeholder="SULCO 04"/>

            <?php 
           $chip = $numchip;
           $sulco = 4;
           include 'mostra_sulco.php';
        ?>
     
        <button type="button" class="btn btn-primary" onclick="lermedidasulco(4)" >Medir Sulco 04</button>
    </div>
</div>

</div>
    <script src="js/jquery.js" type="text/javascript"></script>
     
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>



    