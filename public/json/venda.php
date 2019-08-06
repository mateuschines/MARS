<?php 
	//para definir cabecario do arquivo que é do tipo json
	header("Content-Type:application/json");
	//incluir arquivo do banco
	require '../../autoload.php';

    if (isset($_GET["venda"])) {
		$venda = trim ($_GET["venda"]);
	}

	use Carrinho\Carrinho;

    $carrinhoCar = new Carrinho();

	$consulta = $carrinhoCar->buscaCarrinho($venda);
	

	$total = 0;
	foreach ($consulta as $p) {
		$somaProduto = $p->valor * $p->quantidade; 

		$prod[] = array("idCarrinho"=>$p->idCarrinho,
							"dataCompra"=>$p->data,
							"cliente_id"=>$p->cliente_id,
							"mercado_id"=>$p->mercado_id,
							"carrinho_id"=>$p->carrinho_id,
							"quantidade"=>$p->quantidade,
							"valor"=>$p->valor,
							"nome"=>$p->nome,
							"idProduto"=>$p->idProduto,
							"codigoDeBarra"=>$p->codigoDeBarra,
							"descricao"=>$p->descricao,
							"somaProduto"=>$somaProduto
							
							
							);
	}
	//array_push($prod[], "total"->$total);

	echo json_encode($prod);