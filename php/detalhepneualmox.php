<?php
$idpessoa=$_REQUEST["idpessoa"];
if(isset($_REQUEST["numero_chip"]))
{
    $idpneu = $_REQUEST["numero_chip"];
}
include 'mysql.php';
$cmd = "SELECT * from pneu"
        . "  where  idpessoa=".$idpessoa
        . " and numero_chip in ('".$idpneu."')";  

$result=  mysql_query($cmd);
if(mysql_error()!=="")
{
    echo mysql_error().$cmd;
}
while($rs=  mysql_fetch_array($result))
{
      $marca=$rs["marca"];
      $modelo=$rs["modelo"];
      $idpessoa=$rs["idpessoa"];
      $medida=$rs["medida"];
      $numserie=$rs["numero_serie"];
      $numchip=$rs["numero_chip"];
      $vida=$rs["vida"];
      $banda=$rs["banda"];
      $eixo=$rs["eixo"];
      $roda=$rs["roda"];
}
echo '<input id=idpneudet name=idpneu type=hidden value="'.$numchip.'" />';

?>
<label class="text-info pull-right" style="margin:1rem;margin-right: 20px;"><i class="fa fa-arrow-circle-down" onclick="limpadiv('page-wrapper');" >Fechar</i></label>
<h4 class="text-center">Detalhes do pneu</h4>
<div class="container-fluid table-responsive">
    <table class=table style="width: 95%;">
        <tr><th >Medida</th><th >Marca</th><th >Modelo</th></tr>
        <tr><td>
            <input class="input form-control" type="text" id=medida name=medida value="<?php echo $medida ?>"/> 
        </td>
        <td> 
            <input class="input form-control" type="text" id=marca name=marca value="<?php echo $marca; ?>"/> 
        </td>
        <td>
            <input class="input form-control" type="text" id=selmodelo name=marca value="<?php echo $modelo; ?>"/>
        </td>
           </td> 
        </tr>
    </table>
    
    <table class=table  style="width: 95%;">
        <tr><th >Marca de Fogo</th>
            <th  >Banda de rodagem</th>
            <th >Vida</th>
            <th >Chip</th>
            <th >Valor de aquisição</th>
             </tr>
        <tr >
            <td >
                <input disabled class="input form-control" type="text" id=numserie name=numserie value="<?php echo $numserie ?>"/> 
            </td>
            <td>
                <input class="input form-control" type="text" id=banda name=banda value="<?php echo $banda ?>"/> 
            </td>
            <td>
            <select class="select form-control" id=vida name=vida>
                <?php
                    for($ixvida=1;$ixvida<8;$ixvida++)
                    {
                        if($ixvida==$vida)
                        {
                            echo '<option selected value='.$ixvida.'>'.$ixvida.'</option>';
                        }
                        else
                        {
                            echo '<option value='.$ixvida.'>'.$ixvida.'</option>';
                        }
                    }

                ?>
            </select>  
            </td>
            <td>
                <?php
                    if($idpneu!==$numserie)
                    {
                        echo '<input disabled class="input-sm form-control" 
                            type="text" id=chip name=chip value="'.$idpneu.'" />'; 
                    }
                    else {
                        echo '<input disabled class="input-sm form-control" 
                            type="text" id=chip name=chip value="" placeholder="Leia o chip do pneu e atualize" />';
                    }?>
            </td>
            <?php
            $cmd = "SELECT idcomponente, valor_unitario from "
                    . "componente_almox where idpessoa=".$idpessoa
                    ." and numero_chip in ('".$idpneu."')" ;  

            $result=  mysql_query($cmd);
            if(mysql_error()!=="")
            {
                echo mysql_error().$cmd;
            }
            while($rs=  mysql_fetch_array($result))
            {
                  $idcomponente=$rs["idcomponente"];
                  $valor=$rs["valor_unitario"];
            }
            echo '<input id=idcomponente type=hidden value="'.$idcomponente.'" />';
            ?>
            <td><input class="input-sm form-control" type="text" id="valor" value="<?php echo "R$ ".number_format($valor,2,",",".");?>" /></td>
        </tr>
    </table>
    </div>
    <div class="container-fluid table-responsive"  style="width: 95%;">
        <table class=table  style="width: 95%;">
            <tr><th>Falhas Registradas</th><th>Data de Registro</th><th></th></tr>   
    <?php 
        $cmd = "SELECT idfalhas,descrfalha, dataregistro FROM falhas, falhas_pneu"
                . " where idfalhas=idfalhas_pneu"
                . " and numero_chip in ('".$idpneu."')";
        $cmd=  mysql_query($cmd);
        echo mysql_error();
        $contafalha=0;
        while($rs=  mysql_fetch_array($cmd))
        {
            
            echo '<tr><td><input disabled class="col-sm-2 form-control" type="text" id=falha'.$rs["idfalhas"].' name=falha'.$rs["idfalhas"]
                    ." value=".$rs["descrfalha"].'" /></td>';
            echo '<td><input disabled class="col-sm form-control" type="text" id=dataregistro'
                    ." value=".date_format(date_create($rs["dataregistro"]),"d/m/Y H:i").'" /></td>';
            echo '<td class="btn" style="padding:5px;text-align:left;" onclick="excluifalhaalmox('
                    .$rs["idfalhas"].",'".$rs["dataregistro"]."'"
                    .')"><i class="fa fa-remove"></i></td></tr>';
            
        }
    ?>
        </table>
        <br>
    <div class="container-fluid"  style="width: 95%;">
    <th>Registro de Falhas</th>
    
    <select id="selfalhas" class="select form-control">
        <?php 
            $cmd = "SELECT idfalhas,descrfalha FROM falhas";


            $cmd=  mysql_query($cmd);
            echo mysql_error();
            while($rs=  mysql_fetch_array($cmd))
            {
                echo '<option value='.$rs["idfalhas"].'>'.$rs["descrfalha"].'</option>';
            }
        ?>
        </select>
        <button type="button" class="btn btn-primary" onclick="falhaspneualmox('<?php echo $idpneu ?>');">Registrar falha</button>
        <button type="button" class="btn btn-primary"  onclick="atualiza_pneu();">Atualiza o pneu</button>
        <button type="button" class="btn btn-primary"  onclick="sucata();">Sucata</button>
        <div id="resultado"></div>
    </div>
        <?php 
        $idpneu=$numchip;
        include 'resumo_pneu_operacoes.php'; ?>
</body>
</html>