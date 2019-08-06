<?php 
  if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    }  
  require '../../../autoload.php';

  use Promocao\Promocao;

  $promocaoP = new Promocao();

  $id = $preco = $dataInicial = $dataFinal = $produto_id = $mercado_id = "";

  if ( isset ( $_GET["id"] ) ) {
    $dados = $promocaoP->buscaPromocao($_GET["id"]);

  if ( !empty ( $dados->id ) ) {
      $id = $dados->id;
      $preco = $dados->preco;
      $dataInicial = $dados->dataI;
      $dataFinal = $dados->dataF;
      $produto_idd = $dados->nomeProduto;
      $produto_id = $dados->produto_id;
      $mercado_id = $dados->mercado_id;
      
    }

    //formatando para BR
    $preco = number_format($preco, 2, ',', '.');

  }

  //carregando id do mercado
  if (empty($mercado_id)){
    $mercado_id = $_SESSION["sistema"]["mercado"];
  }


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
            <li class="breadcrumb-item active">Promoção</li>
          </ul>
        </div>
      </div>
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Cadastro de Produtos em Promoção</h4>
                </div>
                <div class="card-body">
                  <form name="form1" action="home.php?op=salvar&pg=promocao" method="post" data-parsley-validate enctype="multipart/form-data">

                    <input type="text" name="id" class="form-control d-none" readonly value="<?=$id;?>">

                    <div class="control-group">
                        <label for="produto_idd">Produto</label>
                        <input name="produto_idd" id="produto_idd" class="form-control">
                      </div>

                    <div class="form-group">
                      <label for="preco">Preço</label>
                      <input type="text" name="preco" id="preco" class="form-control" required data-parsley-required-message="<script>alert('Digite o preço do produto');</script>" value="<?=$preco;?>">
                    </div>

                    <div class="form-group">
                      <label>Data Inicial</label>
                      <input id="dataInicial" type="text" name="dataInicial" placeholder="Digite a data inicial da promoção" class="form-control" required data-parsley-required-message="<script>alert('Preencha a data inicial');</script>" data-mask="99/99/9999" value="<?=$dataInicial;?>">
                    </div>

                    <div class="form-group">
                      <label>Data Final</label>
                      <input id="dataFinal" type="text" name="dataFinal" placeholder="Digite a data final da promoção" class="form-control" required data-parsley-required-message="<script>alert('Preencha a data final');</script>" data-mask="99/99/9999" value="<?=$dataFinal;?>">
                    </div>

                     <div class="control-group d-none">
                        <label for="produto_id">Produto Auxiliar</label>
                        <input name="produto_id" id="produto_id" class="form-control">
                      </div>
                        

                        <div class="form-group">
                          <label for="mercado_id">Mercado</label>
                          <select name="mercado_id" id="mercado_id" class="form-control" required readonly="readonly" tabindex="-1" aria-disabled="true" style="pointer-events: none;, touch-action: none;">
                            <?php 

                              use Mercado\Mercado;

                              $mercadoM = new Mercado();

                              $dados = $mercadoM->buscaMercado($mercado_id);

                             
                              echo "<option selected value=\"$dados->id\">$dados->nome </option>";
                                
                             ?>
                            </select>
                          </div>
                          
                    

                    <div class="form-group">       
                      <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </header>
    </div>
  </section>

  <script type="text/javascript">
    //Funcao para AutoComplete

      var options = {
      url: "../arquivos/produtols.php",

      getValue: "nome",

      list: {
        match: {
          enabled: true
        },
          maxNumberOfElements: 5,

          onSelectItemEvent: function() {
              var selectedItemValue = $("#produto_idd").getSelectedItemData().id;

              $("#produto_id").val(selectedItemValue).trigger("change");
          }
          
        }

    };

    $("#produto_idd").easyAutocomplete(options);
    //fim autocomplete

      $("#produto_id").val("<?=$produto_id;?>");

      $("#mercado_id").val("<?=$mercado_id;?>");

      //adicionar a mascara ao campo
      $("#preco").maskMoney({
        thousands: '.',
        decimal:','
      });

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

  <!--Ajuste para funcionar o carregamento da cidade quando for para alterar-->
  <?php 

    if (!empty($produto_idd)){?>
      <script type="text/javascript">
        $("#produto_idd").val("<?=$produto_idd;?>")
      </script>
  <?php }

?>