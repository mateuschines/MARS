<?php
	//verifica se existe a variavel $pagina
	//$pagina esta sendo configurada no home.php
	if ( !isset ( $pagina ) ) {
		echo "Acesso negado";
		exit;
	}

    require '../../../autoload.php';

    use Mercado\Mercado;

    $mercadoM = new Mercado();

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

	//se tiver produto nao pode excluir categoria
	use Promocao\Promocao;

    $promocaoP = new Promocao();

    $dados = $promocaoP->buscaPPromocao($id);

    if ( !empty( $dados->id ) ) {
		echo "<script>alert('Este mercado não pode ser excluido pois existe produtos em promocão!');history.back();</script>";
		exit;
	}

	use Usuario\Usuario;

    $usuarioU = new Usuario();

    $dadosU = $usuarioU->buscaUUsuario($id);

    if ( !empty( $dadosU->id ) ) {
		echo "<script>alert('Este mercado não pode ser excluida pois existe Usuario!');history.back();</script>";
		exit;
	}

	if ($mercadoM->deletarMercado($id)) {
		echo "<script>alert('Registro Excluído');location.href='homeA.php?op=listas&pg=mercado';</script>";
		exit;
	} else {

		echo "<script>alert('Não foi possivel Excluir');</script>";
		exit;
	}

