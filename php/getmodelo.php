<?php
include 'mysql.php';
$medida=$_REQUEST['medida'];
$marca=$_REQUEST['marca'];
echo '<ul class="nav navbar-nav">'

    . '<li class="dropdown">'
     .   ' <a class="dropdown-toggle" data-toggle="dropdown" href="#">Modelo'
   .         '</a>'

    .    ' <ul class="dropdown-menu " >';

             $cmd = "SELECT distinct modelo FROM carcacas where medida in('".$medida."') and marca in ('".$marca."') order by modelo ";
             $cmd = mysql_query($cmd);
             while($rsmed= mysql_fetch_array($cmd))
             {
                 echo '<li role="presentation" style="width:100%;font-size: 11px;letter-spacing: 1px;padding: 5px;" '
                 . ' onclick="setamodelo('."'".$rsmed["modelo"]."'".');" >'.$rsmed["modelo"].'</li>';
             }

    echo '</ul>'  
 ."</ul>";
?>
