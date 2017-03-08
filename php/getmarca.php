<?php
include 'mysql.php';
$medida=$_REQUEST['medida'];
$medida=  trim($medida);
echo '<ul class="nav navbar-nav">'

    . '<li class="dropdown">'
     .   ' <a class="dropdown-toggle" data-toggle="dropdown" href="#">Marca'
   .         '</a>'

    .    ' <ul class="dropdown-menu text-center" style="font-size: 11px;letter-spacing: 1px;padding: 3px";>';

             $cmd = "SELECT distinct marca FROM carcacas where medida in('".$medida."') order by marca";
             $cmd = mysql_query($cmd);
             while($rsmed= mysql_fetch_array($cmd))
             {
                 echo '<li role="presentation" '
                 . ' onclick="carregamodelo('."'".$rsmed["marca"]."'".');" class=pull-left><label class="navbar-text">'.$rsmed["marca"].'</label></li>';
             }

    echo '</ul>'  
 ."</ul>";
?>
