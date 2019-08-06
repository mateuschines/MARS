<?php

    //para definir cabecario do arquivo que é do tipo json
    header("Content-Type:application/json");
    //incluir arquivo do banco
    require '../../autoload.php';

    use Carrinho\Carrinho;

        $carrinhoC = new Carrinho();

        $id = $mercado = "";
        $id = trim ( $_GET["id"]);
        //produtos de uma categoria
            
        $consulta = $carrinhoC->buscaCompraRealizada($id);
        
        foreach ($consulta as $p) {
            $valorTotal = number_format($p->valorTotal,2,",",".");
            
            $prod[] = array("id"=>$p->idCarrinho,
                                "data"=>$p->data,
                                "cliente_id"=>$p->cliente_id,
                                "mercado_id"=>$p->mercado_id,
                                "carrinho_id"=>$p->carrinho_id,
                                "preco"=>$valorTotal,
                                "nome"=>$p->nome
                                );
        }

        echo json_encode($prod);
	