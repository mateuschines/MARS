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
      <li class="breadcrumb-item active">Relatorio</li>
    </ul>
  </div>
</div>

<section>
    <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h1>Clientes que Mais Compraram no site!</h1>
            <form name="form1" action="gerarRelatorio/clientesMaisComprou.php" target="_blank" method="post" data-parsley-validate>
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
                                <button type='submit' class='btn btn-info relatorio'> Relatorio<i class='fa fa-plus'></i></button>
                              </div>";
                  } else {
                      echo "<div class='col-2'>
                      <button type='submit' class='btn btn-info relatorio'> Relatorio<i class='fa fa-plus'></i></button>
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
                      <th>Nome</th>
                      <th>Endereço</th>
                      <th>Email</th>
                      <th>Celular</th>
                      <th>Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
 
                    $dados = $clienteC->gerarRelatorioClientesMaisCompraramAll($mercado_id);
                  
                  if($dados){
                    foreach ($dados as $key) {

                      //formatar valor br

                      if($_SESSION["sistema"]["tipo"] == "Master") {
                        echo "<tr>
                              <td>$key->nome</td>
                              <td>$key->endereco</td>
                              <td>$key->email</td>
                              <td>$key->celular</td>
                              <td>$key->quantidade</td>
                            </tr>";
                      } else {
                        echo "<tr>
                              <td>$key->nome</td>
                              <td>$key->endereco</td>
                              <td>$key->email</td>
                              <td>$key->celular</td>
                              <td>$key->quantidade</td>
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
        

    <script>
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
