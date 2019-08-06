<?php
	//verifica se existe a variavel $pagina
	//$pagina esta sendo configurada no home.php
	if ( !isset ( $pagina ) ) {
		echo "Acesso negado";
		exit;
	}

    require '../../../autoload.php';

    use Usuario\Usuario;

    $usuarioU = new Usuario();

	//recuperar o id
	$id = "";
	if ( isset ( $_GET["id"] ) ) {
		$id = trim ( $_GET["id"] );
	}

	//verificar se o id esta em branco ou se é inválido
	$id = (int)$id;
	if ($id == 0) {
		//mensagem de erro
		echo "<script>alert('Requisição inválida');history.back();</script>";
		//alert - mostra uma mensagem na tela
		//history.back() - volta a tela anterior
		exit;
	}

	//se tiver mercado lidado a usuario******* TOdos Estao pois se não nao cria*********

	//verificacao de usuario

	$dadosU = $usuarioU->buscaUsuario($id);

	if ($dadosU->id == $_SESSION["sistema"]["id"]) {
		echo "<script>alert('Este usuario não pode ser excluído pois este usuario é admin!');history.back();</script>";
		exit;
	}

	if ($dadosU->tipo == "Admin") {
		echo "<script>alert('Este usuario não pode ser excluído pois este usuario é admin!');history.back();</script>";
		exit;
	}

	if ($_SESSION["sistema"]["tipo"] == "Funcionario") {
		echo "<script>alert('Voçê não tem permissao para excluir!');history.back();</script>";
		exit;
	}

	if ($dadosU->id == 1) {
		echo "<script>alert('Este usuario não pode ser excluído este usuario é seu admin');history.back();</script>";
		exit;
	}

	//deletando usuario

	if ($usuarioU->deletarUsuario($id)) {
		echo "<script>alert('Registro Excluído');location.href='homeA.php?op=listas&pg=usuario';</script>";
		exit;
	} else {

		echo "<script>alert('Não foi possivel Excluir');</script>";
		exit;
	}

