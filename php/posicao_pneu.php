
<?php
            
{
    $posicao="entrou";
    if($eixo=0)
    {
        $posicao="ESTEPE";
    }  
    else 
    {
        switch ($ideixo)
        {
            case 1:
                $posicao="D";
                if($roda==1)
                {
                    $posicao+="E";
                }
                else
                {
                    $posicao+="D";
                }
                break;
            case 2:
                $posicao="T";

                break;
            case 3:
                $posicao="L";
                break;
            case 4:
                $posicao="R";
                break;
        }
        if($qtdrodas==2)
        {
            if($roda==1)
            {
                $posicao+="E";
            }
            else
            {
                $posicao+="D";
            }
        }
        else
        {
            switch ($roda)
            {
                case 1:
                    $posicao+="EE";
                    break;
                case 2:
                    $posicao+="EI";
                    break;
                case 3:
                    $posicao+="DI";
                    break;
                case 4:
                    $posicao+="DE";
                    break;
            }
        }
    }
}
?>
 
