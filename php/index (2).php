<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="./images/favicon_americas.ico" type="image/x-icon">
<link rel="icon" href="./images/favicon_americas.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width">
<title>TRUCK ID</title>
<link href="css_entrada.css" rel="stylesheet" type="text/css">
<script>
     
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

    function testa()
    {
        window.document.location.reload("http://www.frotasaas.com.br/frotaweb/apweb/telas/tl10320.aspx");

    }
    function abre()
    {
            //var strURL="http://www.frotasaas.com.br/frotaweb/apweb/telas/tl10320.aspx";
            var strURL="index.html";
            var req = getXMLHTTP();

            var resposta;
            if (req)
            {
                req.onreadystatechange = function()
                {   if (req.readyState === 4) 
                    {
                        if (req.status === 200) 
                        {						
                            document.getElementById('tabprime').innerHTML=req.responseText;
                            var gubwin = document.getElementById('Android');
                             
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
    function mostra ()
    {
        document.getElementById("msg").innerHTML="Fazendo o Download. Aguarde o término e instale o arquivo Guberman.apk no tablet ou smartphone Android";
    }
</script>
</head>
<body class=body>
<?php
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    
    // VERSÃO DO SISTEMA A SER CHECADA POR TODOS
    $version= "1.00";
     
    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    if (preg_match('/Android/i', $u_agent)) {
        $platform = 'Android';
    }
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/WOW/i',$u_agent) )
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    //echo $bname;
    //echo $ub;
?>   
<center>  
<table class=table cols="2" >
    <tr>
    	<td class=contlogo> 
            <img class=apresenta src="images/logo_americas_black.png" />
        </td>
        <td class=contgub>
            <img src="images/gublogo.png"  longdesc="http://www.guberman.com.br" align="right" />
        </td>
    </tr>
</table>

<table class=tablebig  >
    <tr>
        <td  class=tab2   >
            <table width="227" align="center" class=tab2 >
                <tr align="center">
                    <td valign="bottom" class=contitem>
                        <div class="apresenta">
                            <?php
                                if($platform === "Android")
                                {
                                    echo '<a href="Guberman.apk"><img onclick="mostra();" src="images/btstart.png" title="Carregar o aplicativo " border="0"></a>';
                                }
                                else
                                {
                                    echo '<a href="Guberman.apk"><img onclick="mostra();" src="images/btstart.png" title="Carregar o aplicativo " border="0"></a>';
                                }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td class=contitem align="center" valign="bottom">
                        <div align="center" id=message class="apresenta">
                            <label class="label"><?php echo "Plataforma: ".$platform; ?></br> </label>
                            <label class="label"><?php echo "Browser: ".$bname; ?></br> </label>
                            <label class="label"><?php echo "Features: ".$ub; ?> </label>    
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class=contitem align="center" valign="bottom">
                         <label id="msg" class="textomsg"></label>
                    </td>
                </tr>
                <tr>
                    <td class=contitem align="center" valign="bottom">
                        
                    </td>
                </tr>
            </table>
        <td rowspan="4">
            <div>
              <div class=contline><img class=contline src="images/start.png" /></div>
                <div class=contmsg>
                  <label   class="texto">Aplicativo para Android 4.2.2<br>
              </label></div>
            </div> 
            </td>
    </tr> 
    
<tr align="left">
    <td></td>
<tr align="left">
    <td></td>
</tr></table>
</center> 
</body>
</html>

