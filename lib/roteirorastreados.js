function mostrarastreados()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idrastreado=0;
    var strURL="php/mostrarastreado.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado;
    injeta(strURL, "#modelo", "#inicio", "spin", "contmodelo" );
}
function rastreando()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="sectionsmenu.php?idpessoa="+idpessoa;
    injeta(strURL, "#contgeral", "#contgeral", "slide", "contgeral" );
}
function novorastreado()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/novorastreado.php?idpessoa="+idpessoa;
    injeta(strURL, "#rastrear", "#inicio", "fade", "contrastrear" );
}
function atualizarastreado()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idrastreado=document.getElementById("selrastreado").value;
    var nomerastreado=document.getElementById("nomerastreado").value;
    var indalmox="S";
    var indveiculo=document.getElementById("indveiculo").value;
    var indqrcode=document.getElementById("indqrcode").value;
    var indbeacon=document.getElementById("indbeacon").value;
    var indchipado=document.getElementById("indchipado").value;
    var indmanual=document.getElementById("indmanual").value;
    var indbarras=document.getElementById("indbarras").value;

    if(nomerastreado==="")
    {
        nossotoast("Informe o nome dos itens rastreados");
        return;
    }
    var strURL="php/atualiza_rastreado.php?idpessoa="+idpessoa
            +"&idrastreado="+idrastreado
            +"&nomerastreado="+nomerastreado
            +"&indveiculo="+indveiculo
            +"&indqrcode="+indqrcode
            +"&indbeacon="+indbeacon
            +"&indchipado="+indchipado
            +"&indmanual="+indmanual
            +"&indbarras="+indbarras;
 
    executa(strURL);
}
function criarastreado()
{
    // SIGNIN SERVER CALL CODE GOES HERE
    var idpessoa=document.getElementById("idpessoa").value;
    var nomerastreado=document.getElementById("nomerastreado").value;
     
    var indveiculo=document.getElementById("indveiculo").value;
    var indqrcode=document.getElementById("indqrcode").value;
    var indbeacon=document.getElementById("indbeacon").value;
    var indchipado=document.getElementById("indchipado").value;
    var indmanual=document.getElementById("indmanual").value;
    var indbarras=document.getElementById("indbarras").value;
    if(nomerastreado==="")
    {
        nossotoast("Informe o nome da categoria");
        return;
    }
   
    var strURL="php/insere_rastreado.php?idpessoa="+idpessoa
             
            +"&nomerastreado="+nomerastreado
            +"&indalmox="+indalmox
            +"&indveiculo="+indveiculo
            +"&indqrcode="+indqrcode
            +"&indbeacon="+indbeacon
            +"&indchipado="+indchipado
            +"&indmanual="+indmanual
            +"&indbarras="+indbarras;
    executa(strURL);
}
function checkcomponente(id)
{
    var cindpneu=document.getElementById("cindpneu");
    var cindqrcode=document.getElementById("cindqrcode");
    var cindbeacon=document.getElementById("cindbeacon");
    var cindchipado=document.getElementById("cindchipado");
    var cindmanual=document.getElementById("cindmanual");
    var cindbarras=document.getElementById("cindbarras");

    
    var cipneu=document.getElementById("cipneu");
    var ciqrcode=document.getElementById("ciqrcode");
    var cibeacon=document.getElementById("cibeacon");
    var cichipado=document.getElementById("cichipado");
    var cimanual=document.getElementById("cimanual");
    var cibarras=document.getElementById("cibarras");
    switch(id)
    {    
        case 7:   
            if(cindqrcode.value==="S")
                {cindqrcode.value="N";ciqrcode.src="./images/qrcode.png";cimanual.src="./images/OKlupa.png";cindmanual.value="S";}
            else
                {ciqrcode.src="./images/OKqrcode.png";cindqrcode.value="S";
                 cibeacon.src="./images/beacon.png"; cichipado.src="./images/RFID.png"; cimanual.src="./images/lupa.png"; cibarras.src="./images/codbarras.png";
                 cindbeacon.value="N";cindchipado.value="N";cindmanual.value="N";cindbarras.value="N";cindbarras.value="N";
                 nossotoast("Rastreado por QRCODE"); 
            }
            break;
        case 8:   
             if(cindbeacon.value==="S")
                {cindbeacon.value="N";cibeacon.src="./images/beacon.png";cimanual.src="./images/OKlupa.png";cindmanual.value="S";}
            else
                {cibeacon.src="./images/OKbeacon.png";cindbeacon.value="S";
                 ciqrcode.src="./images/qrcode.png"; cichipado.src="./images/RFID.png"; cimanual.src="./images/lupa.png"; cibarras.src="./images/codbarras.png";
                 cindqrcode.value="N";cindchipado.value="N";cindmanual.value="N";cindbarras.value="N";
                 nossotoast("Rastreado por BEACONS"); 
            }
            break; 
        case 9:   
            if(cindchipado.value==="S")
                {cindchipado.value="N";cichipado.src="./images/RFID.png";cimanual.src="./images/OKlupa.png";cindmanual.value="S";}
            else
                {cichipado.src="./images/OKRFID.png";cindchipado.value="S";
                 ciqrcode.src="./images/qrcode.png"; cimanual.src="./images/lupa.png"; cibarras.src="./images/codbarras.png";cibeacon.src="./images/beacon.png";
                 cindqrcode.value="N";cindbeacon.value="N";cindmanual.value="N";cindbarras.value="N";
                 nossotoast("Rastreado por RFID"); 
            }
            break;    
        case 10:   
            if(cindbarras.value==="S")
                {cindbarras.value="N";cibarras.src="./images/codbarras.png";cimanual.src="./images/OKlupa.png";cindmanual.value="S";}
            else
                {cibarras.src="./images/OKcodbarras.png";cindbarras.value="S";
                 ciqrcode.src="./images/qrcode.png"; cimanual.src="./images/lupa.png"; cichipado.src="./images/RFID.png";cibeacon.src="./images/beacon.png";
                 cindqrcode.value="N";cindbeacon.value="N";cindchipado.value="N";cindmanual.value="N";
                 nossotoast("Rastreado por Código de barras"); 
            }
            break; 
        case 11:   
            if(cindmanual.value==="S")
                {nossotoast("O modelo manual é básico.");}
            else
                {cimanual.src="./images/OKlupa.png";cindmanual.value="S";
                 ciqrcode.src="./images/qrcode.png"; cibarras.src="./images/codbarras.png"; cichipado.src="./images/RFID.png";cibeacon.src="./images/beacon.png";
                 cindqrcode.value="N";cindbeacon.value="N";cindchipado.value="N";cindbarras.value="N";
                 nossotoast("Rastreado visualmente"); 
            }
            break; 
        case 12:   
            if(cindpneu.value==="S")
                {cindpneu.value="N";cipneu.src="./images/pneu.png";}
            else
            {
                cindpneu.value="S"; cipneu.src="./images/OKpneu.png";
                nossotoast("Componente é um pneu."); 
            }
            break; 
    }
}
function checkrastreado(id)
{
    var id=document.getElementById(id);
    if(id.checked)
    {
        document.getElementById(id).value="S";
    }
    else
    {
        document.getElementById(id).value="N";
    }
}
function todositens(idrastreado)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/todosrastreados.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado;
    injeta(strURL, "#selitemid", "#inicio", "slide", "contitemid" );
    carregarastreados(idrastreado);
}
function carregarastreados()
{
    var idpessoa = document.getElementById('idpessoa').value; 
//    var idrastreado = document.getElementById('selrastreadomaster').value;
    var idrastreado = 0;
    var strURL="php/listaveiculo.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado;
    var req = getXMLHTTP();
    if (req){
        req.onreadystatechange = function(){   
        if (req.readyState == 4){
            if (req.status == 200){
                var opcoes = req.responseText.substring(1,req.responseText.lenght);
                if (opcoes != null){
                    ddl = document.getElementById('listarastreado');
                    ddl.length = 0;
                    document.getElementById('listarastreado').options[0] = new Option("Selecione o ITEM RASTREADO", "#");
                    var i = 0;
                    var tab = opcoes.split("%");
                    for (i = 0; i < tab.length; i++) 
                    {
                        var opt = tab[i].split("#");

                        document.getElementById('listarastreado').options[i + 1] = new Option(opt[1], opt[0]);
                    }}} else{}}			
        }
        req.open("GET", strURL, true);
        req.send(null);
    }
}

