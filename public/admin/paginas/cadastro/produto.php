<?php 


  if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 
  require '../../../autoload.php';

  use Produto\Produto;

  $produtoP = new Produto();

  $id = $nome = $codigoDeBarra = $preco = $foto = $categoria_id = $descricao = "";

  if ( isset ( $_GET["id"] ) ) {
    $dados = $produtoP->buscaProduto($_GET["id"]);

  if ( !empty ( $dados->id ) ) {
      $id = $dados->id;
      $nome = $dados->nome;
      $codigoDeBarra = $dados->codigoDeBarra;
      $preco = $dados->preco;
      $foto = $dados->foto;
      $categoria_id = $dados->categoria_id;
      $descricao = $dados->descricao;

      //formatar valor br
      $preco = number_format($preco, 2, ",", ".");
      
    }


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
            <li class="breadcrumb-item active">Produto</li>
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
                  <h4>Cadastro de Produto</h4>
                </div>
                <div class="card-body">
                  <form name="form1" action="home.php?op=salvar&pg=produto" method="post" data-parsley-validate enctype="multipart/form-data">

                    <input type="text" name="id" class="form-control" style="display: none;" readonly value="<?=$id;?>">
                    <div class="form-group">
                      <label for="nome">Nome</label>
                      <input type="text" name="nome" placeholder="Digite o nome do Produto" class="form-control" required data-parsley-required-message="<script>alert('Preencha o nome do Produto');</script>" value="<?=$nome;?>">
                    </div>
                    <div class="form-group">
                      <label for="preco">Preço Sugerido</label>
                      <input type="text" name="preco" id="preco" class="form-control" required data-parsley-required-message="<script>alert('Digite o preço do produto');</script>" value="<?=$preco;?>">
                    </div>

                    <div class="form-group">
                    <div id="divida"></div>
                      <label for="codigoDeBarra">Codigo de Barra</label>
                      <input type="text" name="codigoDeBarra" id="codigoDeBarra" placeholder="Numero do Codigo de Barra" class="form-control" required data-parsley-required-message="<script>alert('Preencha o Codigo de Barra');</script>" value="<?=$codigoDeBarra;?>">
                      <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-warning"> <span class="d-none d-sm-inline-block">Leitor de Codigo De Barra </span><i class="fa fa-camera"></i></button>
                    
                      
                    
                    </div>
                    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 id="exampleModalLabel" class="modal-title"></h5>
                              <button type="button" id="butao" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                <script src="../arquivos/barcode/CarregarBarcode.js"></script>
                                <div id="barcode">
                                  <video id="barcodevideo" autoplay></video>
                                  <canvas id="barcodecanvasg" ></canvas>
                                </div>
                                <canvas id="barcodecanvas" ></canvas>
                                <div id="codigo"></div>
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="form-group">
                      <label for="categoria_id">Categoria</label>
                      <select name="categoria_id" id="categoria_id" class="form-control" required>
                        <option value="">Escolha a categoria</option>
                        <?php 

                          use Categoria\Categoria;

                          $categoriaC = new Categoria();

                          $dados = $categoriaC->listarCategoria();

                          foreach ($dados as $key) {
                            echo "<option value=\"$key->id\">$key->nomeCategoria </option>";
                            }
                         ?>
                        </select>
                      </div>
                        <script type="text/javascript">
                          $("#categoria_id").val("<?=$categoria_id;?>")
                        </script>
                    <?php
                      $r = " required
                    data-parsley-required-message=\"Por favor, seleciona uma imagem JPG\" ";

                      if ( !empty($foto) ) $r = "";

                    ?>

                    <label for="foto">Selecione uma Imagem</label>
                    <input type="file" name="foto" class="form-control" <?=$r;?> accept="image/jpeg">
                    <br>
                    <?php
                      //verificar se existe foto - mostrar a foto na tela
                      if ( !empty ( $foto ) ) {
                        $fotop = "../imagesProdutos/".$foto."p.jpg";
                        echo "<img src='$fotop' class='img-thumbnail' width='100px'><br>";
                      }
                    ?>
                    <div class="form-group">
                      <label for="descricao">Descrição do Produto</label>
                      <textarea name="descricao" id="descricao" 
                      class="form-control" 
                      required data-parsley-required-message="Digite a descrição do produto" rows="5"><?php echo $descricao; ?></textarea>
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
    //adicionar o summernote ao descricao
    $(document).ready(function(){//document.ready é para carregar apenas na hora que carregar toda a pagina
      
      //adicionar a mascara ao campo
      $("#preco").maskMoney({
        thousands: '.',
        decimal:','
      });

    })
  </script>