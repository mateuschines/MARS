<?php
	//verifica se existe a variavel $pagina
	//$pagina esta sendo configurada no home.php
	if ( !isset ( $pagina ) ) {
		echo "Acesso negado";
		exit;
	}

    require '../../../autoload.php';

    use Cliente\Cliente;

    $clienteC = new Cliente();

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


	if ($clienteC->deletarCliente($id)) {
		
        if($_SESSION["sistema"]["tipo"] == "Master") {
			echo "<script>alert('Registro Excluído');location.href='home.php?op=listas&pg=cliente';</script>";
			exit;
        } else {
			echo "<script>alert('Registro Excluído');location.href='homeA.php?op=listas&pg=cliente';</script>";
			exit;
        }
		
	} else {

		echo "<script>alert('Não foi possivel Excluir');</script>";
		exit;
	}

