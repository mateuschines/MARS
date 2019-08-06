<?php 
	if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 

	require '../../../autoload.php';

	use Usuario\Usuario;

  	$usuarioU = new Usuario();

	 $id = $nome = $ativo = $email = $login = $senha = $mercado_id = $telefone = $cpf = $tipo = "";

	if (isset ( $_POST["id"])) {
		$id = trim ($_POST["id"]);
	}

	if (isset ( $_POST["nome"])) {
		$nome = trim ($_POST["nome"]);
	}

	if (isset ( $_POST["ativo"])) {
		$ativo = trim ($_POST["ativo"]);
	}

	if (isset ( $_POST["email"])) {
		$email = trim ($_POST["email"]);
	}

	if (isset ( $_POST["login"])) {
		$login = trim ($_POST["login"]);
	}

	if (isset ( $_POST["senha"])) {
		$senha = trim ($_POST["senha"]);
	}

	if (isset ( $_POST["mercado_id"])) {
		$mercado_id = trim ($_POST["mercado_id"]);
	}

	if (isset ( $_POST["telefone"])) {
		$telefone = trim ($_POST["telefone"]);
	}

	if (isset ( $_POST["cpf"])) {
		$cpf = trim ($_POST["cpf"]);
	}

	if (isset ( $_POST["tipo"])) {
		$tipo = trim ($_POST["tipo"]);
	}

	if (empty ( $nome )) {
		echo "<script>alert('Preencha o nome');history.back();</script>";
		exit;

	} else if (empty ( $cpf )) {
		echo "<script>alert('Preencha o cpf');history.back();</script>";
		exit;

	} else if (empty ( $ativo )) {
		echo "<script>alert('Preencha a opção');history.back();</script>";
		exit;

	} else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		echo "<script>alert('Preencha o e-mail');history.back();</script>";
		exit;
	} else if ( ( empty ( $login ) ) and ( empty($id) ) ) {
		echo "<script>alert('Preencha o login');history.back();</script>";
		exit;

	} else if ( ( empty ( $senha ) ) and ( empty($id) ) ){
		echo "<script>alert('Preencha a senha');history.back();</script>";
		exit;

	} else if (empty ( $mercado_id )) {
		echo "<script>alert('Preencha Selecione o mercado');history.back();</script>";
		exit;

	} else {
		
		if ( empty ($id) ) {

			$dados = $usuarioU->autenticar($login);

			if ( (isset($dados->login)) and ($dados->login == $login) and ($dados->id != $id)) {
				echo "<script>alert('Login ja existe');history.back();</script>";
				exit;
			}

			$senha = password_hash($senha, PASSWORD_DEFAULT);
			
			if ($usuarioU->inserirUsuario($nome, $ativo, $email, $login, $senha, $mercado_id, $telefone, $cpf, $tipo)) {
				echo "<script>alert('Registro salvo');location.href='homeA.php?op=listas&pg=usuario';</script>";
				exit;
			} else {

			echo "<script>alert('Não foi possivel salvar');</script>";
			exit;
			}//fim  else erro
		} else {

			if ( empty($senha) ) {

				if ($usuarioU->editarEmpUsuario($id, $nome, $ativo, $email, $mercado_id, $telefone, $cpf, $tipo)) {
					echo "<script>alert('Registro atualizado');location.href='homeA.php?op=listas&pg=usuario';</script>";
					exit;

				} 
				} else {

					$senha = password_hash($senha, PASSWORD_DEFAULT);

					if ($usuarioU->editarUsuario($id, $nome, $ativo, $email, $senha, $mercado_id, $telefone, $cpf, $tipo)) {

						echo "<script>alert('Registro atualizado com senha');location.href='homeA.php?op=listas&pg=usuario';</script>";
						exit;

					} else {

						echo "<script>alert('Não foi possivel salvar com senha');</script>";
						exit;

					}//fim  else erro2
			}
		}
	}






 ?>