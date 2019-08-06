 <?php
    if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    }                   
    require '../../../autoload.php';

    use Cidade\Cidade;

    $cidadeC = new Cidade();

?>

 <!-- Breadcrumb-->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="home.php">Home</a></li>
      <li class="breadcrumb-item active">Cidade</li>
    </ul>
  </div>
</div>

<section>
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Cidade</h1>
          </header>
          <div class="card">
            <div class="card-body">
              <div class="row">
                
              </div>
              <div class="table-responsive">
                
                <table id="datatable1" style="width: 100%;" class="table dataTable no-footer table-hover" role="grid" aria-describedby="datatable1_info">
                  <thead>
                    <tr>
                      <th>Estado</th>
                      <th>Cidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $dados = $cidadeC->listarCidades();
                          
                          if($dados){
                            foreach ($dados as $key) {
                              echo "<tr>
                                      <td>$key->estado</td>
                                      <td>$key->nome</td>
                                    </tr>";
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