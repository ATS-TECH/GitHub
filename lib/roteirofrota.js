function atualizaveiculo(operacao)
{
    resulttoast("Verificando as informações, aguarde...");
    var idveiculo = window.document.getElementById("idveiculo").value;
    var idpessoa = window.document.getElementById("idpessoa").value;
    var marca = window.document.getElementById("marca").value;
    var modelo = window.document.getElementById("modelo").value;
    var ano = window.document.getElementById("ano").value;
    var anomodelo = window.document.getElementById("anomodelo").value;
    var cor = window.document.getElementById("cor").value;
    var registro = window.document.getElementById("registro").value;
    var novochip=window.document.getElementById("chip").value;;
    var placa = window.document.getElementById("placa_veiculo").value;
    var eixos = window.document.getElementById("qtd").value;
    if(eixos==='')
    {
        resulttoast("informe a quantidade de eixos. Importante !");
        return;
    }
    if(idveiculo==='')
    {
        if(novochip==='')
        {
            novochip=registro;
            idveiculo=registro;
        }
    }
    
    var strURL="php/atualiza_veiculo.php?idveiculo="+idveiculo+"&marca="+marca+"&modelo="+modelo+
               "&ano="+ano+"&anomodelo="+anomodelo+"&cor="+cor
               +"&registro="+registro+"&novochip="+novochip
               +"&placa="+placa+"&idpessoa="+idpessoa+"&eixos="+eixos+"&operacao="+operacao;
    executa(strURL);
    limpadiv("contgeral");
    limpadiv("page-wrapper");
//    novoresumo('php/detalhe_veiculo.php?idpessoa='+idpessoa+'&numero_chip='+idveiculo+'&idrastreado=0','veiculo');
}
function insereeixo(eixo)
{
    var idpessoa = window.document.getElementById("idpessoa").value;
    var idveiculo = window.document.getElementById("idveiculo").value;
    var strURL="php/inclui_eixo.php?idveiculo="+idveiculo+"&indeixo="+eixo+"&idpessoa="+idpessoa;
    executa(strURL);
    novoresumo('php/detalhe_veiculo.php?idpessoa='+idpessoa+'&numero_chip='+idveiculo+'&idrastreado=0','veiculo');
}
function novocomponentealmox()
{
    var idrastreado=document.getElementById("idrastreado").value;
    var idpessoa = window.document.getElementById("idpessoa").value;
    var chip = window.document.getElementById("numerochip").value;
    var strURL='php/montacomponenterastreado.php?idpessoa='+idpessoa+'&numero_chip='+chip+'&idrastreado='+idrastreado;
    injeta(strURL, "#componentes", "#itemdetalhe", "slide", "contcomponentes" );
    nossotoast("Incluindo componentes do item");
}
function inspecao(chip,idrastreado)
{
    var idpessoa = window.document.getElementById("idpessoa").value;
    var strURL='php/inspecao.php?idpessoa='+idpessoa+'&numero_chip='+chip+'&idrastreado='+idrastreado;
    injeta(strURL, "#componentes", "#itemdetalhe", "slide", "contcomponentes" );
    nossotoast("Inspecionar veículos");
}
function novocomponenterastreado()
{
    var idrastreado=document.getElementById("idrastreado").value;
    var idpessoa = window.document.getElementById("idpessoa").value;
    var numero_chip = window.document.getElementById("chip_rastreado").value;
     
    var strURL='php/Montacomponente.php?idpessoa='+idpessoa+'&numero_chip='+numero_chip+'&idrastreado='+idrastreado;
    injeta(strURL, "#page-wrapper", "#page-wrapper", "slide", "page-wrapper" );
    nossotoast("Incluindo componentes do item");
}
function novoitemrastreado()
{
    $.afui.loadContent("#novoitem", null, null, "spin");
    nossotoast("Incluindo Item do modelo");
}
function incluirastreado()
{
    if(document.getElementById("selrastreadomaster").value==="#")
    {
        return;
    }
    var idpessoa=document.getElementById("idpessoa").value;
    var idrastreado=document.getElementById("selrastreadomaster").value;
    var strURL="php/Incluirastreado.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado;
    injeta(strURL, "#novoitem", "#institucional", "slide", "contitem" );
    nossotoast("Atualize o Item do modelo ");
}
function listaitem(idrastreado, indveiculo)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/listaitens.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado;
    injeta(strURL, "#contgeral", "#contgeral", "fade", "contgeral" ); 
    nossotoast("Selecione o Item do modelo ");
}
function detalhesmenu(in_numero_chip, idrastreado, indveiculo)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idusuario=document.getElementById("idusuario").value;
    var strURL="painelveiculo.php?idpessoa="+idpessoa+"&numero_chip="+in_numero_chip+"&idrastreado=0"+"&idusuario="+idusuario;
    injeta(strURL, "#contgeral", "#contgeral", "fade", "contgeral" ); 
}
function novocompalmox(idcomponente)
{
    var idpessoa=document.getElementById("idpessoa").value;
     
    var strURL="php/selecionainclusao.php?idpessoa="+idpessoa+"&idcomponente="+idcomponente; 
    injeta(strURL, "execmanu", "execmanu", "slide", "execmanu" );
}
function mostracompalmox(numero_chip)
{
    var idcomponente=document.getElementById("idcomponentealmox").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/selecionacomponente.php?idpessoa="+idpessoa+"&idcomponente="+idcomponente+"&numero_chip="+numero_chip; 
    injeta(strURL, "execmanu", "execmanu", "slide", "execmanu" );
}
function mostracompveiculo(idcomponente,numero_chip)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/selecionacompveiculo.php?idpessoa="+idpessoa+"&idcomponente="+idcomponente+"&numero_chip="+numero_chip; 
    injeta(strURL, 'execmanu', "#execmanu", "slide", 'execmanu' );
}
function desmontacomp(idcomponente,numero_chip,numero_serie)
{
    var chip_veiculo=document.getElementById("idveiculo").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/desmonta_componente.php?idpessoa="+idpessoa
            +"&idcomponente="+idcomponente
            +"&numero_serie="+numero_serie
            +"&chip_veiculo="+chip_veiculo
            +"&chip="+numero_chip; 
   
    executa(strURL);
    limpadiv("page-wrapper");
    var link="'php/listacompveiculo.php?idpessoa="+idpessoa+"&numero_chip='"+chip_veiculo+"'"+'"';
    novoresumo(link,'div');
}
function mostracompitem()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idrastreado=document.getElementById("idrastreado").value;
    var numero_chip=document.getElementById("iditem").value;
    var strURL="php/componente_rastreado.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado+"&numero_chip="+numero_chip; 
    injeta(strURL, "#componentes", "#familia", "slide", "contcomponentes" );
}
function atualizacompalmox()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idcomponente=document.getElementById("idcomponente").value;
    var numero_serie=document.getElementById("numserie").value;
    var numero_chip=document.getElementById("chipcomponente").value;
    var chip=document.getElementById("chipsalva").value;
    var valor=document.getElementById("valor").value;
    if(numero_chip==="Instale e leia a tag")
    {
        nossotoast("Instale e leia a tag");
        numero_chip=numero_serie;
    }
    
    var strURL="php/atualiza_comp_almox.php?idpessoa="+idpessoa
            +"&idcomponente="+idcomponente
            +"&numero_serie="+numero_serie
            +"&chip="+chip
            +"&valor="+valor
            +"&numero_chip="+numero_chip;
    executa(strURL);
}
function novafamilia()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var nomefamilia=document.getElementById("nomefamilia").value;
    var ispneu=document.getElementById("cindpneu").value;
    var strURL="php/Incluir_familia_comp.php?idpessoa="+idpessoa
            +"&nomecomponente="+nomefamilia+"&cindpneu="+ispneu;
    executa(strURL);
    
}
function atualizafamilia()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idcomponente=document.getElementById("selectcomp").value;
    var cindpneu=document.getElementById("cindpneu");
    var cindqrcode=document.getElementById("cindqrcode");
    var cindbeacon=document.getElementById("cindbeacon");
    var cindchipado=document.getElementById("cindchipado");
    var cindmanual=document.getElementById("cindmanual");
    var cindbarras=document.getElementById("cindbarras");
    var nomefamilia=document.getElementById("nomefamilia");
    var strURL="php/atualiza_familia_comp.php?idpessoa="+idpessoa
            +"&idcomponente="+idcomponente
            +"&cindpneu="+cindpneu
            +"&cindqrcode="+cindqrcode
            +"&cindchipado="+cindchipado 
            +"&cindbeacon="+cindbeacon
            +"&cindmanual="+cindmanual
            +"&nomefamilia="+nomefamilia
            +"&cindbarras="+cindbarras;
    executa(strURL);
}
function listacomponenentes(idcomponente)
{
    var idpessoa=document.getElementById("idpessoa").value;
//    var idcomponente=document.getElementById("idcomponente").value; 
    var strURL="php/listacomponentes.php?idpessoa="+idpessoa+"&idcomponente="+idcomponente; 
    injeta(strURL, "#page-wrapper", "#page-wrapper", "spin", "page-wrapper" );
}
function mostrafamilia(idcomponente)
{
    listacomponenentes(idcomponente);
//    var idpessoa=document.getElementById("idpessoa").value;
//    
//    var strURL="php/familiacomponentes.php?idpessoa="+idpessoa+"&idcomponente="+idcomponente; 
//    injeta(strURL, "#contgeral", "#contgeral", "spin", "contgeral" );
}
function associafamilia(idrastreado)
{
    var idpessoa=document.getElementById("idpessoa").value;
     
    var strURL="php/familias_rastreado.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado; 
    injeta(strURL, "#familia", "#almox", "spin", "contfamilia" );
}
function addeixos()
{
    // Find a <table> element with id="myTable":
    var table = document.getElementById("eixos");

    // Create an empty <tr> element and add it to the 1st position of the table:
    var row = table.insertRow(0);

    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(0);
    var cell3 = row.insertCell(0);
     
    // Add some text to the new cells:
    cell1.innerHTML = "NEW CELL1";
    cell2.innerHTML = "NEW CELL2";
}
function atualizaeixos(ideixo_veiculo)
{
    var chip_veiculo=document.getElementById("idveiculo").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var ideixos=document.getElementById("selecteixo"+ideixo_veiculo).value;
    var qtdrodas=document.getElementById("selqtdrodas"+ideixo_veiculo).value;
    var strURL="php/atualiza_eixo.php?idpessoa="+idpessoa+"&chip_veiculo="+chip_veiculo
            +"&ideixos="+ideixos+"&qtdrodas="+qtdrodas+"&ideixo_veiculo="+ideixo_veiculo;
    
    executa(strURL);
}
function checachip(id)
{
    var ident=document.getElementById(id);
    ident.src="./images/checkmenor.png"; 
    verificachip(id);
}
function carregamedida(po)
{
    document.getElementById('marca').value="";
    document.getElementById('selmodelo').value="";
    document.getElementById('medida').value="";
    var strURL="php/getmedida.php?po="+po;
    injeta(strURL,"seltarea","seltarea","slide","seltarea");
    limpadiv("selmarea");
    limpadiv("selxarea");
     
}
function carregamarca(medida)
{
    document.getElementById('marca').value="";
    document.getElementById('selmodelo').value="";
    document.getElementById('medida').value=medida;
    var strURL="php/getmarca.php?medida="+medida;
    injeta(strURL,"selmarea","selmarea","slide","selmarea");
    limpadiv("selxarea");
     
}
function carregamodelo(marca)
{
    document.getElementById('marca').value=marca;
    document.getElementById('selmodelo').value="";
    var medida=document.getElementById('medida').value;
    var strURL="php/getmodelo.php?medida="+medida+"&marca="+marca;
    injeta(strURL,"selxarea","selxarea","slide","selxarea");
}
function setamodelo(modelo)
{
    document.getElementById('selmodelo').value=modelo;
    
}
function eixos()
{
    var idveiculo = document.getElementById("idveiculo").value;
    var strURL="php/eixos.php?idveiculo="+idveiculo;
    parent.window.frames['tabmestra'].location = strURL; 
}

