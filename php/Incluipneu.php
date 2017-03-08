<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TRUCK ID</title>
    <link rel="shortcut icon" href="./images/favicon_americas.ico" type="image/x-icon">
    <link rel="icon" href="./images/favicon_americas.ico" type="image/x-icon">
    <script>
        function lerchip()
        {
           document.getElementById("chip").value="chip passou";
           var chip = window.parent.Android.lerchip();
           document.getElementById("chip").value=chip;
        }
    </script>
</head>
<body>
<?php
$cmd = "SELECT * from pneu where numero_chip= '".$numero_chip."'";  

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
      $idpessoa=$_REQUEST['idpessoa'];
}
?>
    <div class="container panel">
    <div class=" row "> 
        <input type=hidden value="<?php echo $idcomponente; ?>" id=idcomponente name=idcomponente/>
        <input type=hidden value="" id=idpneu name=idpneu/>
        <div class="pull-left" id="selwarea" style="padding-left: 10px;" >
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Selecione o aro
                    </a>

                    <ul class="dropdown-menu navbar-text" style='font-size: 11px;letter-spacing: 1px;'>
                    <?php 
                        $cmd = "select distinct po from carcacas order by po";
                        $cmd = mysql_query($cmd);
                        while($rsmed= mysql_fetch_array($cmd))
                        {
                            echo '<li role="presentation" style="width:100%;font-size: 11px;letter-spacing: 1px;padding: 5px;"'
                            . ' onclick="carregamedida('."'".$rsmed["po"]."'".');" >'.$rsmed["po"].'</li>';
                        }
                    ?>
                    </ul>  
            </ul>
        </div>
        <div class="pull-left" id="seltarea"style="padding-left: 10px;" >
        </div>
        <div class="pull-left" id="selmarea" style="padding-left: 10px;">
        </div>
        <div class="pull-left" id="selxarea" style="padding-left: 10px;">
        </div>
        <div class="container table-responsive">
        <table class=table>
            <tr><th >Medida</th><th >Marca</th><th >Modelo</th></tr>
            <tr><td>
                <input class="input form-control" type="text" id=medida name=medida /> 
            </td>
            <td> 
                <input class="input form-control" type="text" id=marca name=marca /> 
            </td>
            <td>
                <input class="input form-control" type="text" id=selmodelo name=selmodelo/>
            </td>
               </td> 
            </tr>
        </table>
           
        
        <div class="form-group col-md-1"> <label>Vida</label>
            <select class="select  form-control " id=vida name=vida>
            <?php
                for($ixvida=1;$ixvida<8;$ixvida++)
                {
                    echo '<option value='.$ixvida.'>'.$ixvida.'</option>';
                }

                    echo $vida ?>
            </select>
        </div>
        <div class="form-group col-md-2"> <label> Marca de fogo</label>
            <input class=" form-control"  placeholder="Marca de fogo" type="text" id=numserie name=numserie value=""/> 
        </div>
        <div class="form-group col-md-2"> <label> Banda de rodagem </label>
            
            <input class=" form-control" placeholder="Banda" type="text" id=banda name=banda value="ORIGINAL"/> 
        </div>
        <div class="form-group col-md-2"> <label> CHIP instalado </label>
        
            <input class=" form-control col-md-6" disabled placeholder="Numero do chip" disabled class="textarea" type="text" id=chip name=chip value="<?php echo $numero_chip?>"/> 
        </div>
       
    </div>
        <button type="button" class="btn btn-primary" onclick="lerchip();">LER CHIP DO PNEU</button>
        <button type="button" class="btn btn-primary" onclick="novopneu();">CRIA O PNEU</button>
        <div id="resultado"></div>
</div>
</body>
</html>