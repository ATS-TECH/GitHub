function mostraempresa(idpessoa)
{
    var strURL="php/empresa.php?idpessoa="+idpessoa;
    novoresumo(strURL, "empresa" );                    
}
function injeta(strURL, ida, param, animacao, container )
{
    nossotoast("Carregando a página...aguarde");
//    $(container).load('url/'+strURL);
//    document.getElementById(container).scrollIntoView();
    if(document.getElementById(container)!==null)
    {
        document.getElementById(container).style.width=0;
    }
    var req = getXMLHTTP();
    if (req){   
    req.onreadystatechange = function(){   
        if (req.readyState === 4)
            if(req.status === 200){
                navegacao(ida,param);
                document.getElementById(container).innerHTML=req.responseText;
                document.getElementById(container).scrollIntoView();
                document.getElementById(container).style.width='100%';
                
            }else{
                nossotoast("Problemas na Internet, contate imediatamente o suporte ATS");
            }}
    };
    req.open("GET", strURL, false);
    req.send(); 
}
function executa(strURL )
{
    nossotoast("Executando...aguarde");
    var req = getXMLHTTP();
    if (req){   
    req.onreadystatechange = function(){   
        if (req.readyState === 4)
            if(req.status === 200){
                var resposta=JSON.parse(req.responseText);
                var mensagem = resposta.message;
                nossotoast(mensagem);
            }else{
                nossotoast("Problemas na Internet");
                return "Problemas na Internet";
            }}
    };
    req.open("POST", strURL, false);
    req.send(); 
}
function abreveiculo(numero_chip)
{
    detalhesmenu(numero_chip,"1",'S');
}
function abrepneu(numero_chip, chip_pneu)
{
    abreveiculo(numero_chip);
    novoresumo('php/menu_pneu.php?numero_chip='+ chip_pneu,'menu');
}
function abrepneualmox(numero_chip)
{
    mostracompalmox(numero_chip);
}
function planos()
{
    nossotoast("Carregando a página...aguarde");
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/planos.php?idpessoa="+idpessoa;
    limpadiv("page-wrapper");
    limpadiv("tabmenu");
    injeta(strURL, "#contgeral", "#contgeral", "spin", "contgeral" );
}
function insereplano()
{
    nossotoast("Carregando a página...aguarde");
    var idusuario= document.getElementById("idusuario").value;
    var nomeplano=document.getElementById("nomeplano").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var manda=document.getElementById("mandat").value;
    var strURL="php/incluir_planos.php?idpessoa="+idpessoa+"&nomeplano="+nomeplano+"&idusuario="+idusuario+"&manda="+manda;
    executa(strURL);
    var strURL="php/planos.php?idpessoa="+idpessoa;
    limpadiv("page-wrapper");
    limpadiv("tabmenu");
    injeta(strURL, "#contgeral", "#contgeral", "spin", "contgeral" );
}
function abreplano(idplano)
{
    nossotoast("Carregando a página...aguarde");
    document.getElementById("idplano").value=idplano;
    var idusuario= document.getElementById("idusuario").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/itens_manutencao.php?idpessoa="+idpessoa+"&idplano="+idplano+"&idusuario="+idusuario;
    limpadiv("page-wrapper");
    limpadiv("tabmenu");
    injeta(strURL, "#page-wrapper", "#page-wrapper", "spin", "page-wrapper" );
}
function mudamanda()
{
    var mandacheck = document.getElementById("mandat");
    if(mandacheck.checked)
    {
        mandacheck.value="S";
    }
    else
    {
        mandacheck.value="N";
    }
    
    var idplano=document.getElementById("idplano").value;
    alteraplano(idplano);
}
function incluiitem()
{
    var idusuario= document.getElementById("idusuario").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var idplano=document.getElementById("idplano").value;
    var todokm = document.getElementById("todokm0").value;
    var tododia = document.getElementById("tododia0").value;
    var limitekm = document.getElementById("limitekm0").value;
    var alertakm=document.getElementById("alertakm0").value;
    var limitedia=document.getElementById("limitedia0").value;
    var alertadia=document.getElementById("alertadia0").value;
    var valor_item=document.getElementById("valor0").value;
    var nomeitem=document.getElementById("nomeitem0").value;
    
    var strURL="php/Incluir_item_manu.php?idpessoa="+idpessoa
                +"&idusuario="+idusuario
                +"&idplano="+idplano
                +"&valor_item="+valor_item
                +"&nomeitem="+nomeitem
                +"&todokm="+todokm
                +"&tododia="+tododia
                +"&limitekm="+limitekm
                +"&alertakm="+alertakm
                +"&limitedia="+limitedia
                +"&alertadia="+alertadia;
    executa(strURL);
    abreplano(idplano);
}
function excluiitem(item)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idplano=document.getElementById("idplano").value;
    
    var strURL="php/Excluir_item_manu.php?idpessoa="+idpessoa+"&item="+item+"&idplano="+idplano;
    executa(strURL);
    abreplano(idplano);
}
function alteraplano(idplano)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var nomeplano=document.getElementById("nomeplano").value;
    var manda=document.getElementById("mandat").value;
    var strURL="php/atuaplano.php?idpessoa="+idpessoa+"&nomeplano="+nomeplano+"&idplano="+idplano+"&manda="+manda;
    executa(strURL);
    abreplano(idplano);
}
function dissociaplano(idplano)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idveiculo=document.getElementById("idveiculo").value;
    var strURL="php/dissociaplano.php?idpessoa="+idpessoa+"&idplano="+idplano+"&idveiculo="+idveiculo;
    executa(strURL);
    strURL="php/planos_veiculo.php?idpessoa="+idpessoa+"&chip_veiculo="+idveiculo;
    novoresumo(strURL,"menu");
}
function atuaitem(item)
{
    var idusuario= document.getElementById("idusuario").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var idplano=document.getElementById("idplano").value;
    var todokm = document.getElementById("todokm"+item).value;
    var tododia = document.getElementById("tododia"+item).value;
    var limitekm = document.getElementById("limitekm"+item).value;
    var alertakm=document.getElementById("alertakm"+item).value;
    var limitedia=document.getElementById("limitedia"+item).value;
    var alertadia=document.getElementById("alertadia"+item).value;
    var valor_item=document.getElementById("valor"+item).value;
    var nomeitem=document.getElementById("nomeitem"+item).value;
    
    var strURL="php/atua_item_manu.php?idpessoa="+idpessoa
                +"&idusuario="+idusuario
                +"&idplano="+idplano
                +"&valor_item="+valor_item
                +"&nomeitem="+nomeitem
                +"&todokm="+todokm
                +"&tododia="+tododia
                +"&limitekm="+limitekm
                +"&alertakm="+alertakm
                +"&limitedia="+limitedia
                +"&alertadia="+alertadia
                +"&iditem="+item;
    executa(strURL);
    limpadiv("cmd"+item);
}
function delitem(item)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idplano=document.getElementById("idplano").value;
    var strURL="php/Excluir_item_manu.php?idpessoa="+idpessoa
                +"&idplano="+idplano
                +"&iditem="+item;
    executa(strURL);
    abreplano(idplano);
}
function ativaitem(item)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idplano=document.getElementById("idplano").value;
    var strURL="php/Ativar_item_manu.php?idpessoa="+idpessoa
                +"&idplano="+idplano
                +"&iditem="+item;
    executa(strURL);
    abreplano(idplano);
}
function cmdatua(item)
{
    document.getElementById("cmd"+item).innerHTML='<div class=btn onclick="atuaitem('+item+')"><i class="fa fa-save" \n\
 style="padding:2px;cursor:pointer;"></i>Salvar</div>';
}
function selitem(item)
{
    document.getElementById("cmd"+item).innerHTML='<div class=btn onclick="delitem('+item+')"><i class="fa fa-trash" \n\
 style="padding:2px;"></i>Excluir</div>';
}
function selmanu(item)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idplano=document.getElementById("idplano").value;
    var idveiculo=document.getElementById("idveiculo").value;
    var strURL="php/exec_manu.php?idpessoa="+idpessoa
            +"&idplano="+idplano
            +"&idveiculo="+idveiculo
            +"&iditem="+item;
    injeta(strURL,"execmanu","execmanu","slide","execmanu");
    document.getElementById("execmanu").class="execmanu";
    document.getElementById("execmanu").style.width="400px";
    document.getElementById("execmanu").style.marginLeft="2rem";
    document.getElementById("execmanu").style.zIndex=1;
}
function inclui_item(item)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idusuario=document.getElementById("idusuario").value;
    var idplano=document.getElementById("idplano").value;
    var idveiculo=document.getElementById("idveiculo").value;
    var ressalva=document.getElementById("ress"+item).value;
    var kmveiculo=document.getElementById("kmveiculo").value;
    var valor=document.getElementById("valor").value;
    if(valor=='')valor=0;
    var strURL="php/inclui_item.php?idpessoa="+idpessoa
                +"&idplano="+idplano
                +"&idveiculo="+idveiculo
                +"&idusuario="+idusuario
                +"&ressalva="+ressalva
                +"&kmveiculo="+kmveiculo
                +"&valor="+valor
                +"&iditem="+item;
    executa(strURL);
    manutencao(idplano);
}
function checkkm(item)
{
    var todokm=document.getElementById("todokm"+item);
    if(todokm.checked)
    {
        document.getElementById("limitekm"+item).disabled=false;
        document.getElementById("alertakm"+item).disabled=false;
        todokm.value="S";
    }
    else
    {
        document.getElementById("limitekm"+item).disabled=true;
        document.getElementById("limitekm"+item).value=0;
        document.getElementById("alertakm"+item).disabled=true;
        document.getElementById("alertakm"+item).value=0;
        todokm.value="N";
    }
    var tododia=document.getElementById("tododia"+item);
    if(tododia.checked)
    {
        document.getElementById("limitedia"+item).disabled=false;
        document.getElementById("alertadia"+item).disabled=false;
        tododia.value="S";
    }
    else
    {
        document.getElementById("limitedia"+item).disabled=true;
        document.getElementById("limitedia"+item).value=0;
        document.getElementById("alertadia"+item).disabled=true;
        document.getElementById("alertadia"+item).value=0;
        tododia.value="N";
    }
}
function menuresumo(item, param)
{
    nossotoast("Carregando a página...aguarde");
    if(param==="veiculo"||param==="areahist")
    {
        limpadiv("contgeral");
        document.getElementById("strurl").value=item;
        var strURL="php/menu_resumos.php";
        injeta(strURL, "tabmenu", "menu", "slide", "tabmenu" );
    }
    else
    {
       
        document.getElementById("strurl").value=item;
        var strURL="php/menu_resumos.php";
        injeta(strURL, "tabhist", "menu", "slide", "tabhist" );
    }
    var result = new Date();
    var antes = new Date(result.getTime() - (7 * 24 * 60 * 60 * 1000));
    var day = antes.getDate();
    var monthIndex = (antes.getMonth()*1)+1;
    var year = antes.getFullYear();
    var entrega="";
    if(monthIndex<10)
    {
        entrega=year+"-"+"0"+monthIndex+"-"+day;
    }
    else
    {
        entrega=year+"-"+monthIndex+"-"+day;
    }
    document.getElementById("dataini").value = entrega;
     
    var day = result.getDate();
    var monthIndex = (result.getMonth()*1)+1;
    var year = result.getFullYear();
    if(monthIndex<10)
    {
        entrega=year+"-"+"0"+monthIndex+"-"+day;
    }
    else
    {
        year+"-"+monthIndex+"-"+day;
    }
    
    document.getElementById("datafim").value = entrega;
    var idpessoa=document.getElementById("idpessoa").value;
    
    
    var strURL=item+"&idpessoa="+idpessoa;
    if(document.getElementById("dataini")!==null)
    {
        var datafim=document.getElementById("datafim").value;
        var dataini=document.getElementById("dataini").value;
        strURL +="&dataini="+dataini+"&datafim="+datafim
    }
    
    novoresumo(strURL, param );
}