function montarcomp()
{
    var numserie = document.getElementById("selectitem").value;
    var chip = document.getElementById("idpneu").value;
    var idpessoa = document.getElementById("idpessoa").value;
    var chip_veiculo=document.getElementById("chip_veiculo").value;
    var idcomponente=document.getElementById("selectcomp").value;
    var strURL="php/monta_componente.php?idpessoa="+idpessoa
            +"&numserie="+numserie
            +"&chip="+chip
            +"&chip_veiculo="+chip_veiculo
            +"&idcomponente="+idcomponente;
    executa(strURL);
}
function montarcomprastreado()
{
    var idpessoa = document.getElementById("idpessoa").value;
    var chip_veiculo=document.getElementById("numerochip").value;
    var idrastreado=1;
    var tab=document.getElementById("selectitem").value.split("&&");
    var numserie = tab[1];
    var chip = tab[0];
    var idcomponente=document.getElementById("selectcomp").value;
    var strURL="php/monta_componente_rastreado.php?idpessoa="+idpessoa
            +"&numero_serie="+numserie
            +"&chip="+chip
            +"&chip_veiculo="+chip_veiculo
            +"&idrastreado="+idrastreado
            +"&idcomponente="+idcomponente;
    executa(strURL);
}
 function lerchipalmox()
{
   document.getElementById("chip").value="chip passou";
   var chip = window.parent.Android.lerchip();
   document.getElementById("chipcomponente").value=chip;
}
function trocacomp(idcomponente)
{
   var img = document.getElementById("img"+idcomponente);
   var idpessoa = document.getElementById("idpessoa").value;
   var idrastreado=document.getElementById("idrastreadofamilia").value;
   var status=document.getElementById("val"+idcomponente).value;
   if(status==="OK")
   {
       document.getElementById("val"+idcomponente).value="NOK";
       document.getElementById("img"+idcomponente).src="./images/NOcheckmenor.png";
       var strURL="php/excluir_familia_rastreado.php?idpessoa="+idpessoa+"&idcomponente="+idcomponente+"&idrastreado="+idrastreado;
       executa(strURL);   
   }
   else
   {
       document.getElementById("val"+idcomponente).value="OK";
       document.getElementById("img"+idcomponente).src="./images/checkmenor.png";
       var strURL="php/incluir_familia_rastreado.php?idpessoa="+idpessoa+"&idcomponente="+idcomponente+"&idrastreado="+idrastreado;
       executa(strURL);
   }
}
