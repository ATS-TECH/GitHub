<?php
include 'mysql.php';
$razao_social=$_REQUEST["razao_social"];
$cnpj=$_REQUEST["cnpj"];
$email=$_REQUEST["email"];
$telefone=$_REQUEST["telefone"];
$cmd="select max(idpessoa) qtd from pessoa_juridica";

$result=  mysql_query($cmd);
$idpessoanova=0;
while($res=  mysql_fetch_array($result))
{
    $idpessoanova=$res["qtd"];
    $idpessoanova++;
}
$cmd="select cnpj, email from pessoa_juridica where cnpj in ('".$cnpj."')";

$result=  mysql_query($cmd);
$existe=false;
while($res=  mysql_fetch_array($result))
{
    $existe=true;
    $emailreg=$res["email"];
}
if($existe)
{
    $response["success"] = 0;
    $response["message"] = "CNPJ já cadastrado por ".$emailreg;
}
 else {
    
        $cmd="insert into pessoa_juridica(idpessoa, razao_social, cnpj, email, telefone) "
            . " values(".$idpessoanova.",'".$razao_social."','".$cnpj."','".$email."','".$telefone."')";

        $result=  mysql_query($cmd);
        if(mysql_error()== "")
        {
            $cmdi=' INSERT INTO rastreado(idrastreado,idpessoa,nomerastreado,indalmox,indbeacon,indchipado,indqrcode,indmanual,indbarras,indveiculo)VALUES'
                    ."(1,".$idpessoanova.",'VEÍCULOS','S','N','S','N','N','N','S')";
            mysql_query($cmdi);
            
            $cmdi=' INSERT INTO componente(idcomponente,descrComponente,ispneu,idpessoa,cindchipado)VALUES('
                    ."2,'PNEUS','S',".$idpessoanova.",'S')";              
            mysql_query($cmdi);
            
            
            $cmdi=' INSERT INTO familia_rastreado(idrastreado,idcomponente,idpessoa)VALUES('
                    ."1,2,".$idpessoanova.")";                                  
            mysql_query($cmdi);
            
            $email_message .= "Empresa: ".$razao_social."\r\n";
            $email_message .= "Email: ".$email."\r\n";
            $email_message .= "Telephone: ".$telefone."\r\n";
            $email_message .= "CNPJ: ".$cnpj."\r\n";

            $headers = "MIME-Version: 1.1\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
            $headers .= "From: comercial@americas-tech.com\r\n"; // remetente
            $headers .= "Return-Path: comercial@americas-tech.com\r\n"; // return-path
            try
            {
                mail("ekuhner@americas-tech.com", "Registro de empresa", $email_message,$headers);
                $response["success"] = 1;
                $response["message"] = $razao_social." criado com sucesso.";
                $response["idpessoa"] = $idpessoanova;
            }
            catch (Exception $ex)
            {
                echo $ex;
            }
        }
        else
        {
            $response["success"] = 0;
            $response["message"] = "Problemas: ".$cmd.mysql_error();
        }
//    }
//    else {
//        $response["success"] = 0;
//        $response["message"] = "Problemas CNPJ Inválido: ".$cnpj;
//    }
 }