function novoresumo(item, param)
{
    nossotoast("Carregando a página...aguarde");
    var idpessoa=document.getElementById("idpessoa").value;
    var plataforma=document.getElementById("plataforma").value;
    item=item+"&plataforma="+plataforma+"&idpessoa="+idpessoa;
    var strURL=item;
    document.getElementById("strurl").value=item;
    if(param==="iframe"||param==="veicframe"||param==="pneuframe"||param==="chartmov")
    {
        if(param==="chartmov")
        {
            document.getElementById("contgeral").innerHTML='<iframe class=graph style="width:100%;min-height:280px;" id="tabmestra" name="tabmestra"  scrolling="auto"></iframe> ';
            $("iframe[name=tabmestra]").attr('src', strURL);
            closeNav();
        }
        else
        {
            document.getElementById("page-wrapper").innerHTML='<iframe class=graph style="width:100%;min-height:600px;" id="tabmestra" name="tabmestra"  scrolling="auto"></iframe> ';
            $("iframe[name=tabmestra]").attr('src', strURL);
            closeNav();
        }
    }
    else
    {
        if(param==="menu")
        {
            injeta(strURL, "tabmenu", param, "slide", "tabmenu" );
            closeNav();
        }
        else
        {
            if(param==="areahist")
            {
                injeta(strURL, "areahist", param, "slide", "areahist" );
                closeNav();
            }
            else
            {
                injeta(strURL, "page-wrapper", param, "slide", "page-wrapper" );
                closeNav();
            }
        }
    }
    
}
function reloadresumo( )
{
    var item=document.getElementById("strurl").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var plataforma=document.getElementById("plataforma").value;
    var dataini=document.getElementById("dataini").value;
    var datafim=document.getElementById("datafim").value;
    item=item+"&plataforma="+plataforma+"&dataini="+dataini+"&datafim="+datafim;
    document.getElementById("strurl").value=item;
    novoresumo(item,'areahist');
    
}
function novograph(strURL)
{
    $("iframe[name=tabmestra]").attr('src', strURL);
    $.afui.loadContent("#google", null, null, "spin");
}
function atualizaemp()
{
    var razao=document.getElementById("nomeemp").value;
    var cnpj=document.getElementById("cnpj").value;
    var email=document.getElementById("email").value;
    var telefone=document.getElementById("telefone").value;
    var strURL="php/atualizaempresa.php?idpessoa="+document.getElementById("idpessoa").value+"&razao_social="+razao+"&cnpj="+cnpj+"&email="+email+"&telefone="+telefone;    
    document.getElementById("mensagememp").innerHTML = executa(strURL);
}
function novaemp()
{
    var strURL="php/novaempresa.php";
    injeta(strURL, "novaemp", "#contgeral", "spin", "contgeral" );
}
function outrousu(idusuariot)
{
    var idusuario=document.getElementById("idusuario").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var strURL="php/usuario.php?idpessoa="+idpessoa+"&idusuario="+idusuario+"&idusuariot="+idusuariot;
    injeta(strURL, "page-wrapper", "page-wrapper", "slide", "page-wrapper" );
}
function montausu()
{
    var idpessoa=document.getElementById("idpessoa").value;
    var idusuario=document.getElementById("idusuario").value;
    var strURL="php/usuario.php?idpessoa="+idpessoa+"&idusuario="+idusuario;
    novoresumo(strURL, "usuario" );
}
function criaemp()
{
    // SIGNIN SERVER CALL CODE GOES HERE
    var razao=document.getElementById("nomeemp").value;
    var cnpj=document.getElementById("cnpj").value;
    var email=document.getElementById("email").value;
    var telefone=document.getElementById("telefone").value;
    
    if(razao==='')
    {
        nossotoast("Informe o nome da empresa");
        return; 
    }
    if(email==='')
    {
        nossotoast("Informe o email da empresa");
        return;
    }
    if(cnpj==='')
    {
        nossotoast("Informe o CNPF da empresa");
        return;
    }
     if(telefone==='')
    {
        nossotoast("Informe o telefone da empresa");
        return;
    }
    var strURL="php/novapessoa.php?razao_social="+razao+"&cnpj="+cnpj+"&email="+email+"&telefone="+telefone;

    nossotoast("Executando...aguarde");
    var req = getXMLHTTP();
    if (req){   
    req.onreadystatechange = function(){   
        if (req.readyState === 4)
            if(req.status === 200){
                var resposta=JSON.parse(req.responseText);
                var mensagem = resposta.message;
                var success = resposta.success;

                if(success>0)
                {
                    var idpessoa= resposta.idpessoa;
                    nossotoast(mensagem);
                    document.getElementById("idpessoa").value=idpessoa;
                    var razao=document.getElementById("razao_social").value;
                    document.getElementById("empusuario").value=razao
                    injeta("php/novousuario.php","novaemp", null, "slide","contgeral");
                }
                else{
                nossotoast(mensagem);
                return "Problemas na Internet";
                }
            }else{
                nossotoast("Problemas na Internet");
                return "Problemas na Internet";
            }}
        };
    req.open("POST", strURL, false);
    req.send();
    
}
function checkauto(id)
{
    var gestor=document.getElementById("gestor");
    var admveiculo=document.getElementById("veiculo");
    var admalmox=document.getElementById("almox");
    var admusuario=document.getElementById("usu");
    var portaria=document.getElementById("portaria");
    var rastro=document.getElementById("rastro");

    switch(id)
    {
        case 0:
            if(gestor.value==="S")
            {
                gestor.value="N";
                gestor.checked=false;
            }
            else{
                gestor.checked=true;
                gestor.value="S";
            }
            
            break;
        case 1:   
            if(admveiculo.value==="S"){
                admveiculo.value="N";
                admveiculo.checked=false;
            }else{
                admveiculo.value="S";
                admveiculo.checked=true;}
            break;
            
        case 2:   
            if(admalmox.value==="S"){admalmox.value="N";admalmox.checked=false;}
            else{admalmox.value="S";admalmox.checked=true}
            
            break;
        case 3:   
            if(admusuario.value==="S"){admusuario.value="N";admusuario.checked=false}
            else{admusuario.value="S";admusuario.checked=true}
            
            break;
        case 4:   
            if(portaria.value==="S"){portaria.value="N";portaria.checked=false}
            else{portaria.value="S";portaria.checked=true}
            
            break;
        case 5:   
            if(rastro.value==="S"){rastro.value="N";rastro.checked=false}
            else{rastro.value="S";rastro.checked=true}
            
            break;
                   
    }
}
function atualizausuario()
{
    var gestor=document.getElementById("gestor").value;
    var admveiculo=document.getElementById("veiculo").value;
    var admalmox=document.getElementById("almox").value;
    var admusuario=document.getElementById("usu").value;
    var admrastreado=document.getElementById("rastro").value;;
    var idpessoa=document.getElementById("idpessoa").value;
    var nomeusuario=document.getElementById("nameusu").value;
    var usuario=document.getElementById("username").value;
    var senha=document.getElementById("passwordusu").value;
    var senha2=document.getElementById("confirmpassword").value;
    var email=document.getElementById("email").value;
    var admportaria=document.getElementById("portaria").value;
    var telefone=document.getElementById("telefone").value;
    var idusuariot=document.getElementById("idusuariot").value;
    var strURL="php/atualiza_usuario.php?idpessoa="+idpessoa
                        +"&usuario="+usuario
                        +"&senha="+senha
                        +"&email="+email
                        +"&idusuariot="+idusuariot
                        +"&gestor="+gestor
                        +"&admveiculo="+admveiculo
                        +"&admalmox="+admalmox
                        +"&admusuario="+admusuario
                        +"&admrastreado="+admrastreado
                        +"&admportaria="+admportaria
                        +"&telefone="+telefone
                        +"&nomeusuario="+nomeusuario;

    //example client side validation
    if (senha === senha2)
    {
        executa(strURL);
    }
    else{
        //Example use of the error toast
        nossotoast("Senhas não são iguais");}
}
function signUp(){
    var gestor=document.getElementById("gestor").value;
    var admveiculo=document.getElementById("admveiculo").value;
    var admalmox=document.getElementById("admalmox").value;
    var admusuario=document.getElementById("admusuario").value;
    var admrastreado=document.getElementById("admrastreado").value;
    var idpessoa=document.getElementById("idpessoa").value;
    var nomeusuario=document.getElementById("nameusu").value;
    var usuario=document.getElementById("username").value;
    var senha=document.getElementById("passwordusu").value;
    var senha2=document.getElementById("confirmpassword").value;
    var email=document.getElementById("email").value;
    var strURL="php/insere_usuario.php?idpessoa="+idpessoa
                        +"&usuario="+usuario
                        +"&senha="+senha
                        +"&email="+email
                        +"&gestor="+gestor
                        +"&admveiculo="+admveiculo
                        +"&admalmox="+admalmox
                        +"&admusuario="+admusuario
                        +"&admrastreado="+admrastreado
                        +"&nomeusuario="+nomeusuario;
    if(usuario==='')
    {
        nossotoast("Informe o nome de usuário");
        return;
    }
    if(senha==='')
    {
        nossotoast("Informe a senha");
        return;
    }
    if(email==='')
    {
        nossotoast("Informe o e-mail");
        return;
    }
    //example client side validation
    if (senha !== senha2)
    {
        nossotoast("Senhas diferentes, corrija");
    }
    var req = getXMLHTTP();
    if (req){   
    req.onreadystatechange = function(){   
        if (req.readyState === 4)
            if(req.status === 200){
                var resposta=JSON.parse(req.responseText);
                var mensagem = resposta.message;
                var success = resposta.success;
                if(success>0)
                {
                    var idpessoa= resposta.idpessoa;
                    document.getElementById("idpessoa").value=idpessoa;

                    var nameusu=document.getElementById("nameusu").value;
                    var razao=document.getElementById("razao_social").value;
                    window.location.reload();
                    }
                    else
                    {
                        nossotoast(mensagem);
                    }
                 
            }else{
                nossotoast("Problemas na Internet");
                return "Problemas na Internet";
            }
        };
    req.open("POST", strURL, false);
    req.send();
    }
}
function incluicomponente()
{
    var chip = document.getElementById("chipcomponente").value;
    if(chip==='')
    {
        nossotoast("Gere o TAG para habilitar gravar");
        chip=document.getElementById("numserie").value;
    }
    var numserie = document.getElementById("numserie").value;
    var idpessoa = document.getElementById("idpessoa").value; 
    var idcomponente = document.getElementById("idcomponente").value;
    var valor = document.getElementById("valor").value;
    var strURL="php/Incluir_componente.php?numero_serie="+numserie
            +"&numero_chip="+chip
            +"&idcomponente="+idcomponente
            +"&idpessoa="+idpessoa
            +"&valor="+valor;
    executa(strURL);
    listacomponenentes(idcomponente);
}
function novocomp()
{
    var idpessoa = document.getElementById("idpessoa").value; 
    var idcomponente = document.getElementById("selectcomp").value;
    if(idcomponente==="#")
    {
        nossotoast("Selecione a família de componentes");
        return;
    }
    var strURL="php/selecionainclusao.php?idcomponente="+idcomponente+"&idpessoa="+idpessoa;
    injeta(strURL, "#almox", "#institucional", "spin", "treearea" );
}
function getitemcompo()
{
    
    var idpessoa = document.getElementById("idpessoa").value; 
    var idcomponente = document.getElementById("selectcomp").value;
    var valores = idcomponente.split("#");
    if(valores[0]===null)
    {
        nossotoast("Selecione o componentes");
        return;
    }
    var numero_chip = valores[1];
     
    var strURL="php/selecionacomponente.php?idcomponente="
            +valores[0]+"&idpessoa="
            +idpessoa+"&numero_chip="
            +numero_chip;
    injeta(strURL, "#almox", "#almox", "spin", "treearea" );
}
function atualizacomponente()
{
    var idcomponente = window.document.getElementById("idcomponente").value;
    var idpessoa = window.document.getElementById("idpessoa").value;
    var numserie = window.document.getElementById("numserie").value;
    var chip = window.document.getElementById("chipsalva").value;
    var strURL="php/atualiza_componente.php?numero_serie="+numserie+"&chip="+chip+"&idcomponente="+idcomponente+"&idpessoa="+idpessoa;
    executa(strURL);
}
function falhaspneualmox( )
{
    var chip= document.getElementById("idpneu").value;
    var idfalha=document.getElementById("selfalhas").value;
    var idpessoa = document.getElementById("idpessoa").value;
    var strURL= "php/Incluir_falha.php?idfalha="+idfalha+"&chip="+chip+"&idpessoa="+idpessoa;
    executa(strURL);
    mostracompalmox(chip);
}
function excluifalhaalmox(idfalha, dataregistro )
{
    var chip= document.getElementById("idpneu").value;
    
    var idpessoa = document.getElementById("idpessoa").value;
    var strURL= "php/Excluir_falha.php?idfalha="+idfalha+"&chip="+chip+"&idpessoa="+idpessoa+"&dataregistro="+dataregistro;
    executa(strURL);
    mostracompalmox(chip);
}

