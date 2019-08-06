<?php 

	require '../../autoload.php';

	use Cliente\Cliente;

	$clienteC = new Cliente();

	$id = $nome = $cpf = $rg = $endereco = $celular = $email = $senha = $whatsapp = $sexo = $dtNascimento = $cep = $complemento = $bairro = $numero = $cidade_id = "";

	if (isset ( $_POST["id"])) {
		$id = trim ($_POST["id"]);
	}

	if (isset ( $_POST["nome"])) {
		$nome = trim ($_POST["nome"]);
	}

	if (isset ( $_POST["cpf"])) {
		$cpf = trim ($_POST["cpf"]);
	}

	require "../admin/app/validaDocs.php";
	$msgCPF = validaCPF($cpf);

	if (isset ( $_POST["rg"])) {
		$rg = trim ($_POST["rg"]);
	}

	if (isset ( $_POST["endereco"])) {
		$endereco = trim ($_POST["endereco"]);
	}

	if (isset ( $_POST["celular"])) {
		$celular = trim ($_POST["celular"]);
	}

	if (isset ( $_POST["email"])) {
		$email = trim ($_POST["email"]);
	}

	if (isset ( $_POST["senha"])) {
		$senha = trim ($_POST["senha"]);
	}

	if (isset ( $_POST["whatsapp"])) {
		$whatsapp = trim ($_POST["whatsapp"]);
	}

	if (isset ( $_POST["sexo"])) {
		$sexo = trim ($_POST["sexo"]);
	}

	if (isset ( $_POST["dtNascimento"])) {
		$dtNascimento = trim ($_POST["dtNascimento"]);

		//formatar 30/12/2019 - 2019-12-30
		$dtNascimento = explode("/",$dtNascimento);
		$dtNascimento = $dtNascimento[2]."-".$dtNascimento[1]."-".$dtNascimento[0];

	}

	if (isset ( $_POST["cep"])) {
		$cep = trim ($_POST["cep"]);
	}

	if (isset ( $_POST["complemento"])) {
		$complemento = trim ($_POST["complemento"]);
	}

	if (isset ( $_POST["bairro"])) {
		$bairro = trim ($_POST["bairro"]);
	}

	if (isset ( $_POST["numero"])) {
		$numero = trim ($_POST["numero"]);
	}

	if (isset ( $_POST["cidade_id"])) {
		$cidade_id = trim ($_POST["cidade_id"]);
	}

	if ( $msgCPF != 1 ) {

		echo "<script>alert('$msgCPF');history.back();</script>";
		exit;

	}else if (empty ( $nome )) {
		echo "<script>alert('Preencha o nome');history.back();</script>";
		exit;

	} else if (empty ( $cpf )) {
		echo "<script>alert('Preencha seu cpf');history.back();</script>";
		exit;

	} else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		echo "<script>alert('Preencha o e-mail');history.back();</script>";
		exit;

	} else if ( ( empty ( $senha ) ) and ( empty($id) ) ){
		echo "<script>alert('Preencha a senha');history.back();</script>";
		exit;

	} else if (empty ( $cidade_id )) {
		echo "<script>alert('Preencha sua cidade');history.back();</script>";
		exit;

	} else {

		
		if ( empty ($id) ) {

			$resultado = $clienteC->verificaRegistro();

			foreach ($resultado as $key) {
				if ($key->cpf == $cpf) {
					echo "<script>alert('Este cpf ja esta cadastrado!');history.back();</script>";
					exit;
				}
			}

			$senha = password_hash($senha, PASSWORD_DEFAULT);

			if ($clienteC->inserirCliente($nome, $cpf, $rg, $endereco, $celular, $email, $senha, $whatsapp, $sexo, $dtNascimento, $cep, $complemento, $bairro, $numero, $cidade_id)) {
				echo "<script>alert('Registro salvo');location.href='../login.php';</script>";
			} else {
				echo "<script>alert('Não foi possivel salvar');</script>";
				exit;
			}//fim  else erro
		} else {

			if ( empty($senha) ) {

				if ($clienteC->editarEmpCliente($id, $nome, $cpf, $rg, $endereco, $celular, $email, $whatsapp, $sexo, $dtNascimento, $cep, $complemento, $bairro, $numero, $cidade_id)) {
					echo "<script>alert('Registro atualizado');location.href='../index.php';</script>";
					exit;

				} 
				} else {

					$senha = password_hash($senha, PASSWORD_DEFAULT);

					if ($clienteC->editarCliente($id, $nome, $cpf, $rg, $endereco, $celular, $email, $senha, $whatsapp, $sexo, $dtNascimento, $cep, $complemento, $bairro, $numero, $cidade_id)) {

						echo "<script>alert('Registro atualizado com senha');location.href='../index.php';</script>";
						exit;

					} else {

						echo "<script>alert('Não foi possivel salvar com senha');</script>";
						exit;

					}//fim  else erro2
			}
		}
	}





 ?>