function novoitemcompo(idrastreado, numero_chip)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idrastreado=document.getElementById("idrastreado").value;
    var numero_chip=document.getElementById("iditem").value;
    var nomeitem=document.getElementById("nomeitem").value;
    var strURL="php/incluiitemcompo.php?idpessoa="+idpessoa
            +"&idrastreado="+idrastreado
            +"&numero_chip="+numero_chip
            +"&nomeitem="+nomeitem;
    injeta(strURL, "#novoitem", null, "slide", "contdetitem" );
}
function componentesitem(){
    
    var idpessoa=document.getElementById("idpessoa").value;
    var idrastreado=document.getElementById("idrastreado").value;
    var numero_chip=document.getElementById("iditem").value;
    if(numero_chip==="#")
    {
        nossotoast("Selecione o item");
        return;
    }
    var nomeitemrastreado=document.getElementById("nomeitem").value;
    var strURL="php/componente_rastreado.php?idpessoa="+idpessoa
            +"&idrastreado="+idrastreado
            +"&numero_chip="+numero_chip
            +"&nomeitem="+nomeitemrastreado;
    injeta(strURL, "#componentes", "#itemdetalhe", "slide", "contcomponentes" );
}
function atualizaitem()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idrastreado=document.getElementById("idrastreado").value;
    var numero_chip=document.getElementById("iditem").value;
    var nomeitemrastreado=document.getElementById("nomeitem").value;
    var strURL="php/atuaitemrastreado.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado
            +"&numero_chip="+numero_chip+"&nomeitemrastreado="+nomeitemrastreado;
    executa(strURL);
}
function verificachip(chip)
    {
       if(chip==="")
       {
           nossotoast("Leitora não encontrada ou com problemas, contate o suporte");
       }
       var qtditens=document.getElementById("qtditens").value;
       var encontrados=document.getElementById("qtdfound").value;
       if(qtditens * 1===encontrados * 1)
        {
            nossotoast('TODOS OS ITENS ENCONTRADOS de '+qtditens); 
            return;
        }
        var rastreado = document.getElementById("idrastreado").value;
        
        
        if(document.getElementById(chip))
        {
            var idcomponente=document.getElementById("C"+chip).value;
//            tripa=tripa+"idcomponente"+idcomponente+"</br> ";
            var numserie=document.getElementById(chip).name+"</br> ";  

            if(document.getElementById("I"+chip))
            {
                var img=document.getElementById("I"+chip);
                var status=document.getElementById("S"+chip).value;
                if(status!=="CHECKED")
                {
                    document.getElementById("S"+chip).value="CHECKED";
                    img.src="./images/checkmenor.png";
                    var strURL="php/insere_inspecao.php?$idcomponente="+idcomponente+"&chip="+
                        rastreado+"&chipcomp="+chip+"&numserie="+numserie+"&status=CHECKED";
                    encontrados++;
                    document.getElementById("qtdfound").value=encontrados;
                    executa(strURL);
                    
                    document.getElementById(chip).scrollIntoView();
                    nossotoast('encontrados '+encontrados+" de "+qtditens);
                }
                else
                {
                    nossotoast('Item já encontrado');
                }
            }
        }
        else
        {
            nossotoast('Item não encontrado');
        }
        

    }

