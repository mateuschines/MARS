<?php 

session_start();

require '../../../autoload.php';

use Usuario\Usuario;

$usuario = new Usuario();

if (isset($_SESSION["tentativas"])) {

	$_SESSION["tentativas"]++;

} else{
	
	$_SESSION["tentativas"]=1;
}

if ($_SESSION["tentativas"]>100) {

	echo "<p>Tente novamente mais tarde!</p>";
	exit;
}

if ( $_POST ) {
	 
	$login = $senha = "";

	if (isset($_POST["login"])) {
		$login = trim($_POST["login"]);
	}
	if (isset($_POST["senha"])) {
		$senha = trim ($_POST["senha"]);
	}

	if (empty($login)) {

		echo "<script>alert('Preencha o login');history.back();</script>";
		exit;

	} else if (empty($senha)) {

		echo "<script>alert('Preencha a senha');history.back();</script>";
		exit;

	} else{

		$dados = $usuario->autenticar($login);

		if (empty($dados->id)) {

			echo "<script>alert('Usuário não encontrado');history.back();</script>";

		} else if ($dados->ativo != "Sim") {

			echo "<script>alert('Este usuário não está ativo');history.back();</script>";

		} else if (!password_verify($senha, $dados->senha)) {

			echo "<script>alert('Senha incorreta');history.back();</script>";

		} else{
			
			$_SESSION["sistema"] = array(
				"id"=>$dados->id,
				"login"=>$dados->login,
				"nome"=>$dados->nome,
				"mercado"=>$dados->mercado_id,
				"tipo"=>$dados->tipo

			);

			if ($dados->tipo == "Admin") {

				//redirencionar para painel 
				header("Location: homeA.php");

			} else {
				header("Location: home.php");
			}
		}


	}

}else {
	 	//caso nao for enviado o dados por post redirecionar para o login
	 	header("Location: ../index.php");
	 }



 ?>