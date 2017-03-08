<html lang="pt-BR">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="./images/favicon_americas.ico" type="image/x-icon">
<link rel="icon" href="./images/favicon_americas.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes" />
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
 

<title>TRUCK ID</title>
<link href="af.ui.css" rel="stylesheet" type="text/css"/>
<link href="Parallax/parallax_css.css" rel="stylesheet" type="text/css"/>
<script src="Parallax/jquery.parallax.js" type="text/javascript"></script>
<style type="text/css">
</style>
</script>
</head>
<body  >
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
//    
    if(preg_match('/Firefox/i',$u_agent))
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
    elseif(preg_match('/WOW/i',$u_agent) )
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    //echo $bname;
     
?>
<div class="section-bg"></div>
    <div id="intro-scene" class="section1"  data-parallax='{"pin":"#intro"}'>
        <div   style="min-width:100%;background-color:black;padding-left:1%;min-height:50px;">
            <a  href="http://americas-tech.com" target="_parent">
                <img  src="images/logo_americas_black.png" />
            </a>
        </div>
        <div style="max-width:640px;min-height: 100px;">
             
                <img src="images/suafrota.png" class="backgroundImage" style="max-width:100%;padding-left:24%;margin-top:5%;"  />
             
        </div>
    </div>
 
    <div id="explosion-scene" class="section2"  >
    
        <h1>Automação de Frotas.</h1><br>
        
        <img class="backgroundimage" src="images/bola.png" style="max-width:30px;float:left;margin-right: 10px;">
        ADAPTÁVEL
        <p>Responsivo e SPA, facilmente integrado a qualquer sistema WEB através de WEBSERVICES. Sem a necessidade de plugins adicionais e com versões Android, Windows e IOS.</p>
          </p><br>
         <img class="backgroundimage" src="images/bola.png"  style="max-width:30px;float:left;margin-right: 10px;">
             SEGURO
           <p>Desenvolvido usando as mais modernas tecnologias (HTML5 e CSS3). Os mais modernos equipamentos, chips e metodologias de automação do mercado.</p>
          </p><br>  
        <img class="backgroundimage" src="images/bola.png"  style="max-width:30px;float:left;margin-right: 10px;">
              RENTÁVEL
          <br><p>Melhor relação Custo X Benefícios do mercado. Chips de pneu fabricados pela própria ATS e desenvolvidos em conjunto com a Tipler, Bridgestone, entre outros players da indústria de pneus.</p>
          </p><br>
          <img class="backgroundimage" src="images/bola.png"  style="max-width:30px;float:left;margin-right: 10px;">
              EFICAZ
          <p>Pare de perder componentes e peças. Cotate-nos para início de uma gestão eficaz dos ativos da sua frota. </p>
      
    </div>
    
 
<div id="start-scene" class="section3"  >
    <table class="grid"><tr><td>
        <img src='images/start.png' class='backgroundimage' style="max-width:345px;"/>
    </td></tr><tr><td>
        <img src='images/btstart.png' class='backgroundimage' style="max-width:150px;" onclick="window.open('../atskit/index.php')"/>
    </td></tr></table>  
    </div>
</center>

</body>
</html>

