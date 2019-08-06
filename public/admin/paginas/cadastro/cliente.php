<?php 
  if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 
  require '../../../autoload.php';
  use Cliente\Cliente;

  $clienteC = new Cliente();

  /*$nome, $cpf, $rg, $endereco, $celular, $email, $senha, $whatsapp, $sexo, $dtNascimento, $cep, $complemento, $bairro, $numero, $cidade_id*/

  $id = $nome = $cpf = $rg = $endereco = $celular = $email = $senha = $whatsapp = $sexo = $dtNascimento = $cep = $complemento = $bairro = $numero = $cidade_id = "";

  if ( isset ( $_GET["id"] ) ) {
    $dados = $clienteC->buscaCliente($_GET["id"]);

  if ( !empty ( $dados->id ) ) {
      $id = $dados->id;
      $nome = $dados->nome;
      $cpf = $dados->cpf;
      $rg = $dados->rg;
      $endereco = $dados->endereco;
      $celular = $dados->celular;
      $email = $dados->email;
      $senha = $dados->senha;
      $whatsapp = $dados->whatsapp;
      $sexo = $dados->sexo;
      $dtNascimento = $dados->data;
      $cep = $dados->cep;
      $complemento = $dados->complemento;
      $bairro = $dados->bairro;
      $numero = $dados->numero;
      $cidade_id = $dados->cidade_id;
      $cidade_idd = $dados->nomeCidade;
      
    }  

  }



 ?>

 <!-- Breadcrumb-->
 <style>
  input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
 </style>
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
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Cadastro de Cliente</h4>
                </div>
                <div class="card-body">
                  <form name="form1" action="home.php?op=salvar&pg=cliente" method="post" data-parsley-validate>
                    <input type="text" name="id" class="form-control" style="display: none;" readonly value="<?=$id;?>">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" name="nome" placeholder="Digite o nome do Cliente" class="form-control" required data-parsley-required-message="<script>alert('Preencha o nome do Cliente');</script>" value="<?=$nome;?>">
                    </div>
                    <div class="form-group">
                      <label>CPF</label>
                      <input type="text" name="cpf" placeholder="Digite o CPF do Cliente" class="form-control" required data-parsley-required-message="<script>alert('Preencha o CPF do Cliente');</script>" data-mask="999.999.999-99" value="<?=$cpf;?>">
                    </div>
                    <div class="form-group">
                      <label>RG</label>
                      <input type="number" name="rg" placeholder="Digite o RG do Cliente" class="form-control" required data-parsley-required-message="<script>alert('Preencha o RG do Cliente');</script>" value="<?=$rg;?>">
                    </div>

                    <div class="form-group">
                      <label class="form-control-label">Data Nascimento</label>
                        <input id="dtNascimento" type="text" name="dtNascimento" placeholder="Digite sua data de nascimento" class="form-control" required data-parsley-required-message="<script>alert('Preencha sua data de nascimento');</script>" value="<?=$dtNascimento;?>">
                    </div>

                    <div class="form-group">
                      <label for="sexo">Gênero</label>
                      <select name="sexo" id="sexo" class="form-control" required data-parsley-required-message="Selecione seu sexo">
                      <option value="">--Escolha a Opção--</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Feminino">Feminino</option>
                      <option value="Outro">Outros</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="cep">Cep</label>
                      <input type="text" name="cep" placeholder="Digite o Cep" class="form-control" required data-parsley-required-message="<script>alert('Preencha o Cep');</script>" data-mask="99-999-999" value="<?=$cep;?>">
                    </div>

                    <div class="control-group">
                      <label for="cidade_idd">Cidade</label>
                      <input name="cidade_idd" id="cidade_idd" class="form-control">
                    </div>

                   <div class="control-group d-none">
                      <label for="cidade_id">Cidade Auxiliar</label>
                      <input name="cidade_id" id="cidade_id" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>Endereço</label>
                      <input type="text" name="endereco" placeholder="Digite o endereço do Cliente" class="form-control" required data-parsley-required-message="<script>alert('Preencha o endereço do Cliente');</script>" value="<?=$endereco;?>">
                    </div>
                    <div class="form-group">
                      <label>Numero</label>
                      <input type="text" name="numero" placeholder="Digite o Numero da casa" class="form-control" maxlength="5" value="<?=$numero;?>">
                    </div>
                    <div class="form-group">
                      <label for="complemento">Complemento</label>
                      <input type="text" name="complemento" placeholder="Digite o Complemento" class="form-control" value="<?=$complemento;?>">
                    </div>
                    <div class="form-group">
                      <label>Bairro</label>
                      <input type="text" name="bairro" placeholder="Digite o Bairro" class="form-control" value="<?=$bairro;?>">
                    </div>
                    <div class="form-group">
                      <label>Celular</label>
                      <input type="text" name="celular" placeholder="Digite o numero de celular do Cliente" class="form-control" required data-parsley-required-message="<script>alert('Preencha o numero do celular do Cliente');</script>" data-mask="(99) 9999-9999?9" value="<?=$celular;?>">
                    </div>
                    <div class="form-group">
                      <label>WhatsApp</label>
                      <input type="text" name="whatsapp" placeholder="Digite o WhatsApp do Cliente" class="form-control" data-mask="(99) 9999-9999?9" value="<?=$whatsapp;?>">
                    </div>
                    <div class="form-group">
                      <label>E-mail</label>
                      <input type="email" name="email" placeholder="Digite seu email" class="form-control" required data-parsley-required-message="<script>alert('Preencha o e-mail');</script>" value="<?=$email;?>">
                    </div>
                    <div class="form-group">
                      <label>Senha</label>
                      <input type="password" name="senha" placeholder="Digite sua senha" class="form-control" <?php if (empty($email)) echo "required"; ?> data-parsley-required-message="<script>alert('Preencha a senha');</script>">
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

    $("#sexo").val("<?=$sexo;?>");

    $('#dtNascimento').datepicker({
      format: 'dd/mm/yyyy',
      language: 'pt-BR',
      autoclose: true
    });

      var options = {
        url: "../arquivos/cidades.json",

        getValue: "nome",

        template: {
            type: "description",
            fields: {
                description: "estado"
            }
        },

        list: {
          match: {
            enabled: true
          },
            maxNumberOfElements: 5,

            onSelectItemEvent: function() {
                var selectedItemValue = $("#cidade_idd").getSelectedItemData().id;

                $("#cidade_id").val(selectedItemValue).trigger("change");
            }
            
          }

      };

      $("#cidade_idd").easyAutocomplete(options);
      //fim autocomplete

      //para carregar os dados
      $("#cidade_id").val("<?=$cidade_id;?>")
  </script>

  <!--Ajuste para funcionar o carregamento da cidade quando for para alterar-->
  <?php 

    if (!empty($cidade_idd)){?>
      <script type="text/javascript">
        $("#cidade_idd").val("<?=$cidade_idd;?>")
      </script>
  <?php }