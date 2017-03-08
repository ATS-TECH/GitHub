<html>    
<head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="alternate" href="http://truck-id.com.br/" hreflang="pt" />
        <link rel="alternate" href="http://truck-id.com.br/" hreflang="x-default" />
        
        <meta http-equiv="content-language" content="pt-br" />
        <meta name="author" content="Americas Technologies Solutions" />
        
        <link rel="shortcut icon" href="images/favicon_americas.ico" type="image/x-icon">
        <link rel="icon" href="images/favicon_americas.ico" type="image/x-icon">
        
        <script>
          $(function () {
            $('.dropdown-toggle').dropdown();
          }); 
        </script>
        
        <!--Analytics-->
        
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-13126325-5', 'auto');
            ga('send', 'pageview');

        </script>
        <meta name="google-site-verification" content="grzKjj22tvgsWHB7LGMamsoDlv-5djeUhv3N8onEjQ4" />
        
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
                
        <meta name="description" content = "Gestão automatizada de frotas utilizando a tecnologia RFID.Controle de manutenção de pneus, componentes e serviços. Planos de manutenção automatizados e muito mais"/>
        <meta name="keywords" content = "ATS, Automação da gestao de frota, chips de pneu, manutenção de frota ,conveyor belt RFID tags"/>

         
    </head>
    <body style="font-size:11px;" >
  
<?php 
include 'php/mysql.php';
?>
<h4 class="">Resumo Geral ATS</h4>
<?php
        
        $queryrs = "SELECT razao_social, email, "
                . "idpessoa, telefone, "
            ." (select count(*) from veiculo where idpessoa=pessoa_juridica.idpessoa) veiculos,"
            ." (select count(*) from pneu where idpessoa=pessoa_juridica.idpessoa) pneus "     
            ." from pessoa_juridica ";
        $conta=0;
        
        $salva=$queryrs;
        
        $result = mysql_query($queryrs);
        echo mysql_error();
        while($rsan=mysql_fetch_array($result))
        {
           
            echo '<div class="table-responsive text-center" width=100%>'
            . ' <table class="table-bordered" id="tabresumo" name=eixos style="font-size:11px;padding:10px;width:100%;" ><tr style="padding:10px;"> <th >Razão</th>'
            . "<th >email</th>"
            . "<th >telefone</th>"
            . "<th >Veiculos </th>"
            . "<th >Pneus</th>"

            . "</tr>";
            echo '<tr style="padding:10px;">';
            echo '<td   >'.$rsan["razao_social"].'</td>';
            echo '<td  >'.$rsan["email"].'</td>';
            echo '<td  >'.$rsan["telefone"].'</td>';
            echo '<td  >'.$rsan["veiculos"].'</td>';
            echo '<td  >'.$rsan["pneus"].'</td>';
          
            echo '</tr>
            </table>
            <div class="table-responsive" width=100%>
            <table class="table-bordered" id="tabresumo" name=eixos style="font-size:11px;padding:10px;width:100%;">
                <tr>
                    <th colspan="2"  style="padding:10px;"  class="text-center">PNEUS MONTADOS</th>
                    <th colspan="2"  style="padding:10px;"  class="text-center">ALMOXARIFADO</th>
                    <th colspan="2"  style="padding:10px;"  class="text-center">SUCATA</th>
                </tr>
            ';

            echo '<tr> ';
            echo '<th style="padding:10px;" >TOTAL</th><th style="padding:10px;">COM CHIP</th>'
            . '<th style="padding:10px;" >TOTAL</th><th style="padding:10px;">COM CHIP</th>'
            .'<th style="padding:10px;" >TOTAL</th><th style="padding:10px;">COM CHIP</th></tr>';

            $queryrs = "SELECT count(*) qtd "
                ." from pneu "
                    . " where idpessoa in (".$rsan["idpessoa"].")"
                    . " and numero_chip_veiculo is not null";
            $resultado = mysql_query($queryrs);
            echo mysql_error();
            while($rs=mysql_fetch_array($resultado))
            {
                echo '<td  class="bg-4 text-right"  style="padding:10px;"  >'.number_format($rs["qtd"],0,",",".").'</td>';
            }
            $queryrs = "SELECT count(*) qtd "
                ." from pneu "
                    . " where idpessoa in (".$rsan["idpessoa"].")"
                    . " and numero_chip_veiculo is not null"
                    . " and numero_chip <> numero_serie";
            $resultado = mysql_query($queryrs);
            echo mysql_error();
            while($rs=mysql_fetch_array($resultado))
            {
                echo '<td  class="bg-4 text-right"  style="padding:10px;"  >'.number_format($rs["qtd"],0,",",".").'</td>';
            }

            $queryrs = "SELECT count(*) qtd "
                ." from componente_almox, componente "
                    . " where componente.idpessoa =".$rsan["idpessoa"]
                    . " and componente.idcomponente = componente_almox.idcomponente"
                    . " and componente.idpessoa = componente_almox.idpessoa"
                    . " and ispneu='S' "
                    . " and data_baixa is null"
                    . " and data_montagem is null";
            $resultado = mysql_query($queryrs);
            echo mysql_error();
            while($rs=mysql_fetch_array($resultado))
            {
                echo '<td  class="bg-4 text-right"  style="padding:10px;" >'.number_format($rs["qtd"],0,",",".").'</td>';
            }
            $queryrs = "SELECT count(*) qtd "
                ." from componente_almox, componente "
                    . " where componente.idpessoa =".$rsan["idpessoa"]
                    . " and componente.idcomponente = componente_almox.idcomponente"
                    . " and componente.idpessoa = componente_almox.idpessoa"
                    . " and ispneu='S' "
                    . " and data_baixa is null"
                    . " and data_montagem is null"
                    . " and numero_chip <> numero_serie";
            $resultado = mysql_query($queryrs);
            echo mysql_error();
            while($rs=mysql_fetch_array($resultado))
            {
                echo '<td  class="bg-4 text-right" style="padding:10px;"  >'.number_format($rs["qtd"],0,",",".").'</td>';
            }

            $queryrs = "SELECT count(*) qtd "
                ." from componente_almox, componente "
                    . " where componente.idpessoa =".$rsan["idpessoa"]
                    . " and componente.idcomponente = componente_almox.idcomponente"
                    . " and componente.idpessoa = componente_almox.idpessoa"
                    . " and ispneu='S' "
                    . " and data_baixa is not null";
            $resultado = mysql_query($queryrs);
            echo mysql_error();
            while($rs=mysql_fetch_array($resultado))
            {
                echo '<td class="bg-4 text-right" style="padding:10px;" >'.number_format($rs["qtd"],0,",",".").'</td>';
            }
            $queryrs = "SELECT count(*) qtd "
                ." from componente_almox, componente "
                    . " where componente.idpessoa in (".$rsan["idpessoa"].")"
                    . " and componente.idcomponente = componente_almox.idcomponente"
                    . " and componente.idpessoa = componente_almox.idpessoa"
                    . " and ispneu='S' "
                    . " and data_baixa is not null"           
                    . " and numero_chip <> numero_serie";
            $resultado = mysql_query($queryrs);
            echo mysql_error();
            while($rs=mysql_fetch_array($resultado))
            {
                echo '<td class="bg-4 text-right" style="padding:10px;" >'.number_format($rs["qtd"],0,",",".").'</td>';
            }
            echo ' 
            </tr>
            </table>
        </div><div class=divider></div> </div>';
       ; 
        
    }
?>
 
</body>
</html>
