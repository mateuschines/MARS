<?php 
	if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 

	require '../../../autoload.php';

	use Cidade\Cidade;

	$cidadeC = new Cidade();

	$id = $nome = $estado = "";

	if (isset ( $_POST["id"])) {
		$id = trim ($_POST["id"]);
	}

	if (isset ( $_POST["nome"])) {
		$nome = trim ($_POST["nome"]);
	}

	if (isset ( $_POST["estado"])) {
		$estado = trim ($_POST["estado"]);
	}

	if (empty ( $nome )) {
		echo "<script>alert('Preencha o nome');history.back();</script>";
		exit;

	} else if (empty ( $estado )) {
		echo "<script>alert('Preencha seu estado');history.back();</script>";
		exit;

	} else {

		$resultado = $cidadeC->verificaRegistro();

		foreach ($resultado as $key) {
			if ($key->estado == $estado && $key->nome == $nome) {
				echo "<script>alert('Esta cidade ja esta cadastrada!');history.back();</script>";
				exit;
			}
		}
		
		if ( empty ($id) ) {
			if ($cidadeC->inserirCidade($nome, $estado)) {
				echo "<script>alert('Registro salvo');location.href='home.php?op=listas&pg=cidade';</script>";
			} else {

			$erro = $consulta->errorInfo()[2];
			
			echo "$erro";
			echo "<script>alert('Não foi possivel salvar');</script>";
			exit;
			}//fim  else erro
		} else {

			if ($cidadeC->editarCidade($id, $nome, $estado)) {
				echo "<script>alert('Registro salvo');location.href='home.php?op=listas&pg=cidade';</script>";

			} else {

			$erro = $consulta->errorInfo()[2];
			
			echo "$erro";
			echo "<script>alert('Não foi possivel salvar');</script>";
			exit;

			}//fim  else erro
		}
	}






 ?>