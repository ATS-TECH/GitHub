<!DOCTYPE html>
<html>
<body>
    <div style="text-align:center">
        <p>SELECIONE O RASTREAMENTO</p>
    </div>
    <br>
<?php
    include 'php/mysql.php';
    $cmd = "SELECT * FROM rastreado"
            . " where idpessoa=".$_REQUEST['idpessoa'];
    $cmd=  mysql_query($cmd);
    $z=0;
    echo '<table class=table>';
    while($rs=  mysql_fetch_array($cmd))
    {
        if($rs["indbeacon"]=="S")
        {
            $link="verificachip(lerbeacon());";
            $image="beacon";
        }
        if($rs["indchipado"]=="S")
        {
            $link="pesquisachip(".$rs["idrastreado"].",'".$rs["indveiculo"]."');";
            $image="RFID";
        }
        if($rs["indbarras"]=="S")
        {
            $link="abrecomp(1,'S','lercodbarras()' );";
            $image="codbarras";
        }
        if($rs["indqrcode"]=="S")
        {
            $link="pesquisaqrcode(".$rs["idrastreado"].",'".$rs["indveiculo"]."');";
            $image="qrcode";
        }
        if($rs["indmanual"]=="S")
        {
            $link='listaitem('.$rs["idrastreado"].",'".$rs["indveiculo"]."'".')';
            $image="lupa";
        }
        echo '<tr  style="cursor:pointer;" onclick="'.$link.'" >';
        echo '<td class="card" style="cursor:pointer;background-color:white;max-width:80px;" >'
                . '<img style="max-width:50px;float:left;" class="backgroundImage" src="./images/'.$image.'.png"   />'
                .'</td><td style="cursor:pointer;padding-left:10px;text-align:left;" ><h6>'.$rs["nomerastreado"].'</h2>'
                .'</td>'
                . '</tr>';
    }
    echo '</table>';
 ?>  
</body>
</html>