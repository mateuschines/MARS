<?php
    if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    }                   
    require '../../../autoload.php';

    $mercado_id = "";

    if (isset ( $_SESSION["sistema"]["mercado"])) {
      $mercado_id = $_SESSION["sistema"]["mercado"];
    }

    use Carrinho\Carrinho;

    $carrinhoC = new Carrinho();
?>

 <!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item">
      <?php
        if($_SESSION["sistema"]["tipo"] == "Master") {
          echo "<a href='home.php'>Home</a>";
        } else {
          echo "<a href='homeA.php'>Home</a>";
        }
      ?>
      </li>
      <li class="breadcrumb-item active">Produtos Vendidos</li>
    </ul>
  </div>
</div>

<section>
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
            <div class="card-body">
              <h1>Produtos Vendidos</h1>
            <form name="form1" action="gerarRelatorio/produtosVendidosClientes.php" target="_blank" method="post" data-parsley-validate>
            <div class="row">
            <div class="col-3">
                <label class="form-control-label">Data Inicial</label>
                <input id="dataInicial" autocomplete="off" type="text" name="dataInicial" placeholder="Digite sua data" class="form-control" required data-parsley-required-message="Preencha a data de Inicio">
              </div>
              <div class="col-3">
                <label class="form-control-label">Data Final</label>
                <input id="dataFinal" autocomplete="off" type="text" name="dataFinal" placeholder="Digite sua data" class="form-control" required data-parsley-required-message="Preencha a data Final">
              </div>
                <?php
                  if($_SESSION["sistema"]["tipo"] == "Master") {
                      echo "<div class='col-2'>
                                <button type='submit' class='btn btn-info relatorio'> Relatorio</button>
                              </div>";
                  } else {
                      echo "<div class='col-2'>
                      <button type='submit' class='btn btn-info relatorio'> Relatorio</button>
                              </div>";
                  }
                  ?>
                  </div>
            </form>
 
            
              <div class="row">
                <br>
              </div>
              <div class="table-responsive">
                
                <table id="datatable1" style="width: 100%;" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable1_info">
                  <thead>
                    <tr>
                      <th>Data da Compra</th>
                      <th>Nome do Cliente</th>
                      <th>Preço total da Compra</th>
                      <th>Status da Compra</th>
                      <th>Valor Pago</th>
                      <th>Relatorio</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
 
                    $dados = $carrinhoC->buscaCompraRealizadaPorMercado($mercado_id);
                  
                  if($dados){
                    foreach ($dados as $key) {

                      //formatar valor br
                      $preco = number_format($key->valorTotal, 2, ",", ".");
                      $pago = number_format($key->valorPago, 2, ",", ".");

                      if($_SESSION["sistema"]["tipo"] == "Master") {
                        echo "<tr>
                              <td>$key->data</td>
                              <td>$key->nomeCliente</td>
                              <td>$preco</td>
                              <td>$key->status</td>
                              <td>$pago</td>
                              <td>
                                <a target='_blank' href='GRelatorio/produtosVendidosClientes.php?id=$key->idCarrinho' class='btn btn-info'>
                                <i class='icon-padnote'></i></a>

                                </td>
                            </tr>";
                      } else {
                        echo "<tr>
                              <td>$key->data</td>
                              <td>$key->nomeCliente</td>
                              <td>$preco</td>
                              <td>$key->status</td>
                              <td>$pago</td>
                              <td>
                                <a target='_blank' href='GRelatorio/produtosVendidosClientes.php?id=$key->idCarrinho' class='btn btn-info'>
                                <i class='icon-padnote'></i></a>

                                </td>
                            </tr>";
                      }

                      
                      }
                    } else {
                      echo "<tr>
                              <th scope='row'>#</th>
                              <td>Dados nao encontrados</td>
                            </tr>";
                     }
                    
               ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script type="text/javascript">
    //funcao para perguntar se deseja excluir
    function excluir(id,nome) {
      //pergunta e confirmar
      if ( confirm( "Deseja realmente excluir "+nome+" ? ") ) {
        //mandar excluir
        link = "home.php?pg=produto&op=excluir&id="+id;
        //chamar o link
        location.href = link;
      }
    }
    $('#dataInicial').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR',
        autoclose: true
      });
      $('#dataFinal').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR',
        autoclose: true
      });
  </script>

