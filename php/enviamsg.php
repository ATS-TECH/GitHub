<?php
 
$cmd=  mysql_query($cmd);
$conta=0; 
while ($row = mysql_fetch_array($cmd)) 
{
    $conta++;
    if ($qtditens == 1  || $pontual)  
    {
        echo $row[0];
    }
    else 
    {
        for($item = 0; $item < $qtditens; $item++)  
        {
            echo $row[$item]."#";
        }
        echo "/n";
   }
}
if($conta==0) 
{
    echo "NOK";
}
?>