echo json_encode($response);
// 
//function verifica_igualdade() {
//        // Todos os caracteres em um array
//        $caracteres = str_split($this->valor );
//        
//        // Considera que todos os números são iguais
//        $todos_iguais = true;
//        
//        // Primeiro caractere
//        $last_val = $caracteres[0];
//        
//        // Verifica todos os caracteres para detectar diferença
//        foreach( $caracteres as $val ) {
//            
//            // Se o último valor for diferente do anterior, já temos
//            // um número diferente no CPF ou CNPJ
//            if ( $last_val != $val ) {
//               $todos_iguais = false; 
//            }
//            
//            // Grava o último número checado
//            $last_val = $val;
//        }
//        
//        // Retorna true para todos os números iguais
//        // ou falso para todos os números diferentes
//        return $todos_iguais;
//    }
//function calc_digitos_posicoes( $digitos, $posicoes = 10, $soma_digitos = 0 ) {
//		// Faz a soma dos dígitos com a posição
//		// Ex. para 10 posições:
//		//   0    2    5    4    6    2    8    8   4
//		// x10   x9   x8   x7   x6   x5   x4   x3  x2
//		//   0 + 18 + 40 + 28 + 36 + 10 + 32 + 24 + 8 = 196
//		for ( $i = 0; $i < strlen( $digitos ); $i++  ) {
//			// Preenche a soma com o dígito vezes a posição
//			$soma_digitos = $soma_digitos + ( $digitos[$i] * $posicoes );
//
//			// Subtrai 1 da posição
//			$posicoes--;
//
//			// Parte específica para CNPJ
//			// Ex.: 5-4-3-2-9-8-7-6-5-4-3-2
//			if ( $posicoes < 2 ) {
//				// Retorno a posição para 9
//				$posicoes = 9;
//			}
//		}
//
//		// Captura o resto da divisão entre $soma_digitos dividido por 11
//		// Ex.: 196 % 11 = 9
//		$soma_digitos = $soma_digitos % 11;
//
//		// Verifica se $soma_digitos é menor que 2
//		if ( $soma_digitos < 2 ) {
//			// $soma_digitos agora será zero
//			$soma_digitos = 0;
//		} else {
//			// Se for maior que 2, o resultado é 11 menos $soma_digitos
//			// Ex.: 11 - 9 = 2
//			// Nosso dígito procurado é 2
//			$soma_digitos = 11 - $soma_digitos;
//		}
//
//		// Concatena mais um dígito aos primeiro nove dígitos
//		// Ex.: 025462884 + 2 = 0254628842
//		$cpf = $digitos . $soma_digitos;
//
//		// Retorna
//		return $cpf;
//	}
//
//	/**
//	 * Valida CPF
//	 *
//	 * @author                Luiz Otávio Miranda <contato@tutsup.com>
//	 * @access protected
//	 * @param  string    $cpf O CPF com ou sem pontos e traço
//	 * @return bool           True para CPF correto - False para CPF incorreto
//	 */
//	 function valida_cpf() {
//		// Captura os 9 primeiros dígitos do CPF
//		// Ex.: 02546288423 = 025462884
//		$digitos = substr($this->valor, 0, 9);
//
//		// Faz o cálculo dos 9 primeiros dígitos do CPF para obter o primeiro dígito
//		$novo_cpf = $this->calc_digitos_posicoes( $digitos );
//
//		// Faz o cálculo dos 10 dígitos do CPF para obter o último dígito
//		$novo_cpf = $this->calc_digitos_posicoes( $novo_cpf, 11 );
//        
//        // Verifica se todos os números são iguais
//        if ( $this->verifica_igualdade() ) {
//            return false;
//        }
//
//		// Verifica se o novo CPF gerado é idêntico ao CPF enviado
//		if ( $novo_cpf === $this->valor ) {
//			// CPF válido
//			return true;
//		} else {
//			// CPF inválido
//			return false;
//		}
//	}
//
//	/**
//	 * Valida CNPJ
//	 *
//	 * @author                  Luiz Otávio Miranda <contato@tutsup.com>
//	 * @access protected
//	 * @param  string     $cnpj
//	 * @return bool             true para CNPJ correto
//	 */
//	 function valida_cnpj () {
//		// O valor original
//		$cnpj_original = $this->valor;
//
//		// Captura os primeiros 12 números do CNPJ
//		$primeiros_numeros_cnpj = substr( $this->valor, 0, 12 );
//
//		// Faz o primeiro cálculo
//		$primeiro_calculo = $this->calc_digitos_posicoes( $primeiros_numeros_cnpj, 5 );
//
//		// O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
//		$segundo_calculo = $this->calc_digitos_posicoes( $primeiro_calculo, 6 );
//
//		// Concatena o segundo dígito ao CNPJ
//		$cnpj = $segundo_calculo;
//        
//        // Verifica se todos os números são iguais
//        if ( $this->verifica_igualdade() ) {
//            return false;
//        }
//
//		// Verifica se o CNPJ gerado é idêntico ao enviado
//		if ( $cnpj === $cnpj_original ) {
//			return true;
//		}
//	}
//
//         function valida () {
//		// Valida CPF
//		if ( $this->verifica_cpf_cnpj() === 'CPF' ) {
//			// Retorna true para cpf válido
//			return $this->valida_cpf();
//		} 
//		// Valida CNPJ
//		elseif ( $this->verifica_cpf_cnpj() === 'CNPJ' ) {
//			// Retorna true para CNPJ válido
//			return $this->valida_cnpj();
//		} 
//		// Não retorna nada
//		else {
//			return false;
//		}
//	}
//        function formata() {
//		// O valor formatado
//		$formatado = false;
//		// Valida CPF
//		if ( $this->verifica_cpf_cnpj() === 'CPF' ) {
//			// Verifica se o CPF é válido
//			if ( $this->valida_cpf() ) {
//				// Formata o CPF ###.###.###-##
//				$formatado  = substr( $this->valor, 0, 3 ) . '.';
//				$formatado .= substr( $this->valor, 3, 3 ) . '.';
//				$formatado .= substr( $this->valor, 6, 3 ) . '-';
//				$formatado .= substr( $this->valor, 9, 2 ) . '';
//			}
//		} 
//		// Valida CNPJ
//		elseif ( $this->verifica_cpf_cnpj() === 'CNPJ' ) {
//			// Verifica se o CPF é válido
//			if ( $this->valida_cnpj() ) {
//				// Formata o CNPJ ##.###.###/####-##
//				$formatado  = substr( $this->valor,  0,  2 ) . '.';
//				$formatado .= substr( $this->valor,  2,  3 ) . '.';
//				$formatado .= substr( $this->valor,  5,  3 ) . '/';
//				$formatado .= substr( $this->valor,  8,  4 ) . '-';
//				$formatado .= substr( $this->valor, 12, 14 ) . '';
//                                $cnpj=$formatado;
//			}
//		} 
//		// Retorna o valor 
//		return $formatado;
//	}
