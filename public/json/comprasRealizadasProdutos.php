<?php

    //para definir cabecario do arquivo que é do tipo json
    header("Content-Type:application/json");
    //incluir arquivo do banco
    require '../../autoload.php';

    use Carrinho\Carrinho;

        $carrinhoC = new Carrinho();

        $id = $mercado = "";
        $prod[] = "";
        $id = trim ( $_GET["id"]);
        //produtos de uma categoria
            
        $consulta = $carrinhoC->buscaCompraRealizadaComProdutos($id);
        
        foreach ($consulta as $p) {
            $valor = number_format($p->valor,2,",",".");
            $fotop = "admin/imagesProdutos/".$p->foto."site.jpg";
            $fotog = "admin/imagesProdutos/".$p->foto."p.jpg";
            $somaProduto = $p->valor * $p->quantidade; 
            
            $prod[] = array("id"=>$p->idCarrinho,
                                "data"=>$p->dataCompra,
                                "nomeCliente"=>$p->nomeCliente,
                                "cliente_id"=>$p->cliente_id,
                                "mercado_id"=>$p->mercado_id,
                                "carrinho_id"=>$p->carrinho_id,
                                "quantidade"=>$p->quantidade,
                                "carrinho_id"=>$p->carrinho_id,
                                "preco"=>$valor,
                                "valor"=>$p->valor,
                                "nome"=>$p->nome,
                                "fotop"=>$fotop,
                                "fotog"=>$fotog,
                                "somaProduto"=>$somaProduto
                                );
        }

        echo json_encode($prod);
	