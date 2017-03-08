
function carousel()
{
    var strURL="carousel.html";
    injeta(strURL, "#contgeral", "#contgeral", "fade", "contgeral" ); 
}
function main()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idusuario=document.getElementById("idusuario").value;
    var strURL="main.php?idpessoa="+idpessoa+"&idusuario="+idusuario;
    injeta(strURL, "#main", "#main", "fade", "main" );
    var d = document.getElementById("plataforma").value;
    var text="";
    if(d!=="")
    {
        text='<p style="font:11px Arial;margin:1rem;letter_spacing:1px;">'+d+'';
        var a = document.getElementById("macaddress").value;
        if(a!=="")
        {
            text=text+' - '+a+'';
        }
        text=text+ '</p>';
    }
    else { 
        text='<p style="font:11px Arial;;margin:1rem;letter_spacing:0px;">VERSÂO MANUAL</p>'; 
    };
    var text= text+'<p style="font:8px Arial;margin:1rem;letter_spacing:0px;">'+ document.getElementById("razao_social").value + "<br>"
    '</p>';
//    document.getElementById("emparea").innerHTML=text;
           
}
function pesq()
{
    var idpessoa = document.getElementById("idpessoa").value;
    if((document.getElementById("adm_veiculo").value==="S")||
        (document.getElementById("adm_portaria").value==="S")    )
    {
        var strURL="php/pesquisa_veiculo.php?idpessoa="+idpessoa;
        limpadiv("page-wrapper");
        injeta(strURL, "#contgeral", "#contgeral", "slide", "contgeral" );
    }
    limpadiv("tabmenu");
    var strURL="php/resumogeral.php?idpessoa="+idpessoa;
    injeta(strURL, "page-wrapper", "veiculo", "slide", "page-wrapper" );
}
function atualiza_chip_pneu(numero_serie)
{
    nossotoast("Leia o chip do pneu");
    var chip=lerchip();
    if(chip==="")
    {
        nossotoast("Verifique a leitora de chips");
        return;
    }
    var idpessoa = document.getElementById("idpessoa").value;
    var strURL="php/atualiza_chip_pneu.php?idpessoa="+idpessoa+"&chip="+chip+"&numero_serie="+numero_serie;
    executa(strURL);
}
function desmontapneu(chip)
{
    var idpessoa = document.getElementById("idpessoa").value;
    var idveiculo=document.getElementById("idveiculo").value;
    var strURL="php/desmonta_pneus.php?idpessoa="+idpessoa+"&chip="+chip+"&chip_veiculo="+idveiculo;
    
    executa(strURL);
    limpadiv("tabmenu");
     var strURL="php/plantapneus.php?idpessoa="+idpessoa
            +"&numero_chip="+idveiculo;
    injeta(strURL,"page-wrapper","page-wrapper","slide","page-wrapper");
}
function gravakm()
{
    var idveiculo=document.getElementById("idveiculo").value;
    var idpessoa = document.getElementById("idpessoa").value;
    var kmveiculo=document.getElementById("kmveiculotxt").value;
    kmveiculo=kmveiculo.replace(".","");
    kmveiculo=kmveiculo.replace(",","");
    document.getElementById("kmveiculo").value=kmveiculo;
    var strURL="php/atualiza_kmveiculo.php?idpessoa="+idpessoa+"&idveiculo="+idveiculo+"&kmveiculo="+kmveiculo;
    executa(strURL);
    
    detalhesmenu(idveiculo,1,'S');
    limpadiv("tabkm");
}
function instalapneu(eixo,roda,chip)
{
    var idveiculo = document.getElementById("idveiculo").value;
    var idpessoa = document.getElementById("idpessoa").value;
     
    
    if(chip==="#")
    {
        nossotoast("Selecione o pneu do almoxarifado");
        return;
    }
    var strURL="php/Instala_pneus.php?idpessoa="+idpessoa
            +"&chip_veiculo="+idveiculo
            +"&chip="+chip
            +"&eixo="+eixo
            +"&roda="+roda;
    executa(strURL);
    var strURL="php/plantapneus.php?idpessoa="+idpessoa
            +"&numero_chip="+idveiculo;
    injeta(strURL,"page-wrapper","page-wrapper","slide","page-wrapper");
}
function mostrapneualmox(chip)
{
    var tab= chip.split("*");
    var eixo= tab[0];
    var roda= tab[1];
    var numchip= tab[3];
    
    var idpessoa = document.getElementById("idpessoa").value; 
    var strURL="php/monta_pneus_almox.php?idpessoa="+idpessoa+"&tag="+chip+"&eixo="+eixo+"&roda="+roda;
    injeta(strURL, "areamonta", "#contgeral", "slide", "areamonta" );
    limpadiv("tabmenu");
}
function manutencao(idplano)
{
    var idpessoa = document.getElementById("idpessoa").value;
    var idveiculo = document.getElementById("idveiculo").value;
     var strURL="php/manutencao_veiculo.php?idpessoa="+idpessoa+"&chip_veiculo="+idveiculo+"&idplano="+idplano;
    limpadiv("page-wrapper");
    injeta(strURL, "#page-wrapper", "#page-wrapper", "slide", "page-wrapper" );
}
function montaplanos()
{
    var idpessoa = document.getElementById("idpessoa").value;
    var idveiculo = document.getElementById("idveiculo").value;
    var strURL="php/monta_planos.php?idpessoa="+idpessoa+"&idveiculo="+idveiculo;
    novoresumo(strURL, "menu" );
}
function associaplano(idplano)
{
    var idusuario = document.getElementById("idusuario").value;
    var idpessoa = document.getElementById("idpessoa").value;
    var idveiculo = document.getElementById("idveiculo").value;
    var strURL="php/Associa_planos.php?idpessoa="+idpessoa
            +"&idveiculo="+idveiculo
            +"&idplano="+idplano
            +"&idusuario="+idusuario;
    executa(strURL);
    var strURL="php/planos_veiculo.php?idpessoa="+idpessoa+"&chip_veiculo=".idveiculo;
    
    injeta(strURL, "#tabmenu", "#tabmenu", "slide", "tabmenu" );
}
function inspecionaveiculo(chip_veiculo)
{
    var idpessoa = document.getElementById("idpessoa").value;
     
    var strURL="query_compo.php?idpessoa="+idpessoa+"&chip_veiculo="+chip_veiculo;
    injeta(strURL, "#page-wrapper", "#page-wrapper", "slide", "page-wrapper" );
    limpadiv("tabmenu");
}
function novoveiculo()
{
    var idpessoa = document.getElementById("idpessoa").value;
    var strURL="php/inclui_veiculo.php?idpessoa="+idpessoa;
    injeta(strURL, "#page-wrapper", "#page-wrapper", "slide", "page-wrapper" );
    limpadiv("tabmenu");
}
function limpadiv(div)
{
    document.getElementById(div).innerHTML=" ";
}

