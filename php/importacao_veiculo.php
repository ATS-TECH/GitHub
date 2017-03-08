<?php
$chip = $_REQUEST["chip"];  
$idveiculo= $_REQUEST["idveiculo"];
$idpessoa= $_REQUEST["idpessoa"];
$placa= $_REQUEST["placa"];
$marca= $_REQUEST["marca"];
$modelo= $_REQUEST["modelo"];
$anomodelo= $_REQUEST["anomodelo"];
$ano= $_REQUEST["ano"];
$cor= $_REQUEST["cor"];
$eixos= $_REQUEST["eixos"];
$registro=$_REQUEST["registro"]; 
$novochip = $_REQUEST["novochip"];
$km = $_REQUEST["kmveiculo"];
$hora = $_REQUEST["hora"];
$operacao=$_REQUEST["operacao"];
$eixos=$_REQUEST["eixos"];
include 'mysql.php'; 
$vertag=0;
$operacao="novo";
$cmd="select * from veiculo where registro='".$registro."' and idpessoa=".$idpessoa;
$result = mysql_query($cmd);
while($rs=  mysql_fetch_array($result))
{
    $operacao="update";
}

if($operacao==="novo")
{
     
    $idveiculo=$registro;
    $cmd= "INSERT INTO veiculo(idpessoa,chip_veiculo,placa_veiculo,marca,modelo_veiculo,ano_veiculo,cor_veiculo,ano_modelo_veiculo,registro_veiculo,km_veiculo,qtdeixos)VALUES("
            .$_REQUEST["idpessoa"].",'"
            .$registro."','"
            .$placa."','"
            .$marca."','"
            .$modelo."','"
            .$ano."','"
            .$cor."','"
            .$anomodelo."','"
            .$registro."',0,0)";
    $result = mysql_query($cmd);
    if(mysql_error()=== "")
    {
        
        for($indeixo=0;$indeixo>$eixos;$indeixo++)
        {
            if($indeixo==0)
            {
                $cmd2= "INSERT INTO eixo_veiculo(idpessoa,chip_veiculo,ideixo_veiculo,ideixos,qtdrodas)VALUES"
                        ."(".$_REQUEST["idpessoa"].",'".$novochip."',"
                        .$indeixo.",3,1)";
            }
            else
            {
                  $cmd2= "INSERT INTO eixo_veiculo(chip_veiculo,ideixo_veiculo,ideixos,qtdrodas)VALUES"
                        ."('".$novochip."',"
                        .$indeixo.",3,2)";
            }
            $result = mysql_query($cmd2);
            if(mysql_error()!= null)
            {
                $response["success"] = 0;
                $response["message"] = "Eixos não criados:";

            }
            else
            {
                $response["success"] = 1;
                $response["message"] = "Veículo ".$registro." CRIADO com sucesso.";
            }
        }
    }
    else 
    {
        $mensagem=mysql_error(); 
        if($mensagem.  substr(1, 9)==="Duplicate")
        {
            $mensagem="Veículo não criado: ".$registro." já criado";
        }
        else
        {
            $mensagem="Veículo não criado: ".mysql_error().$cmd;
        }
        $response["success"] = 0;
        $response["message"] = $mensagem;
    }
}
else
{
    $cmd= "update veiculo set marca='$marca',"
            . " modelo_veiculo='$modelo',"
            . " chip_veiculo='$novochip',"
            . " registro_veiculo='".$registro."' ,"
            . " ano_veiculo='".$ano."' ,"
            . " ano_modelo_veiculo='".$anomodelo."' ,"
            . " cor_veiculo='".$cor."' ,"
            . " registro_veiculo='".$registro."' ,"
            . " placa_veiculo='".$placa."' ,"
            . " hora_veiculo= now() "
            . " where chip_veiculo='$idveiculo'";
    


            $result = mysql_query($cmd);

            if(mysql_error()== null)
            {
                    // mysql inserting a new row
                    $response["success"] = 1;
                    $response["message"] = "Atualizado com sucesso.";

                    // echoing JSON response
                    

                    $result = mysql_query("INSERT INTO seriekm(chip_veiculo,km,datakm)VALUES('$chip','$kmveiculo',now())");

            } else 
            {
                // required field is missing
                $response["success"] = 0;
                $response["message"] = mysql_error();
            }
}

    // echoing JSON response
echo json_encode($response);
 
?>