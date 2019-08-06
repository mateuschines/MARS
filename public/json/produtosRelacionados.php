<?php 
	//para definir cabecario do arquivo que é do tipo json
	header("Content-Type:application/json");
	//incluir arquivo do banco
	require '../../autoload.php';

	use Promocao\Promocao;

	$promocaoP = new Promocao();


    if (isset($_GET["mercado"])) {
        $mercado = trim ($_GET["mercado"]);
    }
    if (isset($_GET["id"])) {
        $idProduto = trim ($_GET["id"]);
    }
    // $prod[] = "";

    $categoria_id = $promocaoP->buscaProdutoParaRelacionados($idProduto);
    
    $consulta = $promocaoP->produtosRelacionados($idProduto,$categoria_id->categoria_id, $mercado);

    foreach ($consulta as $p) {
             $preco = number_format($p->preco,2,",",".");
             $fotop = "admin/imagesProdutos/".$p->foto."site.jpg";
             $fotog = "admin/imagesProdutos/".$p->foto."p.jpg";
            
                $prod[] = array(

                        "id"=>$p->id,
                        "nome"=> $p->nome,
                        "preco"=>$preco,
                        "foto"=>$fotop 
                        );
    }

    echo json_encode($prod);