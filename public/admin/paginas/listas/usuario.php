 <?php
    if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    }
    if ($_SESSION["sistema"]["tipo"] == "Master"){
      exit;
    }

    require '../../../autoload.php';

    use Usuario\Usuario;

    $usuarioU = new Usuario();
?>

 <!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="homeA.php">Home</a></li>
      <li class="breadcrumb-item active">Usuário</li>
    </ul>
  </div>
</div>

<section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Usuários</h1>
          </header>
          <div class="card">
            <div class="card-header">
                <a class="btn btn-success" href="homeA.php?op=cadastro&pg=usuario">Cadastrar Novo <i class='fa fa-plus'></i>
                </a>
            </div>
            <div class="card-body">
              <div class="row">
                
              </div>
              <div class="table-responsive">
                
                <table id="datatable1" style="width: 100%;" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable1_info">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Login</th>
                      <th>Alterar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if ( isset ( $_POST["busca"]) ) {
                        $busca = trim($_POST["busca"]);

                        $dados = $usuarioU->buscasUsuarios($busca);

                      } else {
                        $dados = $usuarioU->listarUsuarios();
                      }

                      if($dados){
                        foreach ($dados as $key) {

                          $id = $key->id;
                          $nome = $key->nome;
                          echo "<tr>
                                  <td>$key->nome</td>
                                  <td>$key->email</td>
                                  <td>$key->login</td>
                                  <td>
                                    <a href='homeA.php?op=cadastro&pg=usuario&id=$key->id' class='btn btn-success'>
                                    <i class='fa fa-pencil'></i></a>

                                    <a href=\"javascript:excluir($id,'$nome')\" class='btn btn-danger'>
                                      <i class='fa fa-trash'></i>
                                    </a>

                                    </td>
                                </tr>";
                          }
                        } else {
                          echo "<tr>
                                  <td></td>
                                  <td>Dados nao encontrados</td>
                                  <td></td>
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
        link = "homeA.php?pg=usuario&op=excluir&id="+id;
        //chamar o link
        location.href = link;
      }
    }
  </script>
