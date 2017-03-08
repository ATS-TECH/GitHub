<?php
$idpessoa=$_REQUEST['idpessoa'];
$chip=$_REQUEST["idveiculo"];
include 'mysql.php';

echo '<input type="hidden" id="idplano" value="'.$_REQUEST['idplano'].'" />';
        $queryrs = "SELECT * FROM plano_manutencao"
                ." where idplano_manutencao=".$_REQUEST['idplano'] 
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
                . " and status='A'"
                . " order by idplano_manutencao";
        $conta=0;
        $salva=$queryrs;
        $result = mysql_query($queryrs);
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
                . ' and iditem_manutencao='.$_REQUEST['iditem'] 
                . ' and idpessoa='.$_REQUEST['idpessoa'] 
                . " order by iditem_manutencao";
        $resultado = mysql_query($queryrs);
      
        while($rsan=mysql_fetch_array($resultado))
        {
            $cmda="SELECT idpessoa,idplano_manutencao,iditem_manutencao,"
                    . "chip_veiculo,idusuario,dataregistro,kmregistro,ressalvas"
                    ." FROM veiculo_manutencao"
                    ." where idplano_manutencao=".$_REQUEST['idplano'] 
                    . " and chip_veiculo='".$chip."'" 
                    . ' and idpessoa='.$_REQUEST['idpessoa']
                    . " and iditem_manutencao =".$rsan["iditem_manutencao"]
                    . " and dataregistro="
                    . "(select max(dataregistro) "
                    ." FROM veiculo_manutencao"
                    ." where idplano_manutencao=".$_REQUEST['idplano'] 
                    . " and chip_veiculo='".$chip."'" 
                    . ' and idpessoa='.$_REQUEST['idpessoa']
                    . " and iditem_manutencao =".$rsan["iditem_manutencao"].')';
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
                $qtdias=(strtotime(date_format($dtatual,"y-m-d"))-strtotime($ultdata))/86400;
                $limitedia=$rsan["limite_dias"];
                $mostradia=$qtdias." "." dias decorridos";
                $hintdia=date_format($dtatual,"d/m/y")." a ".date_format(date_create($ultdata),"d/m/y");
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
            $iditem=$rsan["iditem_manutencao"];
            echo '<div  class="container-fluid">'; 
            echo '<h5>'.$rsan["nome_item"].'</h5>'; 
            if($rsan["ind_periodo"]==="S")
            {
                echo '<label >Limite de </label>'." ".$limitedia." dias "
                . '<label >com</label>'." ".$mostradia.' ('.$hintdia.')<br>';
            }
            if($rsan["ind_km"]==="S")
            {
                echo '<label>Limite de </label>'." ".number_format($limitekm,0,",",".")." KM "
                    . '<label >com </label>'.' '.$kmrodado." de KM rodados (".$mostra.')<br>';
            }
            echo  '<label>Ressalvas </label><br>'
                .   '<input type=text id="ress'.$rsan["iditem_manutencao"].'" style="width:300px;"'
                       .'  value="'.$rsan["ressalvas"].'"  class="form-control" /><br>'
                .   '<label >Valor do Custo </label><br>'
                .   '<input class="form-control text-right"  style="width:100px;pdding-right:10px;" type=number id=valor value="0" />';
            echo '<button type=button class="btn btn-primary" '
                . ' onclick="inclui_item('.$iditem.')" >Executar</button>'
                . '</div>';
        }
     