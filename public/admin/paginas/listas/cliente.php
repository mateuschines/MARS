 <?php
    if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    }                   
    require '../../../autoload.php';

    use Cliente\Cliente;

    $clienteC = new Cliente();
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
      <li class="breadcrumb-item active">Cliente</li>
    </ul>
  </div>
</div>

<section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Cliente</h1>
          </header>
          <div class="card">
            <div class="card-header">
            <?php
              if($_SESSION["sistema"]["tipo"] == "Master") {
                echo "<a class='btn btn-success' href='home.php?op=cadastro&pg=cliente'>Cadastrar Novo <i class='fa fa-plus'></i>
                </a>";
              } else {
                echo "<a class='btn btn-success' href='homeA.php?op=cadastro&pg=cliente'>Cadastrar Novo <i class='fa fa-plus'></i>
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
                      <th>Nome</th>
                      <th>Endereco</th>
                      <th>Celular</th>
                      <th>Alterar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                  
                    $dados = $clienteC->listarClientes();
                  

                  if($dados){
                    foreach ($dados as $key) {

                      $id = $key->id;
                      $nome = $key->nome;
                      
                        if($_SESSION["sistema"]["tipo"] == "Master") {
                          echo "<tr>
                              <td>$key->nome</td>
                              <td>$key->endereco</td>
                              <td>$key->celular</td>
                              <td>
                                <a href='home.php?op=cadastro&pg=cliente&id=$key->id' class='btn btn-info'>
                                <i class='fa fa-pencil'></i></a>

                                <a href=\"javascript:excluir($id,'$nome')\" class='btn btn-danger'>
                                  <i class='fa fa-trash'></i>
                                </a>

                                </td>
                            </tr>";
                        } else {
                          echo "<tr>
                              <td>$key->nome</td>
                              <td>$key->endereco</td>
                              <td>$key->celular</td>
                              <td>
                                <a href='homeA.php?op=cadastro&pg=cliente&id=$key->id' class='btn btn-info'>
                                <i class='fa fa-pencil'></i></a>

                                <a href=\"javascript:excluir($id,'$nome')\" class='btn btn-danger'>
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
      if ( confirm( "Deseja realmente excluir "+nome+" ? ") ) {
        //mandar excluir
        link = "home.php?pg=cliente&op=excluir&id="+id;
        //chamar o link
        location.href = link;
      }
    }
  </script>
