 
<?php   

$plataforma=$_REQUEST["plataforma"];
$usuario=$_REQUEST["usuario"];
$razao_social=$_REQUEST["razao_social"];
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "From: comercial@americas-tech.com\r\n"; // remetente
$headers .= "Return-Path: comercial@americas-tech.com\r\n"; 
$email_message= "Usuario: ".$usuario." - ".$razao_social." - ".$plataforma." ".  date_format(date_create(date()),"d/m/Y H:i")." - ".$plataforma;
try
{
    mail("ekuhner@americas-tech.com", "Acesso", $email_message,$headers);
    $response["success"] = 1;
    $response["message"] = "Log atualizado com sucesso.";
}
catch (Exception $ex)
{
    $response["success"] = 0;
    $response["message"] =  $ex;
}
echo json_encode($response);
?>
