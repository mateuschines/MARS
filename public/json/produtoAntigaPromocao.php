<?php 
	//para definir cabecario do arquivo que é do tipo json
	header("Content-Type:application/json");
	//incluir arquivo do banco
	require '../../autoload.php';

	use Produto\Produto;

	$produtoP = new Produto();


    if (isset($_GET["mercado"])) {
        $mercado = trim ($_GET["mercado"]);
    }

    $id = trim ( $_GET["id"]);

    $consulta = $produtoP->jsonListarProdutoPromocaoPassada($id,$mercado);

    foreach ($consulta as $p) {
            $preco = number_format($p->preco,2,",",".");
            
            $prod[] = array("id"=>$p->id,
                                "nome"=>$p->nome,
                                "descricao"=>$p->descricao,
                                "preco"=>$preco,
                                "codigoDeBarra"=>$p->codigoDeBarra,
                                "dataInicial"=>$p->dataInicial,
                                "dataFinal"=>$p->dataFinal,
                                "categoria_id"=>$p->categoria_id,
                                "categoria"=>$p->nomeCategoria 
                                );
    }

    echo json_encode($prod);