function loadJavaScriptSync(filePath)
{
   var req = new XMLHttpRequest();
   req.open("GET", filePath, false); // 'false': synchronous.
   req.send(null);
}

//////////////////////////////////// Trata os acessos aos menus ////////////////////////
function menu_trata_acesso(id)
{
    var adm_gestor = document.getElementById("adm_gestor").value;
    var adm_almox = document.getElementById("adm_almox").value;
    var adm_portaria = document.getElementById("adm_portaria").value;
    var adm_usuario = document.getElementById("adm_usuario").value;
    var adm_veiculo = document.getElementById("adm_veiculo").value;
    var adm_rastreado = document.getElementById("adm_rastreado").value;
    switch(id)
    {
        case 1:
            //var optt = document.ge
            var optr = document.getElementById("optrastreamento");
            var optu = document.getElementById("optrastreado");
            var optf = document.getElementById("optinstitucional");
            var opte = document.getElementById("optalmoxarifado");
            if (adm_rastreado==="S") 
            {
                optu.disabled = false;
            } 
            if (adm_portaria==="S") 
            {
                optr.disabled = false;
            };
            if (adm_gestor==="S") {
                optf.disabled = false;
            };
             if (adm_almox==="S") {
                opte.disabled = false;
            };
    }
}
//////////////////////////////////// LOGON ////////////////////////
function signIn()
{
    // SIGNIN SERVER CALL CODE GOES HERE
    nossotoast("Verificando o usuário e senha");
    var usuario=document.getElementById("usuario").value;
    var senha=document.getElementById("senha").value;
    var strURL="php/query_usuario.php?usuario="+usuario+"&senha="+senha;
    var req = getXMLHTTP();
    if (req)
    {   
        req.onreadystatechange = function()
        {   if (req.readyState === 4) 
            {
                if (req.status === 200) 
                {	

                    var resposta=JSON.parse(req.responseText);
                    var mensagem = resposta.message;
                    var success = resposta.success;

                    if(success>0)
                    {
                        var idpessoa= resposta.idpessoa;
                        var idusuario=resposta.idusuario;
                        var razao_social= resposta.razao_social;
                        var adm_gestor = resposta.gestor;
                        var adm_almox = resposta.adm_almox;
                        var adm_portaria = resposta.adm_portaria;
                        var adm_usuario = resposta.adm_usuario;
                        var adm_veiculo = resposta.adm_veiculo;
                        var adm_rastreado = resposta.adm_rastreado;
                        var plataforma = document.getElementById("plataforma").value;

                        document.getElementById("razao_social").value=razao_social;
                        document.getElementById("idusuario").value=idusuario;
                        document.getElementById("idpessoa").value=idpessoa;
                        document.getElementById("adm_gestor").value=adm_gestor;
                        document.getElementById("adm_almox").value=adm_almox;
                        document.getElementById("adm_portaria").value=adm_portaria;
                        document.getElementById("adm_usuario").value=adm_usuario;
                        document.getElementById("adm_veiculo").value=adm_veiculo;
                        document.getElementById("adm_rastreado").value=adm_rastreado;
//                        menu();
                        main();
                        var strURL="php/logg.php?usuario="+usuario
                                +"&razao_social="+razao_social
                                +"&plataforma="+plataforma;
                        executa(strURL);
                        limpadiv("contgeral");
                        
                        pesq();
                        document.getElementById("myNavbar").style.width = "0";
                        document.getElementById("myNavbar").style.zIndex = "-1";
                    }
                    else
                    {
                        nossotoast(mensagem);
                    }
                } 
                else 
                {
                    resposta=req.readyState;
                }
            }
        };

        req.open("POST", strURL, false);
        req.send(); 
    }

}
function abrecomp(idrastreado, indveiculo, chip)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="";
    if(indveiculo==="S")
    {
        strURL="listaveiculos.php?chip="+chip+"&idpessoa="+idpessoa+"&idrastreado="+idrastreado;
    }
    else
    {
        strURL="listaitem.php?chip="+chip+"&idpessoa="+idpessoa+"&idrastreado="+idrastreado;
    }
    nossotoast("Rastreando os componentes");
    injeta(strURL, "#inicio", "#rastrear", "slide", "contrastreados" );
}
function painelcompo(strURL)
{
    injeta(strURL, "#almox", "#institucional", "slide", "contrastrear" );
}
function getitemcox(numero_chip)
{
    var idcomponente = document.getElementById('idcomponente').value;
    var idpessoa = document.getElementById('idpessoa').value; 
    var strURL="php/compoalmox.php?idcomponente="+idcomponente+"&idpessoa="+idpessoa+"&numero_chip="+numero_chip;
    injeta(strURL, "#contgeral", "#rastrear", "slide", numero_chip );

}
function getcompos(status) {
    var numero_chip = document.getElementById('numerochip').value;
    var idcomponente = document.getElementById('selectcomp').value;
    if(idcomponente==="#")
    {
        nossotoast("Selecione o modelo");
        document.getElementById("contdetrastreado").innerHTML="<br>";   
        return;
    }
    var idpessoa = document.getElementById('idpessoa').value;
    var strURL='';
    if(status==="almox")
    {
        strURL="php/getcompos.php?idcomponente="+idcomponente+"&idpessoa="+idpessoa;
    }
    else
    {
        strURL="php/getmontados.php?idcomponente="+idcomponente+"&idpessoa="+idpessoa+"&numero_chip="+numero_chip;
    }
    var req = getXMLHTTP();

    if (req){req.onreadystatechange = function()
    {   if (req.readyState == 4) 
        {
                // only if "OK"
                if (req.status == 200) 
                {
                    var opcoes = req.responseText.substring(1,req.responseText.lenght);
                   
                    if (opcoes != null) 
                    {
                        ddl = document.getElementById('selectitem');
                        
                        ddl.length = 0;
                        document.getElementById('selectitem').options[0] = new Option("Selecione o componente", "0");
                        var i = 0;
                        var tab = opcoes.split("%");
                        for (i = 0; i < tab.length; i++) 
                        {
                            var opt = tab[i].split("#");
                            document.getElementById('selectitem').options[i + 1] = new Option(opt[1], opt[0]);
                        }
                    }
                } 
                else 
                {
                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                }
        }				
    }			
    req.open("GET", strURL, true);
    req.send(null);
    }		
}
function getcomposalx() {		
    var idcomponente = document.getElementById('compo').value;
    if(idcomponente==="#")
    {
        nossotoast("Selecione o modelo de rastreado");
        document.getElementById("contdetrastreado").innerHTML="<br>";   
        return;
    }
    var idpessoa = document.getElementById('idpessoa').value; 
    var strURL="php/getcompos.php?idcomponente="+idcomponente+"&idpessoa="+idpessoa;
    var req = getXMLHTTP();

    if (req){req.onreadystatechange = function()
    {   if (req.readyState == 4) 
        {
                // only if "OK"
                if (req.status == 200) 
                {
                    var opcoes = req.responseText.substring(1,req.responseText.lenght);
                    $('selectalx').empty();
                    if (opcoes != null) 
                    {

                        ddl = document.getElementById('selectalx');
                        ddl.length = 0;
                        document.getElementById('selectalx').options[0] = new Option("Selecione o componente", "0");
                        var i = 0;
                        var tab = opcoes.split("%");
                        for (i = 0; i < tab.length; i++) 
                        {
                            var opt = tab[i].split("#");
                            document.getElementById('selectalx').options[i + 1] = new Option(opt[1], opt[0]);
                        }
                    }

//                            document.getElementById('medida').innerHTML=req.responseText;						
                } else 
                {
                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                }
        }				
    }			
    req.open("GET", strURL, true);
    req.send(null);
    }
}
function almox()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/treealmox.php?idpessoa="+idpessoa;

    injeta(strURL, "#contgeral", "#contgeral", "slide", "contgeral" );
    nossotoast("Selecione a familia de componentes");
}
function rastreados()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/rastreados.php?idpessoa="+idpessoa;
    injeta(strURL, "#inicio", "#institucional", "slide", "contrastreados" );
    nossotoast("Selecione o modelo de rastreamento");
}
function lerchip()
{
   if(document.getElementById("plataforma").value==="Android")
   {
        var chip = Android.lerchip();
   }
   else
   {
       nossotoast("Leitora de chips não disponibilizada");
       return;
   }
   if(chip.substr(0,4)==="ERRO")
   {
       nossotoast(chip.substr(4));
       return "";
   }
   nossotoast("TAG: "+chip);
   return chip;
}
function pressaomanual()
{
    var medida=document.getElementById("medida").value;
    
    var numchip=document.getElementById("idpneu").value;
    var strURL="php/grava_medida.php?sulco=0&pressao="+medida+"&chip="+numchip;
    executa(strURL);
    novoresumo("php/graph_pressao.php?numero_chip="+numchip,'veicframe');
}
function lermedidasulco(tipo)
{
    var medida = window.parent.Android.lermedida();
     
    switch(tipo)
    {
         case 0:
        {
            document.getElementById("sulco1").value=medida.substr(1);
            var numchip=document.getElementById("idpneu").value;
            var strURL="grava_medida.php?sulco=0&pressao="+medida.substr(1)+"&chip="+numchip+"medida=0";
            executa(strURL);
            novoresumo("php/graph_pressao_relogio.php?numero_chip="+numchip);
            break;
        }
        case 1:
        {
            document.getElementById("sulco1").value=medida.substr(1);
            var numchip=document.getElementById("idpneu").value;
            var strURL="grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"medida="+medida.substr(1);
            executa(strURL);
            break;
        }
         case 2:
        {
            document.getElementById("sulco2").value=medida.substr(1);
            var numchip=document.getElementById("idpneu").value;
            var strURL="grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"medida="+medida.substr(1);
            executa(strURL);
            break;
        }
         case 3:
        {
            document.getElementById("sulco3").value=medida.substr(1);
            var numchip=document.getElementById("idpneu").value;
            var strURL="grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"medida="+medida.substr(1);
            executa(strURL);
            break;
        }
         case 4:
        {
            document.getElementById("sulco4").value=medida.substr(1);
            var numchip=document.getElementById("idpneu").value;
            var strURL="grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"medida="+medida.substr(1);
            executa(strURL);
            break;
        }
        default:
        {
            document.getElementById("sulco4").value=medida.substr(1);
            var numchip=document.getElementById("idpneu").value;
            var strURL="grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"medida="+medida.substr(1);
            executa(strURL);
            break;
        }
    }
    
}
function gravamedidasulco(tipo)
{
    var idpessoa=document.getElementById("idpessoa").value;
    switch(tipo)
    {
         case 0:
        {
            var medida= document.getElementById("pressao").value;
            var numchip=document.getElementById("idpneu").value;
            
            var strURL="grava_medida.php?sulco=0&pressao="+medida+"&chip="+numchip+"&medida=0"+"&idpessoa="+idpessoa;
            executa(strURL);
            novoresumo("php/graph_pressao_relogio.php?numero_chip="+numchip);
            break;
        }
        case 1:
        {
            var medida= document.getElementById("sulco1").value;
            var numchip=document.getElementById("idpneu").value;
            var strURL="php/grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"&medida="+medida+"&idpessoa="+idpessoa;
            executa(strURL);
            break;
        }
         case 2:
        {
            var medida= document.getElementById("sulco2").value;
            var numchip=document.getElementById("idpneu").value;
            var strURL="php/grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"&medida="+medida+"&idpessoa="+idpessoa;
            executa(strURL);
            break;
        }
         case 3:
        {
            var medida= document.getElementById("sulco3").value;
            var numchip=document.getElementById("idpneu").value;
            var strURL="php/grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"&medida="+medida+"&idpessoa="+idpessoa;
            executa(strURL);
            break;
        }
         case 4:
        {
            var medida= document.getElementById("sulco4").value;
            var numchip=document.getElementById("idpneu").value;
            var strURL="php/grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"&medida="+medida+"&idpessoa="+idpessoa;
            executa(strURL);
            break;
        }
        default:
        {
            document.getElementById("sulco4").value=medida;
            var numchip=document.getElementById("idpneu").value;
            var strURL="php/grava_medida.php?sulco="+tipo+"&pressao=0&chip="+numchip+"&medida="+medida+"&idpessoa="+idpessoa;
            executa(strURL);
            break;
        }
    }
    
}
function lerchipveiculo()
{
     nossotoast("Iniciando a pesquisa, aguarde...");
    var idpessoa=document.getElementById("idpessoa").value;
    var idrastreado=1;
    var pesquisa = lerchip();
    if(pesquisa=="")
    {
        nossotoast("Informe a placa ou registro...");
        return;
    }
    var strURL="php/listaitens.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado+"&pesquisa="+pesquisa;
    injeta(strURL, "#main", "#page-wrapper", "slide", "page-wrapper" );
    limpadiv("tabmenu");
}
function pesquisaveiculo()
{
    nossotoast("Iniciando a pesquisa, aguarde...");
    var idpessoa=document.getElementById("idpessoa").value;
    var idrastreado=1;
    var pesquisa = document.getElementById("idpesquisa").value;
    if(pesquisa=="")
    {
        nossotoast("Informe a placa ou registro...");
        return;
    }
    var strURL="php/listaitens.php?idpessoa="+idpessoa+"&idrastreado="+idrastreado+"&pesquisa="+pesquisa;
    injeta(strURL, "#main", "#page-wrapper", "slide", "page-wrapper" );
    limpadiv("tabmenu");
}
function pesquisapneu()
{
    nossotoast("Iniciando a pesquisa, aguarde...");
    var idpessoa=document.getElementById("idpessoa").value;
    
    var pesquisa = document.getElementById("idpesquisapneu").value;
    if(pesquisa=="")
    {
        nossotoast("Informe o numero de série do pneu ...");
        return;
    }
    var strURL="php/detalhepneubusca.php?idpessoa="+idpessoa+"&numero_serie="+pesquisa;
    injeta(strURL, "#main", "#page-wrapper", "slide", "page-wrapper" );
    limpadiv("tabmenu");
}
function pesquisachipveiculo(idrastreado, indveiculo)
{
    nossotoast("Conectando a leitora");
    var chip = Android.lerchip();
    if(chip.substr(0,4)==="ERRO")
    {
        nossotoast(chip.substr(4));
        return "";
    }
    nossotoast("TAG: "+chip);
    if(chip!=="")
    {
        abrecomp(idrastreado,indveiculo,chip);
    }
}
function pesquisachip(idrastreado, indveiculo)
{
    nossotoast("Conectando a leitora");
    var chip = window.parent.Android.lerchip();
    if(chip.substr(0,4)==="ERRO")
    {
        nossotoast(chip.substr(4));
        return "";
    }
    nossotoast("TAG: "+chip);
    if(chip!=="")
    {
        abrecomp(idrastreado,indveiculo,chip);
    }
}
function pesquisaqrcode(idrastreado, indveiculo)
{

    nossotoast("Conectando a camera");
    var cont = document.getElementById("contqrcode");
    cont.src="./camera/index.html";
    //injeta("./camera/index.html","#qrcode",null,"slide","contqrcode");
//    var chip = window.parent.Android.lerqrcode();
     
//    injeta("https://zxing.appspot.com/scan?ret=http://americas-tech.com/index.php","#qrcode",null,"slide","contqrcode");
    $.afui.loadContent('#qrcode', null, null, "slide");
//    if(chip.substr(0,4)==="ERRO")
//    {
//        nossotoast(chip.substr(4));
//        return "";
//    }
//    nossotoast("TAG: "+chip);
//    if(tag!=="")
//    {
//        abrecomp(idrastreado,indveiculo,chip);
//    }
}
function abreqrcode(chipin)
{
    nossotoast("Conectando a camera");
    var chip = window.parent.Android.lerqrcode();
    if(chip.substr(0,4)==="ERRO")
    {
        nossotoast(chip.substr(4));
        return "";
    }
    if(chipin!=chip)
    {
        nossotoast("TAG: "+chip+ "<br> não confere com a <br>"+chipin);
    }
    else
    {
        nossotoast("TAG: "+chip);
    }
    if(tag!=="")
    {
        abrecomp(idrastreado,indveiculo,chip);
    }
}
function lerqrcode()
{
//   var chip = window.parent.Android.lerqrcode();
//   if(chip.substr(0,4)==="ERRO")
//   {
//       nossotoast(chip.substr(4));
//       return "";
//   }
   injeta("http://zxing.appspot.com/scan","#qrcode",null,"slide","contqrcode");
   nossotoast("TAG: "+chip);
   return chip;
}
function varrechip()
{
   document.getElementById("msgcomp").innerHTML="<label  width=100% class=labeltitulos>varrendo</label>";
   var qtditens=document.getElementById("qtditens").value;
   var encontrados=document.getElementById("qtdfound").value;
   if(qtditens * 1===encontrados * 1)
    {
        document.getElementById("msgcomp").innerHTML="<label  width=100% class=labeltitulos> TODOS OS ITENS ENCONTRADOS de "+qtditens+"</label>"; 
        return;
    }

    var chip = window.parent.Android.lerchip();
    for(var contaleituras=0;contaleituras<500;contaleituras++)
    {
        var tripa="entrou</br>";

        if(chip.substr(0,4)==="ERRO"||chip===null)
        {
            document.getElementById("msgcomp").innerHTML="<label width=100% class=labeltitulos>"+chip+"</label>";
            //break;
        }
        var rastreado = document.getElementById("chip").value;
        tripa=tripa+" "+rastreado+"</br> ";
        if(document.getElementById(chip))
        {
            var idcomponente=document.getElementById(chip).value;
            tripa=tripa+"idcomponente"+idcomponente+"</br> ";
            var numserie=document.getElementById(chip).name+"</br> ";  

            if(document.getElementById(numserie))
            {
                tripa=tripa+"-"+contaleituras+"-"+numserie; 
           }
            else
            {
                var strURL="php/insere_inspecao.php?$idcomponente="+idcomponente+"&chip="+
                    rastreado+"&chipcomp="+chip+"&numserie="+numserie+"&status=CHECKED";
                encontrados++;
                document.getElementById("qtdfound").value=encontrados;
                grava(strURL);
                document.getElementById(chip).value="CHECKED";
                document.getElementById(chip).scrollIntoView();
                document.getElementById(chip).class="icon checked";
                document.getElementById(chip).style.backgroundcolor="green";
                document.getElementById("msgcomp").innerHTML="<label  width=100% class=labeltitulos>"+qtditens+" - "+encontrados+"</label>"; 
                break;
            }
        }
        else
        {
            tripa=tripa+"-"+contaleituras+"-"+chip+"-"+qtditens+"-"+encontrados;
        }
        document.getElementById("msgcomp").innerHTML="<label width=100% class=labeltitulos>encontrados "+encontrados+" de "+qtditens+"</label>";
        chip = window.parent.Android.lerchip();
    }
    //document.getElementById("msgcomp").innerHTML="<label  width=100% class=labeltitulos>"+chip+"</label>";
}

