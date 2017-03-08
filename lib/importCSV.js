
function importaCSV( ) {
    var file = document.getElementById('file');
//    file.addEventListener('change', function() 
//    {
        var reader = new FileReader();
        var f = file.files[0];
        reader.onload = function(e) 
        {
            makeTable(e.target.result); //this is where the csv array will be
        };
        reader.readAsText(f);
//    });

}

/**
 * display content using a basic HTML replacement
 */
function displayContents(txt) {
    var el = document.getElementById('main');
    el.innerHTML = txt; //display output in DOM
}
function makePneu ( txt /*your rav csv string*/ ) {
    var tds = null;
    var rows = txt.split('\n');
    var saida = '<table class=container>';
    saida=saida+"<th>registro</th>";
    saida=saida+"<th>Marca de fogo</th>";
    saida=saida+"<th>Medida</th>";
    saida=saida+"<th>Fabricante</th>";
    saida=saida+"<th>Modelo</th>";
    saida=saida+"<th>Vida</th>";
    saida=saida+"<th>Banda</th>";
    saida=saida+"<th>Eixo</th>";
    saida=saida+"<th>Roda</th>";
    for ( var i = 0; i<rows.length; i++ ) {
        saida=saida+'<tr>';
        tds = rows[i].split(';');
        var registro=tds[0];
        var Marca=tds[1];
        var Medida=tds[2];
        var Fabricante=tds[3];
        var Modelo=tds[4];
        var Vida=tds[5];
        var Banda=tds[6];
        var Eixo=tds[7];
        var Roda=tds[8];
        saida=saida+'<td>';
        saida=saida+registro;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Marca;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Medida;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Fabricante;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Modelo;
        saida=saida+'</td>';
        saida=saida+'<td>';
        saida=saida+Vida;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Banda;
        saida=saida+'</td>'; 
        saida=saida+'<td>';
        saida=saida+Eixo;
        saida=saida+'</td>';
        saida=saida+'<td>';
        saida=saida+Roda;
        saida=saida+'</td>';
        nossotoast("Checando "+registro+"...aguarde");
        var idpessoa=document.getElementById("idpessoa").value;
         
        var strURL="php/importacao_veiculo.php?chip="+registro  
                    +"&idveiculo="+registro
                    +"&idpessoa="+idpessoa
                    +"&numero_serie="+Marca
                    +"&medida="+Medida
                    +"&modelo="+Modelo
                    +"&marca="+Fabricante
                    +"&vida="+Vida
                    +"&Banda="+Banda
                    +"&Eixo="+Eixo
                    +"&Roda ="+Roda;
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
function exportatable(filename)
{
    var idpessoa=document.getElementById("idpessoa").value;
    var outputFile = filename || 'export';
    outputFile = outputFile.replace('.csv','') + '.csv';
    var strURL="";
    switch(filename)
    {
        case "veiculo":
        {
            strURL="php/exporta_veiculo.php?idpessoa="+idpessoa;
            break;
        }
        case "pneu":
        {
            strURL="php/exporta_pneus.php?idpessoa="+idpessoa;
            break;
        } 
        case "veiculo":
        {
            strURL="php/exporta_veiculo.php?idpessoa="+idpessoa;
            break;
        }
        case "medidas":
        {
            strURL="php/exporta_pneus_sulcos.php?idpessoa="+idpessoa;
            break;
        } 
    }
    
    var req = new XMLHttpRequest();
    req.open('POST', strURL, false);  // `false` makes the request synchronous
    req.send(null);

    if (req.status === 200) {
        var a = document.createElement("a");
        var file = new Blob(req.responseText.split("##"), {type: 'text/plain;charset=utf-8;'});
        a.href = window.URL.createObjectURL(file);
        a.download = outputFile;
        a.click();
         
    }
}
       