function falhaspneu(idfalha )
{
    var chip= document.getElementById("idpneu").value;
    
    var idpessoa = document.getElementById("idpessoa").value;
    var strURL= "php/Incluir_falha.php?idfalha="+idfalha+"&chip="+chip+"&idpessoa="+idpessoa;
    executa(strURL);
    novoresumo('php/resumo_pneu_falhas.php?numero_chip='+chip,'pneu');
}
function excluifalha(idfalha, dataregistro )
{
    var chip= document.getElementById("idpneu").value;
    
    var idpessoa = document.getElementById("idpessoa").value;
    var strURL= "php/Excluir_falha.php?idfalha="+idfalha+"&chip="+chip+"&idpessoa="+idpessoa+"&dataregistro="+dataregistro;
    executa(strURL);
    novoresumo('php/resumo_pneu_falhas.php?numero_chip='+chip,'pneu');
}
function excluieixos(eixo)
{
    var idpessoa = document.getElementById("idpessoa").value;
     var idveiculo = window.document.getElementById("idveiculo").value;
    var strURL="php/excluieixos.php?idveiculo="+idveiculo+"&indeixo="+eixo+"&idpessoa="+idpessoa;
    executa(strURL);
    novoresumo('php/plantapneus.php?idpessoa='+idpessoa+'&numero_chip='+idveiculo+'&idrastreado=0','veiculo');
}
function mainNav() {
    if(document.getElementById("myNavbar").style.width == "100%")
    {
        document.getElementById("myNavbar").style.width = "0";
        document.getElementById("myNavbar").style.zIndex = "-1";
        document.getElementById("restocont").style.width = "100%";
        document.getElementById("restocont").style.marginTop = "0px";
        document.getElementById("restocont").style.width="100%";
        document.getElementById("restocont").style.left = "0";
    }
    else
    {
        document.getElementById("myNavbar").style.width = "100%";
        document.getElementById("myNavbar").style.zIndex = "10";
        document.getElementById("myNavbar").style.left = "0";
        document.getElementById("restocont").style.marginTop="80px";
    }
}

