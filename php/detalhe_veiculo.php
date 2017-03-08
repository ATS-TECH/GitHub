
<?php
$numero_chip = $_REQUEST["numero_chip"];
$idpessoa = $_REQUEST["idpessoa"];
$idrastreado = $_REQUEST["idrastreado"];
// SERVIÇO 
 include 'mysql.php';
 $cmd = "select * from veiculo where chip_veiculo in ('".$numero_chip. "') "
         . " and idpessoa =".$idpessoa;
    
     
    $res = mysql_query($cmd);
    echo mysql_error();
    
    
    while($rs = mysql_fetch_array($res))
    {
        $numchip=$rs["chip_veiculo"]; 
        $idpessoa=$rs["idpessoa"]; 
        $registro=$rs["registro_veiculo"];
        $marca= $rs["marca"];
        $modelo_veiculo = $rs["modelo_veiculo"];
        $cor_veiculo=$rs["cor_veiculo"];
        $ano_veiculo=$rs["ano_veiculo"];
        $ano_modelo=$rs["ano_modelo_veiculo"];
        $qtdeixos= $rs["qtdeixos"];
        $km_veiculo=$rs["km_veiculo"];
        $hora_veiculo=$rs["hora_veiculo"];
        $placa_veiculo=$rs["placa_veiculo"];
    }
    ?>
