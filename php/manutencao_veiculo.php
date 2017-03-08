<?php 
include 'mysql.php';
$chip=$_REQUEST['chip_veiculo'];
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  <body >
      <div id="execmanu" class=execmanu ></div>
      <div class="table-bordered"> 
          
       <?php
        echo '<input type="hidden" id="idplano" value="'.$_REQUEST['idplano'].'" />';
        $queryrs = "SELECT * FROM plano_manutencao"
                ." where idplano_manutencao=".$_REQUEST['idplano'] 
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
//                . " and status='A'"
                . " order by idplano_manutencao";
        $conta=0;
//        echo $queryrs;
        $result = mysql_query($queryrs);
        echo mysql_error();
        while($rs=  mysql_fetch_array($result))
        {
            $idplano=$rs["idplano_manutencao"];
            $nomeplano=$rs["nome_plano"];
        }
        $queryrs = "SELECT * FROM veiculo"
                ." where chip_veiculo='".$chip."'" 
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
                . " order by chip_veiculo";
        
        $result = mysql_query($queryrs);
        while($rs=  mysql_fetch_array($result))
        {
            $kmatual=$rs["km_veiculo"];
        }
        $queryrs = "SELECT* from item_manutencao "
                ." where idplano_manutencao=".$_REQUEST['idplano'] 
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
                . " order by iditem_manutencao";
        $resultado = mysql_query($queryrs);
        echo '<div class="container-fluid"><h4 class="text-center" class="text-center">'.$nomeplano.'</h4>'
                . '<br><div class="btn pull-left" onclick="dissociaplano('."'".$_REQUEST['idplano']."'".');"><i class="fa fa-truck " ></i><span>Dissociar</span></div></div>';
        echo '<table class="table" id=falhas name=eixos >';
        
            echo "<tr> "
                . '<th  >Executar</th>'
                . '<th colspan=5 >Descrição do item</th>'
                . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            $cmda="SELECT idpessoa,idplano_manutencao,iditem_manutencao,chip_veiculo,idusuario,dataregistro,kmregistro,ressalvas"
                    ." FROM veiculo_manutencao"
                    ." where idplano_manutencao=".$_REQUEST['idplano'] 
                    . " and chip_veiculo='".$chip."'" 
                    . ' and idpessoa='.$_REQUEST['idpessoa']
                    . " and iditem_manutencao in ('".$rsan["iditem_manutencao"]."')"
                    . " order by dataregistro";
            $resultada = mysql_query($cmda);
           
            echo mysql_error();
            $ultkm="0";
            $ultdata="1900-01-01";
            $limitekm=$rsan["limite_km"];
            $limitedia=$rsan["limite_dias"];
            while($rsa=  mysql_fetch_array($resultada))
            {
                $ultkm=$rsa["kmregistro"];
                $ultdata=$rsa["dataregistro"];
                $ressalvas=$rsa["ressalvas"];
            }
            $obriga=false;
            $ok=false;
          
            if($rsan["ind_km"]==="S")
            {
                $kmrodado=$kmatual-$ultkm;
                
                $mostra=number_format($kmrodado,0,",",".")." KM";
                $hint=$kmatual." - ".$ultkm;
                if($kmrodado>$limitekm)
                {
                    
                    $obriga=true;
                    $ok=false;
                }
                else
                {
                    $ok=true;
                }
            }
            else {$mostra="---";}
            if($rsan["ind_periodo"]==="S")
            {
                $dtatual=Date_create();
                $qtdias=(strtotime(date_format($dtatual,"y-m-d"))-strtotime(date_format(date_create($ultdata),"y-m-d")))/86400;
                $limitedia=$rsan["limite_dias"];
                $mostradia=$qtdias." "." dias";
                $hintdia=date_format($dtatual,"d/m/y")." - ".date_format(date_create($ultdata),"d/m/y");
                if($qtdias>$limitedia)
                {
                    $obriga=true;
                    $ok=false;
                }
                else 
                { 
                    $ok=true;
                }
            }
            else {
                $mostradia="---";
            }
            
            if($obriga)
            {
                echo '<tr id="tritem'.$rsan["iditem_manutencao"].'" style=margin:5px; class=btn-danger>';
            }
            else
            {
                if($rsan["ressalvas"]!=="")
                {
                    echo '<tr id="tritem'.$rsan["iditem_manutencao"].'" style=margin:5px; class=btn-success>';
                }
                else {
                    echo '<tr id="tritem'.$rsan["iditem_manutencao"].'" style=margin:5px; class=btn-success>';
                }
            }
                
             
            
            echo ''
                . '<td><input type=checkbox class=checkbox id=tosel'.$rsan["iditem_manutencao"]
                . ' onclick="selmanu('.$rsan["iditem_manutencao"].' );" /></td>' 
                .'<td colspan=3><span>'.$rsan["nome_item"].'</span></td></tr>'; 

               
                
        }
       
        echo "</table>"; 
        ?> <td 
    </div> 
        
</body>
</html>