/* Set the width of the side navigation to 0 */
function closeNav() {
        document.getElementById("myNavbar").style.width = "0";
        document.getElementById("myNavbar").style.zIndex = "-1";
        document.getElementById("restocont").style.marginTop = "0";
        document.getElementById("restocont").style.marginLeft = "0";
     
}
function navegacao(ida, param)
{
    if(ida==="execmanu"
        &&ida==="seltarea"
        &&ida==="selmarea"
        &&ida==="#main"
        &&ida==="novaemp"
        &&ida==="planta"
        &&ida==="termos"
        &&ida==="areamonta"
        &&ida==="selxarea")
    return;
    switch(param)
    {
        case "veiculo":
        {
            break;
        }
        case "veicframe":
        {
            limpadiv("contgeral");
            
            break;
        }
        case "pneuframe":
        {
            break;
        }
        case "desmonta":
        {
            limpadiv("tabmenu");
            limpadiv("page_wrapper");
            break;
        }
        case "pneu":
        {
            break;
        }
        case "menu":
        {
            break;
        }
        case "planta":
        {
            limpadiv("tabmenu");
            limpadiv("page-wrapper");
            break;
        }
        case "chartmov":
        {
            limpadiv("tabmenu");
            limpadiv("page-wrapper");
            break;
        }
        case "pesqpneu":
        {
            limpadiv("tabmenu");
            limpadiv("page-wrapper");
            break;
        }
        case "areahist":
        {
            limpadiv("page-wrapper");
            break;
        }
        case "almox":
        {
            limpadiv("contgeral");
            limpadiv("tabmenu");
            break;
        }
    }
    if(document.getElementById("myNavbar")!==null)
    {
        closeNav();
    }
}