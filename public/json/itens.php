<?php 
	//para definir cabecario do arquivo que é do tipo json
	header("Content-Type:application/json");
	//incluir arquivo do banco
	require '../../autoload.php';

	use Carrinho_produto\Carrinho_produto;
	
	$carrinho = new Carrinho_produto();
    
	if (isset($_GET["venda"])) {
		$venda = trim ($_GET["venda"]);
	}

	$consulta = $carrinho->buscaVenda($venda);

	foreach ($consulta as $p) {
		
		$prod[] = array("id"=>$p->id,
							"carrinho_id"=>$p->carrinho_id,
							"quantidade"=>$p->quantidade,
							"valor"=>$p->valor,
							"nome"=>$p->nome,
							"id"=>$p->id,
							"codigoDeBarra"=>$p->codigoDeBarra,
							"descricao"=>$p->descricao 
							);
	}

	echo json_encode($prod);