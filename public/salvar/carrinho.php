<?php
    //echo $_POST['quantidade'];exit;
   
    if(!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION["site"]["id"])){
        echo "1|Você precisa estar logado no sistema!";
        exit;
        
    }
    require '../../autoload.php';

    //Carrinho: id, dataCompra, mercado_id
    $cliente_id = $_SESSION["site"]["id"];
    $apelido = $_POST['mercado'];

    use Mercado\Mercado;

    $mercadou = new Mercado();

    $mercado_id = $mercadou->buscaMercadoApelido($apelido);

    

    $dataCompra = date("Y-m-d");

    use Carrinho\Carrinho;

    $carrinhoCar = new Carrinho();

    $carrinho = json_decode($_POST['data'], true);

    $result = $carrinhoCar->inserirCarrinho($cliente_id, $mercado_id->id);
    $venda = $result["id"];
    echo "1|mateus";

    use Carrinho_produto\Carrinho_produto;

    $carrinho_produto = new Carrinho_produto();

    foreach($carrinho as $value) {
        //print_r($value);
      $id = $value["id"]; 
      //echo "-------\n";
       
      //Formatando US
      $preco = str_replace(".", "", $value["preco"]);
      //2.000,00 -> 2000,00
      $preco = str_replace(",",".", $preco);

      //echo $preco;echo "---uiuiui----\n";
      //2000,00 -> 2000.00
      $qtde = $value["qtde"];
      if ($qtde <= 0) {
        echo "1|Sua Quantidade é invalida!";
        exit;
      }

      $carrinho_produto->inserirCarrinho_produto($result["id"], $id, $qtde, $preco);
      // echo "---Produto inserido----\n";
    }
    
    echo "0|$venda";


    
    
