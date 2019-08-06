<?php 
  if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 

   require '../../../autoload.php';
   use Categoria\Categoria;

   $CategoriaC = new Categoria();

   $id = $nomeCategoria = "";

   if ( isset ( $_GET["id"] ) ) {
    $dados = $CategoriaC->buscaCategoria($_GET["id"]);

   if ( !empty ( $dados->id ) ) {
      $id = $dados->id;
      $nomeCategoria = $dados->nomeCategoria;
      
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
            <li class="breadcrumb-item active">Categoria</li>
          </ul>
        </div>
      </div>
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Cadastro de Categoria de Produtos</h4>
                </div>
                <div class="card-body">
                  <form name="form1" action="home.php?op=salvar&pg=categoria" method="post" data-parsley-validate>
                    <input type="text" name="id" class="form-control d-none" readonly value="<?=$id;?>">
                      <div class="form-group">
                      <label for="nomeCategoria">Nome</label>
                        <input type="text" name="nomeCategoria" placeholder="Digite o nome da Categoria" class="form-control" required data-parsley-required-message="<script>alert('Preencha o Nome');</script>" value="<?=$nomeCategoria;?>" >
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </header>
        </div>
      </section>