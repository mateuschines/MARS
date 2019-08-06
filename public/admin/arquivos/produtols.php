<?php
	
	require '../../../autoload.php';

	use Produto\Produto;

	$produto = new Produto();

	$rest = $produto->listarProduto();

	$prod[] = array("id"=>"","nome"=>"","preco"=>"");

	foreach ($rest as $p) {
		$prod[] = array("id"=>$p->id,"nome"=>$p->nome." - R$ ".number_format($p->preco,2,",","."));
	}

	echo json_encode($prod);