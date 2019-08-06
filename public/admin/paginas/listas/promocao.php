 <?php
    if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    }                   
    require '../../../autoload.php';

    use Promocao\Promocao;

    $promocaoP = new Promocao();
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
      <li class="breadcrumb-item active">Promocao</li>
    </ul>
  </div>
</div>

<section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Promoções</h1>
          </header>
          <div class="card">
            <div class="card-header">
              <?php
                if($_SESSION["sistema"]["tipo"] == "Master") {
                  echo "<a class='btn btn-success' href='home.php?op=cadastro&pg=promocao'>Cadastrar Novo <i class='fa fa-plus'></i>
                  </a>";
                } else {
                  echo "<a class='btn btn-success' href='homeA.php?op=cadastro&pg=promocao'>Cadastrar Novo <i class='fa fa-plus'></i>
                  </a>";
                }
              ?>
              <?php
                if($_SESSION["sistema"]["tipo"] == "Master") {
                  echo "<a class='btn btn-warning' href='home.php?op=listas&pg=promocaoAnterior'>Promoções Anteriores
                  </a>";
                } else {
                  echo "<a class='btn btn-warning' href='homeA.php?op=listas&pg=promocaoAnterior'>Promoções Anteriores
                  </a>";
                }
              ?>
                
            </div>
            <div class="card-body">
              <div class="row">
                
              </div>
              <div class="table-responsive">
                
                <table id="datatable1" style="width: 100%;" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable1_info">
                  <thead>
                    <tr>
                      <th>Produto</th>
                      <th>Preço</th>
                      <th>Data Inicial</th>
                      <th>Data Final</th>
                      <th>Alterar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
 
                    $dados = $promocaoP->listarPromocaoAdmin($_SESSION["sistema"]["mercado"]);
                  

                  if($dados){
                    foreach ($dados as $key) {

                      $id = $key->id;
                      $nomeProduto = $key->nomeProduto;

                      //formatar valor br
                      $preco = number_format($key->preco, 2, ",", ".");

                      if($_SESSION["sistema"]["tipo"] == "Master") {
                        echo "<tr>
                              <td>$key->nomeProduto</td>
                              <td>$preco</td>
                              <td>$key->dataI</td>
                              <td>$key->dataF</td>
                              <td>
                                <a href='home.php?op=cadastro&pg=promocao&id=$key->id' class='btn btn-info'>
                                <i class='fa fa-pencil'></i></a>

                                <a href=\"javascript:excluir($id,'$nomeProduto')\" class='btn btn-danger'>
                                  <i class='fa fa-trash'></i>
                                </a>

                                </td>
                            </tr>";
                      } else {
                        echo "<tr>
                              <td>$key->nomeProduto</td>
                              <td>$preco</td>
                              <td>$key->dataI</td>
                              <td>$key->dataF</td>
                              <td>
                                <a href='homeA.php?op=cadastro&pg=promocao&id=$key->id' class='btn btn-info'>
                                <i class='fa fa-pencil'></i></a>

                                <a href=\"javascript:excluir($id,'$nomeProduto')\" class='btn btn-danger'>
                                  <i class='fa fa-trash'></i>
                                </a>

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
      if ( confirm( "Deseja realmente excluir a Promoção de "+nome+" ? ") ) {
        //mandar excluir
        link = "home.php?pg=promocao&op=excluir&id="+id;
        //chamar o link
        location.href = link;
      }
    }
  </script>
