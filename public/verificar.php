<?php 

session_cache_limiter('private');

session_cache_expire(60);

session_start();



require '../autoload.php';



use Cliente\Cliente;



$cliente = new Cliente();



if (isset($_SESSION["tentei"])) {



	$_SESSION["tentei"]++;



} else{

	

	$_SESSION["tentei"]=1;

}



if ($_SESSION["tentei"]>100) {



	echo "<p>Tente novamente mais tarde!</p>";

	exit;

}



if ( $_POST ) {

	 

	$email = $senha = $mercado = $carrinho = "";



	if (isset($_POST["email"])) {

        $email = trim($_POST["email"]);

	}

	if (isset($_POST["senha"])) {

		$senha = trim ($_POST["senha"]);

	}



	$mercado = $_POST["mercado"];

	$carrinho = $_POST["carrinho"];



	if (empty($email)) {



		echo "<script>alert('Preencha o email');history.back();</script>";

		exit;



	} else if (empty($senha)) {



		echo "<script>alert('Preencha a senha');history.back();</script>";

		exit;



	} else{



		$dados = $cliente->autenticar($email);



		if (empty($dados->email)) {



			echo "<script>alert('Usuário não encontrado');history.back();</script>";



		} else if (!password_verify($senha, $dados->senha)) {



			echo "<script>alert('Senha incorreta');history.back();</script>";



		} else{

			

			$_SESSION["site"] = array(

				"id"=>$dados->id,

				"nome"=>$dados->nome



            );

            



			if(!isset($carrinho)){

				if (!isset($mercado)) {
                    header("Location: selecionarMercado.php");
                } else {
				    header("Location: $mercado/carrinho");
                }

				

			} else {
                if (!!isset($mercado)) {
                    header("Location: selecionarMercado.php");
                } else {
				    header("Location: $mercado");
                }

			}



			





		}





	}



}else {

	 	//caso nao for enviado o dados por post redirecionar para o login

	 	header("Location: login.php");

	 }







 ?>