function mostraqrcode()
{
    var numero_serie=document.getElementById("numserie").value;
    document.getElementById("chipcomponente").value=numero_serie;
    if(numero_serie=="")
    {
        nossotoast("Informe o numero de série ou descrição")
    }
    //var link = "phpqrcode/index.php?data="+numero_serie;
    //injeta(link,'#qrcode','#componente','spin','contqrcode');
    var strURL="phpqrcode/mostra.php?data=" + numero_serie+"";
    var req = getXMLHTTP();
    if (req){   
    req.onreadystatechange = function(){   
        if (req.readyState === 4)
            if(req.status === 200){
                document.getElementById("contimgqrcode").innerHTML=req.responseText;
            };
        }
    }
    req.open("POST", strURL, false);
    req.send();
}
function printqrcode()
{
    var plataforma=document.getElementById("plataforma").value;
    if(plataforma!="windows")
    {
        nossotoast("Impressão no Windows apenas");
        return;
    }
    var numero_serie=document.getElementById("numserie").value;
    document.getElementById("chipcomponente").value=numero_serie;
    if(numero_serie=="")
    {
        nossotoast("Informe o numero de série ou descrição")
    }
    //var link = "phpqrcode/index.php?data="+numero_serie;
    // 
    var strURL="phpqrcode/index.php?data=" + numero_serie;
    injeta(strURL,'#qrcode','#componente','spin','contqrcode');
}
function reprintqrcode()
{
    var numero_serie=document.getElementById("numserie").value;
    var level=document.getElementById("level").value;
    var size=document.getElementById("size").value;
    
    document.getElementById("chipcomponente").value=numero_serie;
    if(numero_serie=="")
    {
        nossotoast("Informe o numero de série ou descrição")
    }
    //var link = "phpqrcode/index.php?data="+numero_serie;
    // 
    var strURL="phpqrcode/index.php?data=" + numero_serie+"&level="+level+"&size="+size;
    injeta(strURL,'#qrcode','#componente','spin','contqrcode');
}