<h4 class="text-center">Detalhes do veículo</h4>    
    <input type=hidden value="<?php echo $numchip; ?>" id=idveiculo name=idveiculo/>
     
        
        <div class=" container-fluid bg-2 ">
            <div class="form-group  col-md-2">
                <label class="pull-left">Registro</label>
                <input class="form-control" id=registro name=registro value="<?php echo $registro; ?>" />
            </div>
            <div class="form-group col-md-2">
                <label class="pull-left">Placa</label>
                <input class="form-control" id=placa_veiculo name=placa_veiculo value="<?php echo $placa_veiculo; ?>" />
            </div>
        
            <div class="form-group   col-md-3">
                <label  class="pull-left">Marca</label>
                <input class="form-control" id=marca name=marca value="<?php echo $marca; ?>"/>
            </div>
           
            <div class="form-group   col-md-3">
                <label  class="pull-left" >Modelo</label>
                <input class="form-control" id=modelo name=modelo value="<?php echo $modelo_veiculo; ?>" />
            </div>
            <div class="form-group   col-md-1">
                <label class="pull-left" >Ano</label> 
                <input class="form-control"type="text" id=ano name=ano value="<?php echo $ano_veiculo; ?>"/>
            </div>
            <div class="form-group  col-md-1">
                <label class="pull-left">Ano Fabric.</label>
                <input class="form-control" id=anomodelo name=anomodelo value="<?php echo $ano_modelo; ?>"/>

            </div>
         
            <div class="form-group col-md-3">
                <label class="pull-left">Cor</label>
                <input class="form-control"  id=cor name=cor value="<?php echo $cor_veiculo; ?>"/>
            </div>
             <div class="form-group col-md-2">
                <label class="pull-left">KM</label>
                <input class="form-control" disabled type="text" id=km name=km value="<?php echo $km_veiculo; ?>"/>

            </div>
            <div class="form-group col-md-2">
                <label class="pull-left">Hora</label>
                <input class="form-control" disabled type="text" id=hora name=hora value="<?php echo $hora_veiculo; ?>"/>
            </div>
        
         
        
    
        <?php
            
            $cmdpre="SELECT eixo_veiculo.ideixos idEixos, ideixo_veiculo,"
                    . "  descreixo, qtdrodas FROM eixo_veiculo, Eixos "
                    . " where Eixos.idEixos = eixo_veiculo.ideixos"
                    . " and eixo_veiculo.idpessoa=".$idpessoa
                    . " and chip_veiculo='".$numchip."'  order by ideixo_veiculo";
            $reseixos=  mysql_query($cmdpre);
            echo mysql_error();
            $contaeixo=0;
             
                  
            while ($reixos = mysql_fetch_array($reseixos)) 
            {
                if($reixos["ideixo_veiculo"]==0)
                {
                    if($reixos["qtdrodas"]>0)
                    {
                        $qtdrodaestepe=$reixos["qtdrodas"];
                    }
                    else
                    {
                        $qtdrodaestepe=0;
                    }
                    echo '<div class="form-group col-md-2">'
                    . ' <label> Estepes </label>'
                    . '<input type=hidden id="selecteixo'.$reixos["ideixo_veiculo"].'" value="'.$reixos["ideixo_veiculo"].'" />'
                    . '<select class="form-control select col-sm-4" id="selqtdrodas'.$reixos["ideixo_veiculo"].'" onchange="atualizaeixos('.$reixos["ideixo_veiculo"].');" />';
                        for($ixroda=0;$ixroda<5;$ixroda++)
                        {
                            if($ixroda==$qtdrodaestepe)
                            {
                                echo '<option selected value="'.$ixroda.'">'.$ixroda.'</option>';
                            }
                            else
                            {
                                echo '<option value="'.$ixroda.'">'.$ixroda.'</option>';
                            }
                        }
                        echo "</select>";
                    echo "</div>";
                    continue;
                }
                $contaeixo++;
               
                echo '<div class="form-group col-md-4">';
                 echo  '<label style="width:100%;" class="pull-left">Eixo: '.$reixos["ideixo_veiculo"]."  "
                         .'<i class="fa fa-trash pull-right " onclick="excluieixos('.$reixos["ideixo_veiculo"].' );">'
                      .'Excluir</i></label>';
                
                $cmdeix="select * from Eixos ";
                $reseix=  mysql_query($cmdeix);
                
                
                echo '<select class=" form-control select  col-sm-4" onchange="atualizaeixos('.$reixos["ideixo_veiculo"].');"  id="selecteixo'.$reixos["ideixo_veiculo"].'" >';

                while ($x = mysql_fetch_array($reseix)) 
                {
                    if($x["idEixos"]===$reixos["idEixos"])
                    {
                        echo '<option selected value="'.$x["idEixos"].'">'.$x["descreixo"].'</option>';
                    }
                    else
                    {
                        echo '<option value="'.$x["idEixos"].'">'.$x["descreixo"].'</option>';
                    }
                }
                echo '</select></div>';
                echo '<div class="form-group col-md-2"> <label class="pull-left"> Rodas </label>'
                    . '<select class="form-control select col-sm-4" id="selqtdrodas'.$reixos["ideixo_veiculo"].'" onchange="atualizaeixos('.$reixos["ideixo_veiculo"].');" />';
                        for($ixroda=1;$ixroda<5;$ixroda++)
                        {
                            if($reixos["ideixo_veiculo"]>0)
                            {
                                if($ixroda===3)continue;
                            }
                            if($ixroda==$reixos["qtdrodas"])
                            {
                                echo '<option selected value="'.$ixroda.'">'.$ixroda.'</option>';
                            }
                            else
                            {
                                echo '<option value="'.$ixroda.'">'.$ixroda.'</option>';
                            }
                        }
                        echo "</select>";
                echo '</div>';
                
            }
            $contaeixo++;
            
             ?>
         
            <?php 
            if($numero_chip===$registro)
            {
                echo "Sem Chip Instalado";
            }
            else
            {
                echo "Chip Instalado";
            }
            ?>
            
            <input disabled class="form-control" placeholder="Leia o chip do veículo" type="hidden" id=chip name=chip value="<?php echo $numero_chip; ?>"/>
         
        <button type="button" class="btn btn-primary" onclick="lerchipveiculo();" id="regrastreado">LER CHIP</button>   
        <button type="button" class="btn btn-primary" onclick="insereeixo('<?php echo $contaeixo;?>' );"  id="regrastreado">CRIAR EIXO</button>   

        <button type="button" class="btn btn-primary" onclick="atualizaveiculo('existente');" id="regrastreado">ATUALIZAR O VEÍCULO</a>
        
    </div>  
         
</body>
</html>