<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>TRUCK ID</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="css.css" rel="stylesheet" type="text/css">
    <link href="css_componente.css" rel="stylesheet" type="text/css">
    <script>
       function lerchip()
        {
           document.getElementById("chip").value="chip passou";
           var chip = window.parent.Android.lerchip();
           document.getElementById("chip").value=chip;
        }
        function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp=false;	
        try{
                xmlhttp=new XMLHttpRequest();
        }
        catch(e)	
        {		
            try
            {			
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1)
                {
                        xmlhttp=false;
                }
            }
        }

        return xmlhttp;
    }
        function salvarcomp()
        {
            var chip_veiculo = document.getElementById("chip_veiculo").value;
            var chip = document.getElementById("chip").value;
            var idpessoa = document.getElementById("idpessoa").value; 
            
            var numserie = document.getElementById("numserie");
            var numserie = numserie.options[numserie.selectedIndex].text; 
            var idcomponente =  document.getElementById("idcomponente").value;
            var strURL="monta_componente.php?numero_serie="+numserie+"&chip="+chip+"&idcomponente="+idcomponente+
                       "&chip_veiculo="+chip_veiculo+"&idpessoa="+idpessoa;
            var req = getXMLHTTP();
            var resposta;
            if (req)
            {
                req.onreadystatechange = function()
                {   if (req.readyState === 4) 
                    {
                        if (req.status === 200) 
                        {						
                            var resposta = JSON.parse(req.responseText);
                            document.getElementById('mensagem').innerHTML=resposta.message;
                         } 
                        else 
                        {
                            resposta=req.readyState;
                        }
                    };				
                };		
            } 
            req.open("GET", strURL, false);
            req.send();
        }
        function mostrachip()
        {
            var chip = document.getElementById("numserie").value;
            document.getElementById("chip").value=chip;
            document.getElementById("mensagem").innerHTML="Leia o chip do item para poder salvar";
            document.getElementById("btsalva").style.visibility = "visible" ;
        }
    </script>

</head>
<body>

<?php
$idcomponente=$_REQUEST["idcomponente"];
$chip_veiculo=$_REQUEST["numero_chip"];
$idpessoa=$_REQUEST["idpessoa"];
echo '<input type=hidden value="'.$idcomponente.'" id=idcomponente name=idcomponente />'
       . '<input type=hidden value="'.$idpessoa.'" id=idpessoa name=idpessoa />'
       .' <input type=hidden value="'.$chip_veiculo.'" id=chip_veiculo name=chip_veiculo />';
?>
    <h4 class="text-center">Registro de componente</h4>
<!--<div class="container form-group">
    
       <select class="form-control" onchange="mostrachip();" type=text name=numserie id=numserie >
            <option value="0">Selecione um dos componentes do almoxarifado</option>
                <?php
//                    include "mysql.php";
//                    $cmd = "select * from componente"
//                    . " where idpessoa in('".$idpessoa."')";
//                     
//                    $result =  mysql_query($cmd);
//                    $cmd=mysql_error();
//                    while($rs=  mysql_fetch_array($result))
//                    {
//                        echo '<option value="'.$rs["idcomponente"]."#".$rs["descrcomponente"].'">'.$rs["numero_serie"]."</option>";
//                    }
                ?>
            </select> 
    
</div>-->
    <div class="container-fluid">
        
    <input disabled class="form-control" style="max-width: 200px;"   type="text" placeholder="chip do componente" id=chip name=chip value=""/> 
    <button type="button" class="btn btn-primary" onclick="lerchip();">  LER CHIP </button>
    </div>
    
<!--<button type="button" class="btn-primary"  onclick="salvarcomp();">SALVAR COMPONENTE</button>-->

</body> 
</html>
