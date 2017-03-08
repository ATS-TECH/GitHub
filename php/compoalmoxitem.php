<?php
    $idcomponente=$_REQUEST["idcomponente"];
    $idpessoa=$_REQUEST["idpessoa"];
    $numero_chip = $_REQUEST["numero_chip"];
    include 'mysql.php';
    $cmd2 = "SELECT ispneu from componente "
            ." where idcomponente = ".$idcomponente;

    $result=  mysql_query($cmd2);
    if(mysql_error()!="")
    {
        echo mysql_error().$cmd2;
    }
    
    $ispneu="N";
    while($rs2=  mysql_fetch_array($result))
    {
        $ispneu = $rs2["ispneu"];
    }
    if($ispneu==="S")
    {
        echo "php/detalhepneualmox.php?idpneu=".$numero_chip."&idpessoa=".$idpessoa;
    }
    else
    {
        echo "php/detalhecomponente.php?idcomponente=".$idcomponente."&idpessoa=".$idpessoa."&numero_chip=".$numero_chip;
    }
