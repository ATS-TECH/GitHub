<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="alternate" href="http://truck-id.com.br/" hreflang="pt" />
        <link rel="alternate" href="http://truck-id.com.br/" hreflang="x-default" />
        
        <meta http-equiv="content-language" content="pt-br" />
        <meta name="author" content="Americas Technologies Solutions" />
        
        <link rel="shortcut icon" href="images/favicon_americas.ico" type="image/x-icon">
        <link rel="icon" href="images/favicon_americas.ico" type="image/x-icon">
        
        <script>
          $(function () {
            $('.dropdown-toggle').dropdown();
          }); 
        </script>
        
        <!--Analytics-->
        
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-13126325-5', 'auto');
            ga('send', 'pageview');

        </script>
        <meta name="google-site-verification" content="grzKjj22tvgsWHB7LGMamsoDlv-5djeUhv3N8onEjQ4" />
        
        <link rel="stylesheet" href="css/bootstrap.css" />

        
        <script src="lib/roteiro.js" type="text/javascript"></script>
        <script src="lib/roteirofrota.js" type="text/javascript"></script>
        <script src="lib/roteiroinst.js" type="text/javascript"></script>
        <script src="lib/roteirorastreados.js" type="text/javascript"></script>
        <script src="lib/importCSV.js" type="text/javascript"></script>
        <script src="lib/facebook.js" type="text/javascript"></script>
        
        <link href="css/css_resumo.css" rel="stylesheet" type="text/css"/>
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/foundation-icons/foundation-icons.css" rel="stylesheet" type="text/css"/>        
        <link href="css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        
        <meta name="description" content = "Gestão automatizada de frotas utilizando a tecnologia RFID.Controle de manutenção de pneus, componentes e serviços. Planos de manutenção automatizados e muito mais"/>
        <meta name="keywords" content = "ATS, Automação da gestao de frota, chips de pneu, manutenção de frota ,conveyor belt RFID tags"/>

         
    </head>
    <body >
        <script>
            window.fbAsyncInit = function() {
              FB.init({
                appId      : '1851417141741170',
                xfbml      : true,
                version    : 'v2.8'
              });
            };

            (function(d, s, id){
               var js, fjs = d.getElementsByTagName(s)[0];
               if (d.getElementById(id)) {return;}
               js = d.createElement(s); js.id = id;
               js.src = "//connect.facebook.net/en_US/sdk.js";
               fjs.parentNode.insertBefore(js, fjs);
             }(document, 'script', 'facebook-jssdk'));
          </script>
    <input id=plataforma name="plataforma" type="hidden" value="<?php echo $_REQUEST["plataforma"]; ?>" />
    <input id=macaddress name="macaddress" type="hidden" value="<?php echo $_REQUEST["macaddress"]; ?>" />
    <?php
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';

        // VERSÃƒO DO SISTEMA A SER CHECADA POR TODOS
        $version= "1.16";
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'Linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'Mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'Windows';
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
        elseif(preg_match('/OPR/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
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
    
    <div id="main" >
        <nav class="container-fluid navbar navbar-default ">
            <ul class="nav navbar-nav">
                <li class="navbar-header">
                    <img width="150rem" class="img-responsive" style="margin: 1rem;" src="images/logotruck.png" />
                    <?php echo '<label style="margin-left:1rem">'
                    .$bname." - ".$platform." - ".$ub.'<br>'
                            ."Versão: ".$version." - ".$ipaddress
                            . '</label>';?>
                </li>
                
            </ul> 
            <div id="emparea"></div>

        </nav>
        
            <div class="container-fluid bg-3">
                
                <div id="contgeral" class="container-fluid">
                    <input name="username" id="usuario" type="text" placeholder="LOGIN" class="input-sm"/>
                    
                    <input name="password" id="senha" type="password" placeholder="SENHA"  class="input-sm"/>
                    <br>
                    <button class="btn btn-primary "  onclick="signIn();"   >
                         ENTRAR
                    </button>
                    <br>
                    <label class="text-left"  style="padding: 0.5rem;"  >
                        Registrar empresa em <a href="#" onclick="novaemp();"  >SUBSCREVER.</a>
                    </label>
                    <br>
                    <label class="text-left"  style="padding: 0.5rem;"  >
                        <a href="#" onclick="injeta('php/termos.html','termos','termos','slide','termos');"  >Termos de uso dos serviços.</a>
                    </label>
                    <br>
                    <label class="text-left"  style="padding: 0.5rem;"  >
                        <a href="https://www.linkedin.com/pulse/truck-id-eduardo-kühner?published=t" target="_blank"  >Saiba mais...</a>
                    </label>
                    <br>
                    <div class="fb-like" style="padding: 0.5rem;"
                        data-share="true"
                        data-width="150"
                        data-show-faces="true"
                       >
                    </div>
                </div>
                
            </div>
            
            
        <div id="termos"></div>
            
        <div class="footer container-fluid bg-4" style="padding: 1rem;font-size: 11px;">
            Americas Technologies Solutions (ATS) - 2017
            <br>
            Brasil - Rio de Janeiro RJ
            <br>
            Suporte: suporte@truck-id.com.br
            <br>
            Contato: comercial@truck-id.com.br
            <br>
            Investidores: invest@truck-id.com.br
        </div>
    </div>
    <div class="container-fluid" id="tabmenu"></div> 
    <div class="container-fluid" id="page-wrapper"></div>
    <div id="containermsg"></div>
    <input id=browser name="browser" type="hidden" value="<?php echo $bname; ?>" />
    <input id="idpessoa"  name="idpessoa" type="hidden" value="#"/>
    <input id="idusuario"  name="idusuario" type="hidden" value=""/>
    <input id="razao_social"  name="razao_social" type="hidden" value=""/>
    <input id="adm_gestor"  name="adm_gestor" type="hidden" value="S"/>
    <input id="adm_veiculo"  name="adm_veiculo" type="hidden" value="S"/>
    <input id="adm_almox"  name="adm_almox" type="hidden" value="S"/>
    <input id="adm_rastreado"  name="adm_rastreado" type="hidden" value="S"/>
    <input id="adm_usuario"  name="adm_usuario" type="hidden" value="S"/>
    <input id="adm_portaria"  name="adm_portaria" type="hidden" value="S"/>
    <input id="empusuario"  name="empusuario" type="hidden" value=""/>
    <input id="numero_chip"  name="numero_chip" type="hidden" value=""/>
    <input id="strurl"  name="strurl" type="hidden" value=""/>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
