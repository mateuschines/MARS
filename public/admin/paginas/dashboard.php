<?php 
  if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 

  require '../../../autoload.php';

  use Cliente\Cliente;
  use Produto\Produto;
  use Promocao\Promocao;
  use Carrinho\Carrinho;

    $clienteC = new Cliente();
    $produtoP = new Produto();
    $promocaoPr = new Promocao();
    $carrinhoC = new Carrinho();

    $totalClientes = $clienteC->totalClientes();
    $totalProduto = $produtoP->totalProduto();
    $totalPromocao = $promocaoPr->totalPromocao($_SESSION["sistema"]["mercado"]);
    $totalVendas = $carrinhoC->totalVendas($_SESSION["sistema"]["mercado"]);


?>

<!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-user"></i></div>
                <div class="name"><strong class="text-uppercase">Total de Clientes</strong>
                  <div class="count-number"><?=$totalClientes[0];?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Total de Produtos</strong>
                  <div class="count-number"><?=$totalProduto[0];?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-3 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Total de Vendas no site</strong>
                  <div class="count-number"><?=$totalVendas[0];?></div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-3 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Total de Promoções no Site</strong>
                  <div class="count-number"><?=$totalPromocao[0];?></div>
                </div>
              </div>
            </div>
            
            
          </div>
        </div>
      </section>














      
      <!-- Header Section-->
      <section class=" bg-white " style="padding: 160px">
        
      </section>
