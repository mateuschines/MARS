<?php 
  if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 

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
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Cadastro de Cidade</h4>
                </div>
                <div class="card-body">
                  <form name="form1" class="form-inline" action="home.php?op=salvar&pg=cidade" method="post" data-parsley-validate>
                    <input type="text" name="id" class="form-control d-none" readonly>
                    <div class="form-group">
                      <label for="inlineFormInputGroup" class="sr-only">Estado</label>
                      <select name="estado" id="inlineFormInputGroup" class="mr-4 form-control form-control" required data-parsley-required-message="<script>alert('Preencha o estado');</script>">
                        <option value="">-- Selecione um estado --</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                        
                      </select>
                      </div>
                      <script type="text/javascript">
                        $("#estado").val("<?=$estado;?>")
                      </script>
                      <div class="form-group">
                        <label for="inlineFormInput" class="sr-only">Nome</label>
                        <input id="inlineFormInput" name="nome" type="text" placeholder="Ex: Pérola" class="mr-4 form-control" required data-parsley-required-message="<script>alert('Preencha a cidade');</script>">
                      </div>
                    <div class="form-group">
                      <button type="submit" class="mr-3 btn btn-primary">Salvar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </header>
        </div>
      </section>