<?php
	
	require '../../../autoload.php';

	use Promocao\Promocao;

	$produto = new Promocao();

	$rest = $produto->listarPromocaoSite();

	$prod[] = array("id"=>"","nome"=>"","preco"=>"");

	foreach ($rest as $p) {
		$prod[] = array("id"=>$p->produto_id,"nome"=>$p->nomeProduto);
	}

	echo json_encode($prod);