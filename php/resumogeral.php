<?php 
include 'mysql.php';
?>

    <div class="table-responsive text-center" width=100%>

        <h4 class="">Resumo Geral</h4>
        
       <table class="table-bordered" id="tabresumo" name=eixos style="padding:10px;width:100%;" >
       <?php
        
        $queryrs = "SELECT razao_social, pessoa_juridica.email, "
                . "pessoa_juridica.idpessoa, pessoa_juridica.telefone, "
            ." (select count(*) from veiculo where idpessoa=pessoa_juridica.idpessoa) veiculos,"
            ." (select count(*) from pneu where idpessoa=pessoa_juridica.idpessoa) pneus "     
            ." from pessoa_juridica "
                . " where pessoa_juridica.idpessoa=".$_REQUEST["idpessoa"]
                ." order by razao_social";
        $conta=0;
//        echo $queryrs;
        $salva=$queryrs;
        
        
        echo '';
        echo '<tr style="padding:10px;"> <th >Razão</th>'
                . "<th >email</th>"
                . "<th >telefone</th>"
                . "<th >Veiculos </th>"
                . "<th >Pneus</th>"
                 
                . "</tr>";
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        while($rsan=mysql_fetch_array($resultado))
        {
            echo '<tr style="padding:10px;">';
            echo '<td   >'.$rsan["razao_social"].'</td>';
            echo '<td  >'.$rsan["email"].'</td>';
            echo '<td  >'.$rsan["telefone"].'</td>';
            echo '<td  >'.$rsan["veiculos"].'</td>';
            echo '<td  >'.$rsan["pneus"].'</td>';
          
            echo "</tr>";
        }
          
        ?>
        </table>
    </div> 
<div class="table-responsive" width=100%>
<table class="table-bordered" id="tabresumo" name=eixos style="padding:10px;width:100%;">
    <tr>
        <th colspan="2"  style="padding:10px;"  class="text-center">PNEUS MONTADOS</th>
        <th colspan="2"  style="padding:10px;"  class="text-center">ALMOXARIFADO</th>
        <th colspan="2"  style="padding:10px;"  class="text-center">SUCATA</th>
    </tr>
<?php
       
        echo '<tr> ';
        echo '<th style="padding:10px;" >TOTAL</th><th style="padding:10px;">COM CHIP</th>'
        . '<th style="padding:10px;" >TOTAL</th><th style="padding:10px;">COM CHIP</th>'
        .'<th style="padding:10px;" >TOTAL</th><th style="padding:10px;">COM CHIP</th></tr>';
         
        $queryrs = "SELECT count(*) qtd "
            ." from pneu "
                . " where idpessoa in (".$_REQUEST["idpessoa"].")"
                . " and numero_chip_veiculo is not null";
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        while($rsan=mysql_fetch_array($resultado))
        {
            echo '<td  class="bg-4 text-right"  style="padding:10px;"  >'.number_format($rsan["qtd"],0,",",".").'</td>';
        }
        $queryrs = "SELECT count(*) qtd "
            ." from pneu "
                . " where idpessoa in (".$_REQUEST["idpessoa"].")"
                . " and numero_chip_veiculo is not null"
                . " and numero_chip <> numero_serie";
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        while($rsan=mysql_fetch_array($resultado))
        {
            echo '<td  class="bg-4 text-right"  style="padding:10px;"  >'.number_format($rsan["qtd"],0,",",".").'</td>';
        }
        
        $queryrs = "SELECT count(*) qtd "
            ." from componente_almox, componente "
                . " where componente.idpessoa =".$_REQUEST["idpessoa"]
                . " and componente.idcomponente = componente_almox.idcomponente"
                . " and componente.idpessoa = componente_almox.idpessoa"
                . " and ispneu='S' "
                . " and data_baixa is null"
                . " and data_montagem is null";
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        while($rsan=mysql_fetch_array($resultado))
        {
            echo '<td  class="bg-4 text-right"  style="padding:10px;" >'.number_format($rsan["qtd"],0,",",".").'</td>';
        }
        $queryrs = "SELECT count(*) qtd "
            ." from componente_almox, componente "
                . " where componente.idpessoa =".$_REQUEST["idpessoa"]
                . " and componente.idcomponente = componente_almox.idcomponente"
                . " and componente.idpessoa = componente_almox.idpessoa"
                . " and ispneu='S' "
                . " and data_baixa is null"
                . " and data_montagem is null"
                . " and numero_chip <> numero_serie";
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        while($rsan=mysql_fetch_array($resultado))
        {
            echo '<td  class="bg-4 text-right" style="padding:10px;"  >'.number_format($rsan["qtd"],0,",",".").'</td>';
        }
       
        $queryrs = "SELECT count(*) qtd "
            ." from componente_almox, componente "
                . " where componente.idpessoa =".$_REQUEST["idpessoa"]
                . " and componente.idcomponente = componente_almox.idcomponente"
                . " and componente.idpessoa = componente_almox.idpessoa"
                . " and ispneu='S' "
                . " and data_baixa is not null";
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        while($rsan=mysql_fetch_array($resultado))
        {
            echo '<td class="bg-4 text-right" style="padding:10px;" >'.number_format($rsan["qtd"],0,",",".").'</td>';
        }
        $queryrs = "SELECT count(*) qtd "
            ." from componente_almox, componente "
                . " where componente.idpessoa in (".$_REQUEST["idpessoa"].")"
                . " and componente.idcomponente = componente_almox.idcomponente"
                . " and componente.idpessoa = componente_almox.idpessoa"
                . " and ispneu='S' "
                . " and data_baixa is not null"           
                . " and numero_chip <> numero_serie";
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        while($rsan=mysql_fetch_array($resultado))
        {
            echo '<td class="bg-4 text-right" style="padding:10px;" >'.number_format($rsan["qtd"],0,",",".").'</td>';
        }
        ?>
        </tr>
        </table>
    </div> 