function grava(strURLA)
{
    executa(strURLA);
    nossotoast("Inventário atualizado");
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

function atualiza_pneu()
{
    var chip = document.getElementById("chip").value;
    var idpneu = document.getElementById("idpneudet").value;
    if(chip==="")
    {
        chip=idpneu;
    }
    var marca = document.getElementById("marca").value;
    var idpessoa= document.getElementById("idpessoa").value;
    var modelo = document.getElementById("selmodelo").value;
    var medida = document.getElementById("medida").value;
    var numserie = document.getElementById("numserie").value;
    var vida = document.getElementById("vida").value;
    var banda = document.getElementById("banda").value;
    var valor =document.getElementById("valor").value;
    valor=valor.replace("R$ ","");
    valor=valor.replace(".","");
    valor=valor.replace(",",".");
    var idcomponente = document.getElementById("idcomponentealmox").value;
    var strURL="php/atualiza_pneu.php?marca="+marca+"&modelo="+modelo+"&idcomponente="+idcomponente+
               "&medida="+medida+"&numero_serie="+numserie+"&vida="+vida+"&idpneu="+idpneu+
               "&banda="+banda+"&chip="+chip+"&idpessoa="+idpessoa+"&valor="+valor;
    executa(strURL);
}
function novopneu()
{
    var chip = document.getElementById("chip").value;
    var marca = document.getElementById("marca").value;
    var idpessoa= document.getElementById("idpessoa").value;
    var modelo = document.getElementById("selmodelo").value;
    var medida = document.getElementById("medida").value;
    var numserie = document.getElementById("numserie").value;
    var vida = document.getElementById("vida").value;
    var banda = document.getElementById("banda").value;
    var strURL="php/incluir_pneu.php?marca="+marca+"&modelo="+modelo+
               "&medida="+medida+"&numero_serie="+numserie+"&vida="+vida+
               "&banda="+banda+"&chip="+chip+"&idpessoa="+idpessoa;
    executa(strURL);
}
function sucata()
{
    var chip = document.getElementById("chip").value;
    var idpessoa= document.getElementById("idpessoa").value;

    var strURL="php/baixa_componente.php?chip="+chip+"&idcomponente=2"+"&idpessoa="+idpessoa;
    var req = getXMLHTTP();
    var resposta;
    executa(strURL);
}
function lerchipcomponente()
{
   var chip = window.parent.Android.lerchip();
   document.getElementById("chipcomponente").value=chip;
}
function nossotoast(mensagem)
{
    var opts={
        message: mensagem,
        position:"tc",
        delay:2000,
        autoClose:true,
        type:"error"
    };
    document.getElementById("containermsg").innerHTML='<div class="alert-rule" id="message">'+mensagem+'</div>';
    $(window).load(function() {
        $('.alert-rule').addClass('animated');
      });
    //window.parent.Android.ShowToast(opts);
}
function resulttoast(mensagem)
{
    var opts={
        message: mensagem,
        position:"tc",
        delay:2000,
        autoClose:true,
        type:"error"
    };
    document.getElementById("containermsg").innerHTML='<div class="alert-rule" id="message">'+mensagem+'</div>';
    $(window).load(function() {
        $('.alert-rule').addClass('animated');
      });
    //window.parent.Android.ShowToast(opts);
}

function makeTable ( txt /*your rav csv string*/ ) {
    var tds = null;
    var rows = txt.split('\n');
    var saida = '<table class=container>';
    saida=saida+"<th>registro</th>";
    saida=saida+"<th>placa</th>";
    saida=saida+"<th>Marca</th>";
    saida=saida+"<th>Modelo</th>";
    saida=saida+"<th>Ano</th>";
    saida=saida+"<th>Cor</th>";
    saida=saida+"<th>Ano do modelo</th>";
    saida=saida+"<th>KM atual</th>";
    saida=saida+"<th>Eixos</th>";
    saida=saida+"<th>Resultado</th>";
    for ( var i = 0; i<rows.length; i++ ) {
        saida=saida+'<tr>';
        tds = rows[i].split(';');
        var registro=tds[0];
        var placa=tds[1];
        var Marca=tds[2];
        var Modelo=tds[3];
        var Ano=tds[4];
        var Cor=tds[5];
        var anomodelo=tds[6];
        var KM=tds[7];
        var eixos=tds[8];
        saida=saida+'<td>';
        saida=saida+registro;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+placa;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Marca;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Modelo;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Ano;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Cor;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+anomodelo;
        saida=saida+'</td>';
        saida=saida+'<td>';
        saida=saida+KM;
        saida=saida+'</td>'
        saida=saida+eixos;
        saida=saida+'</td>';
        nossotoast("Checando "+registro+"...aguarde");
        var idpessoa=document.getElementById("idpessoa").value;
        var completo=false;
        var strURL="php/importacao_veiculo.php?chip="+registro  
                    +"&idveiculo="+registro
                    +"&idpessoa="+idpessoa
                    +"&placa="+placa 
                    +"&marca="+Marca
                    +"&modelo="+Modelo
                    +"&anomodelo="+anomodelo
                    +"&ano="+Ano
                    +"&cor="+Cor
                    +"&registro="+registro
                    +"&novochip ="+registro
                    +"&kmveiculo ="+KM
                    +"&eixos ="+eixos
                    +"&operacao='novo'";
        var req = new XMLHttpRequest();
        req.open('POST', strURL, false);  // `false` makes the request synchronous
        req.send(null);

        if (req.status === 200) {
            var resposta=JSON.parse(req.responseText);
            var mensagem = resposta.message;
//            document.getElementById("list").innerHTML += "<br>"+registro+" "+mensagem;
            saida=saida+'<td>';
            saida=saida+mensagem;
            saida=saida+'</td>';
            saida=saida+'</tr>';
             
        }
        else
        {
            nossotoast("Problemas na Internet");
        }
        
//        
//        
//        var req = getXMLHTTP();
//        if (req){   
//        req.onreadystatechange = function(){  
//            var mensagem="";
//            if (req.readyState === 4)
//                if(req.status === 200){
//                    var resposta=JSON.parse(req.responseText);
//                    mensagem = resposta.message;
//                    nossotoast(mensagem);
//                   
//                    completo=true;
//                }else{
//                    nossotoast("Problemas na Internet");
//                    return "Problemas na Internet";
//                }
//                
//            }
//        };
//        req.open("POST", strURL, false);
//        req.send();
        
        
    }
    saida=saida+'</table>';

    var el = document.getElementById('tabela');
    el.innerHTML = saida;

}