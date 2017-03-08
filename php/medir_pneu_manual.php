
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
<input type=hidden value="" id=idveiculo name=idveiculo/>
<input type=hidden value="<?php echo $numchip; ?>" id=idpneu name=idpneu/>
<div class="container">
<h4 class="text-center">Medição manual de pneus</h4>
<h4 class="text-center"><?php echo "PNEU: ".$numserie." - ".$medida." - ".$marca." / ".$modelo."<br></h4>";?></div> 
<div class="contfalhas">
 <div class="form-group input-group-sm">
     <div class="col-sm-3">
         <input class="form-control" type="number" class="input" id="sulco1" placeholder="SULCO 01"/>
        <?php 
           $chip = $numchip;
           $sulco = 1;
           include 'mostra_sulco.php';
        ?>
        <button type="button" class="btn btn-primary" onclick="gravamedidasulco(1)" >Gravar Sulco 01</button>
     </div>
     <div class="col-sm-3">
        <input class="form-control" type="number" class="input" id="sulco2" placeholder="SULCO 02"/>
        <?php 
           $chip = $numchip;
           $sulco = 2;
           include 'mostra_sulco.php';
        ?>
        <button type="button" class="btn btn-primary" onclick="gravamedidasulco(2)" >Gravar Sulco 02</button>
       
    </div>
    <div class="col-sm-3">  
         <input class="form-control" type="number" class="input" id="sulco3" placeholder="SULCO 03"/>
        <?php 
           $chip = $numchip;
           $sulco = 3;
           include 'mostra_sulco.php';
        ?> 
        <button type="button" class="btn btn-primary" onclick="gravamedidasulco(3)" >Gravar Sulco 03</button>
    </div>
     <div class="col-sm-3">
        <input class="form-control" type="number" class="input" id="sulco4" placeholder="SULCO 04"/>

            <?php 
           $chip = $numchip;
           $sulco = 4;
           include 'mostra_sulco.php';
        ?>
        <button type="button" class="btn btn-primary" onclick="gravamedidasulco(4)" >Gravar Sulco 04</button>
</div>

</div>
    <script src="js/jquery.js" type="text/javascript"></script>
     
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>



    