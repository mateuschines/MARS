<?php
	//iniciar a sessao
	session_start();
	//validar a sessao
	if ( !isset( $_SESSION["sistema"]["id"] ) ) {

		echo "Usuário não logado";
		exit;

	} else {

		if ( isset ( $_GET["login"] ) ) {

			$login = trim($_GET["login"]);

			require '../../../autoload.php';

			use Usuario\Usuario;

		  	$usuarioA = new Usuario();

		  	$dados = $usuarioA->autenticar($login);

		  	if ( (isset($dados->login)) and ($dados->login == $login) and ($dados->id != $id)) {
				echo "<script>alert('Login ja existe');history.back();</script>";
				exit;
			}
		} else {
			//mensagem de erro
			echo "<script>alert('Login inválido');history.back();</script>";
		}
	}