<?php 

require '../../../autoload.php';

use Usuario\Usuario;

$usuario = new Usuario();

if ( $_POST ) {
	 
	$nome = $email = $cpf = "";

	if (isset($_POST["nome"])) {
		$nome = trim($_POST["nome"]);
	}
	if (isset($_POST["email"])) {
		$email = trim ($_POST["email"]);
    }
    
    if (isset($_POST["cpf"])) {
		$cpf = trim ($_POST["cpf"]);
    }

	if (empty($nome)) {

		echo "<script>alert('Preencha o nome de Usuario!');history.back();</script>";
		exit;

	} else if (empty($cpf)) {

		echo "<script>alert('Preencha seu cpf!');history.back();</script>";
		exit;

	} else if (empty($email)) {

		echo "<script>alert('Preencha o email cadastrado no sistema!');history.back();</script>";
		exit;

	} else{

		$dados = $usuario->autenticar($nome);
		

		if (empty($dados->id)) {

			echo "<script>alert('Usuário não encontrado');history.back();</script>";

		} else if ($dados->ativo != "Sim") {

			echo "<script>alert('Este usuário não está ativo');history.back();</script>";

		} else if ($dados->cpf != $cpf) {

			echo "<script>alert('Este cpf é invalido');history.back();</script>";

		} else if ($dados->email != $email) {

			echo "<script>alert('Este email é invalido');history.back();</script>";

		} else{
			$id = $dados->id;
			
			/*Mandar email no PHP Desenvolva*/

			include "../app/gerarSenha.php";

			//Retornar a senha com 8 caracteres como maiúsculas, minusculas e números:
			$senhaH = $senha = gerar_senha(8, true, true, true, false);
			

			$senha = password_hash($senha, PASSWORD_DEFAULT);

			if ($usuario->RecuperarSenhaUsuario($id, $senha)) {

				//enviar email
				$para = "mateus-chineis@live.com";
				$assunto = "Sua Nova senha é: $senhaH";
		  
				if (mail($para, $assunto, "Sua nova senha é $senhaH", "From: $email")) {
				  
				} else{
				  echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>
						  alert ('Erro ao enviar EMAIL, tente mais tarde Sua senha: $senhaH')
						  </SCRIPT>";exit;
				}

				echo "<script>alert('Seu email foi enviado');location.href='../';</script>";
				exit;

			}

			//redirencionar para painel 
			header("Location: index.php");
		}


	}

}else {
	 	//caso nao for enviado o dados por post redirecionar para o login
	 	header("Location: ../index.php");
	 }



 ?>