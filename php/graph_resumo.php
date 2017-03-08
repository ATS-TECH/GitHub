<?php 
include 'mysql.php';
$chip=$_REQUEST['numero_chip'];
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script>
        function selveiculo(idveiculo)
        {
            var selveiculo = document.getElementById("selveiculo");
            selveiculo
            var strURL="detalhe_veiculo.php?placa="+idveiculo;
            parent.window.frames['tabmestra'].location = strURL; 
        }
        
        $(document).ready(function() {
            $('#tabresumo').DataTable( {
            stateSave: true
            } );
        } 
        ); 
    </script>
  </head>
  <body >
    <div class="container-fluid" >

        <h4 class="text-center">Resumo Geral da frota</h4>
        <button type="button" style="margin: 1rem;padding: 5px;" 
                id=export class="btn text-right" onclick="parent.exportatable('veiculo');" >
          Exportar para CSV 
        </button>
       <table class="" id="tabresumo" name=eixos style="width:98%;" >
       <?php
        
        $queryrs = "SELECT placa_veiculo,registro_veiculo, marca, modelo_veiculo, km_veiculo,veiculo.chip_veiculo," 
                    ."(select count(*)  from eixo_veiculo "
                    ." where veiculo.chip_veiculo=eixo_veiculo.chip_veiculo "
                    ."   and ideixo_veiculo>0) qtdeixos  ," 
                    ."(select sum(qtdrodas) from eixo_veiculo "
                    . "where veiculo.chip_veiculo=eixo_veiculo.chip_veiculo ) qtdrodas, "
                    ."(select count(*) from pneu where veiculo.chip_veiculo= numero_chip_veiculo) qtdpneus "
                    ." FROM veiculo "
                . " where idpessoa=".$_REQUEST["idpessoa"]
                . " order by placa_veiculo, modelo_veiculo";
        $conta=0;
        echo $cmd;
        $salva=$queryrs;
        $resultado = mysql_query($queryrs);
        echo mysql_error();
        echo '';
        echo "<tr> <th >PLACA</th>"
                . "<th >REGISTRO</th>"
                . "<th >MARCA</th>"
                . "<th >MODELO</th>"
                . "<th >EIXOS</th>"
                . "<th >RODAS</th>"
                . "<th >PNEUS</th>"
                . "<th >KM</th>"
                . "</tr>"; 
        while($rsan=mysql_fetch_array($resultado))
        {
            echo "<tr>";
            echo '<td onclick="detalhesmenu('."'".$rsan["chip_veiculo"]."'".');">'.$rsan["placa_veiculo"].'</td>';
            echo '<td  >'.$rsan["registro_veiculo"].'</td>';
            echo '<td  >'.$rsan["marca"].'</td>';
            echo '<td  >'.$rsan["modelo_veiculo"].'</td>';
            echo '<td  >'.$rsan["qtdeixos"].'</td>';
            echo '<td  >'.$rsan["qtdrodas"].'</td>';
            echo '<td  >'.$rsan["qtdpneus"].'</td>';
            echo '<td  >'.number_format($rsan["km_veiculo"],0,",",".").'</td>';
            
            echo "</tr>";
        }
          
        ?>
        </table>
    </div> 
      
</body>
</html>