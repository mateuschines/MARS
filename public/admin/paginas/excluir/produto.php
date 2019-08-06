<?php
	//verifica se existe a variavel $pagina
	//$pagina esta sendo configurada no home.php
	if ( !isset ( $pagina ) ) {
		echo "Acesso negado";
		exit;
	}

    require '../../../autoload.php';

    use Produto\Produto;


	//incluir o arquivo da imagem
	include "../app/imagem.php";

    $produtoP = new Produto();

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

	/*VER COMO SE PODE EXCLUIR PRODUTO SE ELE NAO ESTA EM PROMOÇAÕ*/
	//se tiver produto nao pode excluir produto
	use Promocao\Promocao;

    $promocaoP = new Promocao();

    $dados = $promocaoP->verificaProduto($id);

    if ( !empty( $dados->id ) ) {
		echo "<script>alert('Este produto não pode ser excluido pois existe uma promocão!');history.back();</script>";
		exit;
	}

	/*Quando excluir excluir as fotos cadastradas*/
	$dadosFoto = $produtoP->buscaProduto($id);
	$nomeFoto = "";
	if (!empty($dadosFoto->foto)) {
		$nomeFoto = $dadosFoto->foto;
	}
	

	if ($produtoP->deletarProduto($id)) {
		//excluir as fotos
		//24 ->24p.jpg
		$fotop = "../imagesProdutos/".$nomeFoto."p.jpg";
		apagarFotos($fotop);

		$fotom = "../imagesProdutos/".$nomeFoto."m.jpg";
		apagarFotos($fotom);

		$fotog = "../imagesProdutos/".$nomeFoto."g.jpg";
		apagarFotos($fotog);

		$fotosite = "../imagesProdutos/".$nomeFoto."site.jpg";
		apagarFotos($fotosite);

		if($_SESSION["sistema"]["tipo"] == "Master") {
			echo "<script>alert('Registro Excluído');location.href='home.php?op=listas&pg=produto';</script>";
			exit;
		  } else {
			echo "<script>alert('Registro Excluído');location.href='homeA.php?op=listas&pg=produto';</script>";
			exit;
		  }
		
	} else {

		echo "<script>alert('Não foi possivel Excluir');</script>";
		exit;
	}

