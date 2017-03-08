<?php 
include 'mysql.php';
$chip=$_REQUEST['numero_chip'];
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body >
      
      <!--<div class="table-responsive">--> 
          
       <?php
        
        $queryrs = "SELECT * FROM plano_manutencao"
                ." where idplano_manutencao=".$_REQUEST['idplano'] 
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
                . " order by idplano_manutencao";
        $conta=0;
        $salva=$queryrs;
        $result = mysql_query($queryrs);
        while($rs=  mysql_fetch_array($result))
        {
            $idplano=$rs["idplano_manutencao"];
            $nomeplano=$rs["nome_plano"];
            $manda=$rs["mandatorio"];
        }
        $queryrs = "SELECT* from item_manutencao "
                ." where idplano_manutencao=".$_REQUEST['idplano'] 
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
                . " order by iditem_manutencao";
        $resultado = mysql_query($queryrs);

        echo '<h4 class="text-center">Plano de Manutenção</h4>'
        . '<div class="container-fluid" >'
            . '<fieldset style="width:95%;"><legend >Nome do Plano</legend> '
                
                . '<form style="width:100%;">'
                    . '<div class="pull-left" style="width:80%;" >'
                        . '<input id=nomeplano type=text onchange="alteraplano('.$_REQUEST['idplano'].' )" '
                            . 'class="form-control" style="width:100%;" value="'.$nomeplano.'"/></div>';
        
                echo '<div class="pull-right" style="width:18%;">'
                        . '<label for="mandat">Mandatório</label>';
                if($manda==="S")
                {
                    echo '<input checked type=checkbox class=checkbox id=mandat'                    
                        . ' onclick="mudamanda('.$_REQUEST['idplano'].' )" value="S" style="width:20px;" />';
                }
                else
                {
                    echo '<input type=checkbox class=checkbox id=mandat'                    
                        . ' onclick="mudamanda('.$_REQUEST['idplano'].' )" value="N" style="width:20px;" />';
                }
                
                echo '</div></form>'
            . '</fieldset>'
        . '</div>';

        
        while($rsan=mysql_fetch_array($resultado))
        {
            echo ' <div class="divide bg-1" ></div>';
            if($rsan["status"]==="A")
            {
                echo '<div class="container-manu bg-2" >';
            }
            else
            {
                echo '<div class="container-manu bg-4" >';
            }
            echo '<div class="col-sm-2" style="width:15px;">'
                    . '<label for="tosel">DES</label>'
                    . '<input type=checkbox class=checkbox id=tosel'.$rsan["iditem_manutencao"]
                        . ' onclick="selitem('.$rsan["iditem_manutencao"].' );" style="width:15px;" /></div>';
            echo '<div class="col-sm-5"  >'
                    . '<label for="nomeitem">Descrição do item</label><input type=text id=nomeitem'.$rsan["iditem_manutencao"].' '
                    . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    . 'class=form-control value="'.$rsan["nome_item"].'" /></div>'
                    . '<div class="col-sm-2"><label for="valor">Valor de Meta</label><input  type=number id=valor'.$rsan["iditem_manutencao"].'  value="'.$rsan["valor_item"].'" '
                    . 'onchange="cmdatua('.$rsan["iditem_manutencao"].')"  class=form-control /></div>';
            if($rsan["status"]==="A")
            {
                echo '<div id=cmd'.$rsan["iditem_manutencao"].'></div>';
            }
            else 
            {
                echo '<div id=cmd'.$rsan["iditem_manutencao"]
                        .'><div class=btn onclick="ativaitem('.$rsan["iditem_manutencao"].')" ><i class="fa fa-save" '
                        . ' style="padding:2px;cursor:pointer;"></i>Reativar</div></div>';
            };
            echo '</div>';
            if($rsan["status"]==="A")
            {
                echo '<div class="container-manu bg-2" >';
            }
            else
            {
                echo '<div class="container-manu bg-4" >';
            }
            if($rsan["ind_km"]==="S")
            {
                echo '<div class="col-sm-1" style="width:15px;"><label for="todokm">KM</label>'
                        . '<input style="width:15px;" checked type=checkbox class=checkbox id=todokm'.$rsan["iditem_manutencao"]
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                        . ' onclick="checkkm('.$rsan["iditem_manutencao"].');" value="S" /></div>';
                echo '<div class="col-sm-2">'
                    . ' <label for="limitekm">Limite KM</label><input  type=number id=limitekm'.$rsan["iditem_manutencao"] 
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    . '  value="'.$rsan["limite_km"].'" class="form-control"/></div>';
                echo '<div class="col-sm-2" ><label for="alertakm">Alerta KM</label> <input  type=number id=alertakm'.$rsan["iditem_manutencao"].' '
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    . ' value="'.$rsan["alerta_km"].'" class="form-control" /></div>';
            }
            else
            {
                echo '<div class="col-sm-1" style="width:15px;"><label for="todokm">KM</label>'
                        . '<input style="width:15px;" type=checkbox class=checkbox id=todokm'.$rsan["iditem_manutencao"]
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    . ' onclick="checkkm('.$rsan["iditem_manutencao"].');"  value="N" /></div>';
                echo '<div class="col-sm-2" ><label for="limitekm">Limite KM</label><input disabled type=number id=limitekm'.$rsan["iditem_manutencao"] 
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    . '  value="'.$rsan["limite_km"].'" class="form-control"/></div>';
                echo '<div class="col-sm-2" ><label for="alertakm">Alerta KM</label><input disabled type=number id=alertakm'.$rsan["iditem_manutencao"].' '
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    . ' value="'.$rsan["alerta_km"].'" class="form-control" /></div>';
            }
           
            if($rsan["ind_periodo"]==="S")
            {
                echo '<div class="col-sm-1" ><label for="tododia">DIAS</label><input style="width:15px;" checked type=checkbox class=checkbox id=tododia'.$rsan["iditem_manutencao"]
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                . ' onclick="checkkm('.$rsan["iditem_manutencao"].');" value="S" /></div>';
                echo '<div class="col-sm-1" ><label for="limitedia">Limite dias</label><input  type=number id=limitedia'.$rsan["iditem_manutencao"]
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    .' value="'.$rsan["limite_dias"].'"class=form-control /></div>';
                echo '<div class="col-sm-1" ><label for="alertadia">Alerta dias</label><input  type=number id=alertadia'.$rsan["iditem_manutencao"]
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    .'   value="'.$rsan["alerta_dias"].'" class=form-control /></div>';
            }
            else
            {
                echo '<div class="col-sm-1" ><label for="tododia">DIAS</label><input style="width:15px;" type=checkbox class=checkbox id=tododia'.$rsan["iditem_manutencao"]
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                . ' onclick="checkkm('.$rsan["iditem_manutencao"].');"  value="N" /></div>';
                echo '<div class="col-sm-1" ><label for="limitedia">Limite dias</label><input disabled type=number id=limitedia'.$rsan["iditem_manutencao"]
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    .' value="'.$rsan["limite_dias"].'"class=form-control /></div>';
                echo '<div class="col-sm-1" ><label for="alertadia">Alerta dias</label><input disabled type=number id=alertadia'.$rsan["iditem_manutencao"]
                        . ' onchange="cmdatua('.$rsan["iditem_manutencao"].')"'
                    .'   value="'.$rsan["alerta_dias"].'" class=form-control /></div>';
            }
            
            echo "</div> </div>";
        }
        echo '<table class="container table" id=falhas name=eixos >';
        echo "<tr style=margin:5px;>";
        echo '<td></td>';
        echo '<td width="30%"><label for="nomeitem0">Descrição do item</label><input type=text id=nomeitem0 class=form-control></td>';
        echo '<td><label for="todokm0">KM</label><input type=checkbox class="checkbox" id=todokm0'
            . ' onclick="ligadesliga();" onchange="checkkm(0)" value="N"></td>';
        echo '<td ><label for="limitekm0">Limite KM</label><input disabled type=number id=limitekm0 class="form-control" value=0></td>';
        echo '<td><label for="alertakm0">Alerta KM</label><input disabled type=number id=alertakm0 class=form-control value=0></td>';
        echo '<td><label for="tododia0">Dias</label><input type=checkbox class=checkbox id=tododia0'
            . ' onclick="ligadesliga();" onchange="checkkm(0)"  value="N"></td>';
        echo '<td><label for="limitedia0">Limite Dias</label><input disabled type=number id=limitedia0 class=form-control value=0></td>';
        echo '<td><label for="alertadia0">Alerta Dias</label><input disabled type=number id=alertadia0 class=form-control value=0></td>';
        echo '<td><label for="valor0">Valor de meta</label><input  type=number id=valor0 class=form-control></td>';
        echo '<td><button type=button class=btn id=todochk'
            . ' onclick="incluiitem(0);">Novo</button></td>';
        echo "</tr>";
        echo "</table>"; 
        ?>
    </div> 
       
</body>
</html>