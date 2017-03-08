<?php

$host  = $_SERVER['HTTP_HOST'];
if($host!="localhost")
{
    $conexao = @mysql_connect("mysql01.americas-tech.com","americas_tech","kuhner") or die("Não foi possível conectar o banco de dados");
    $banco = @mysql_select_db("americas_tech") or die("Não foi possível selecionar o banco de dados");
}
else
{
    $conexao = @mysql_connect("localhost","root","edu") or die("Não foi possível conectar o banco de dados");
    $banco = @mysql_select_db("componentes") or die("Não foi possível selecionar o banco de dados");
}

mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
?>
