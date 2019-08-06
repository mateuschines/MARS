<?php 
	//para definir cabecario do arquivo que é do tipo json
	header("Content-Type:application/json");
	//incluir arquivo do banco
	require '../../autoload.php';

	use Produto\Produto;

	$produtoP = new Produto();

	$op = $mercado = "";
	if (isset($_GET["op"])) {
		$op = trim ($_GET["op"]);
	}
	if (isset($_GET["mercado"])) {
		$mercado = trim ($_GET["mercado"]);
	}

	//op = produto, categoria

	if ($op == "produto") {
		//produto especifico
		$id = trim ( $_GET["id"]);

		$consulta = $produtoP->jsonListarProduto($id,$mercado);

	} else if ($op == "categoria") {

		$id = trim ( $_GET["id"]);
		//produtos de uma categoria
		
		$consulta = $produtoP->jsonListarCategoriaPromo($id,$mercado);

	} else {
		//produtos da pagina inicial
		$consulta = $produtoP->jsonListarAll($mercado);
	}

	if ($op == "produto") {
		foreach ($consulta as $p) {
			$preco = number_format($p->preco,2,",",".");
			$fotop = "admin/imagesProdutos/".$p->foto."site.jpg";
			$fotog = "admin/imagesProdutos/".$p->foto."p.jpg";
			
			$prod[] = array("id"=>$p->id,
								"nome"=>$p->nome,
								"descricao"=>$p->descricao,
								"dataFinal"=>$p->dataFinal,
								"preco"=>$preco,
								"fotop"=>$fotop,
								"fotog"=>$fotog,
								"categoria_id"=>$p->categoria_id,
								"categoria"=>$p->nomeCategoria 
								);
		}
	} else {

		foreach ($consulta as $p) {
			$preco = number_format($p->preco,2,",",".");
			$fotop = "admin/imagesProdutos/".$p->foto."site.jpg";
			$fotog = "admin/imagesProdutos/".$p->foto."p.jpg";
			
			$prod[] = array("id"=>$p->id,
								"nome"=>$p->nome,
								"descricao"=>$p->descricao,
								"preco"=>$preco,
								"fotop"=>$fotop,
								"fotog"=>$fotog,
								"categoria_id"=>$p->categoria_id,
								"categoria"=>$p->nomeCategoria 
								);
		}
	}

	echo json_encode($prod);
	