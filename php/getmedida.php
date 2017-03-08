<?php
include 'mysql.php';
$po=$_REQUEST['po'];
$po=  trim($po);
echo '<ul class="nav navbar-nav">'

    . '<li class="dropdown">'
     .   ' <a class="dropdown-toggle" data-toggle="dropdown" href="#">Medida'
   .         '</a>'

    .    ' <ul class="dropdown-menu" >';

             $cmd = "SELECT distinct medida FROM carcacas where po in('".$po."') order by medida";
             $cmd = mysql_query($cmd);
             while($rsmed= mysql_fetch_array($cmd))
             {
                 echo '<li role="presentation" style="width:100%;font-size: 11px;letter-spacing: 1px;padding: 5px;" '
                 . ' onclick="carregamarca('."'".$rsmed["medida"]."'".');" >'.$rsmed["medida"].'</li>';
             }

    echo '</ul>'  
 ."</ul>";
?>
