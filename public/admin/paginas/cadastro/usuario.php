<?php 
  if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 
  require '../../../autoload.php';
  use Usuario\Usuario;

  $usuarioU = new Usuario();

  $id = $nome = $ativo = $email = $login = $senha = $mercado_id = $telefone = $cpf = $tipo = "";

  if ( isset ( $_GET["id"] ) ) {
    $dados = $usuarioU->buscaUsuario($_GET["id"]);

  if ( !empty ( $dados->id ) ) {
      $id = $dados->id;
      $nome = $dados->nome;
      $ativo = $dados->ativo;
      $email = $dados->email;
      $login = $dados->login;
      $senha = $dados->senha;
      $mercado_id = $dados->mercado_id;
      $telefone = $dados->telefone;
      $cpf = $dados->cpf;
      $tipo = $dados->tipo;
      
    }  

  }


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
  <section class="forms">
    <div class="container-fluid">
      <!-- Page Header-->
      <header> 
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <h4>Cadastro de Usuário</h4>
            </div>
            <div class="card-body">
              <form name="form1" action="homeA.php?op=salvar&pg=usuario" method="post" data-parsley-validate>
                <input type="text" name="id" class="form-control" style="display: none;" readonly value="<?=$id;?>">
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" name="nome" placeholder="Digite o nome completo" class="form-control" required data-parsley-required-message="<script>alert('Preencha o nome do Usuario');</script>" value="<?=$nome;?>">
                </div>

                <div class="form-group">
                  <label>CPF</label>
                  <input type="text" name="cpf" placeholder="Digite o CPF" class="form-control" required data-parsley-required-message="<script>alert('Preencha o CPF');</script>" data-mask="999.999.999-99" value="<?=$cpf;?>">
                </div>

                <div class="form-group">
                  <label>WhatsApp/Telefone</label>
                  <input type="text" name="telefone" placeholder="Digite o numero do WhatsApp ou telefone" class="form-control" required data-parsley-required-message="<script>alert('Preencha o numero do seu telefone');</script>" data-mask="(99) 9999-9999?9" value="<?=$telefone;?>">
                </div>

                <div class="form-group">
                  <label>E-mail</label>
                  <input type="email" name="email" placeholder="Digite seu email" class="form-control" required data-parsley-required-message="<script>alert('Preencha o e-mail');</script>" value="<?=$email;?>">
                </div>
                <div class="form-group">
                  <label>Login</label>
                  <input type="text" name="login" id="validalogin" placeholder="Digite o login" class="form-control" value="<?=$login;?>" required data-parsley-required-message="<script>alert('Preencha o login');</script>" <?php if (!empty($login)) echo "disabled"; ?>>
                </div>
                <div class="form-group">
                  <label>Senha</label>
                  <input type="password" name="senha" placeholder="Digite sua senha" class="form-control" <?php if (empty($login)) echo "required"; ?> data-parsley-required-message="<script>alert('Preencha a senha');</script>">
                </div>
                <div class="form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control" required data-parsley-required-message="Selecione uma opção">
                  <option value="">--Escolha a Opção--</option>
                  <option value="Admin">Admin</option>
                  <option value="Master">Master</option>
                  </select>
                </div>
                <div class="form-group">
                <label for="ativo">Ativo</label>
                <select name="ativo" id="ativo" class="form-control" required data-parsley-required-message="Selecione uma opção">
                  <option value="">--Escolha a Opção--</option>
                  <option value="Sim">Sim</option>
                  <option value="Nao">Não</option>
                  </select>
                </div>

                  <div class="form-group">
                  <label for="mercado_id">Mercado</label>
                  <select name="mercado_id" id="mercado_id" class="form-control" required>
                    <option value="">--Escolha o Mercado--</option>
                    <?php 

                      use Mercado\Mercado;

                      $mercadoM = new Mercado();

                      $dados = $mercadoM->listarMercados();

                      foreach ($dados as $key) {
                        echo "<option value=\"$key->id\">$key->nome</option>";
                        }
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

  //verifica se o corpo já foi carregado
  $(document).ready(function(){
    //selecionar a opcao SIM ou NAO do ativo
    $("#tipo").val('<?=$tipo;?>');
    $("#ativo").val('<?=$ativo;?>');
    $("#mercado_id").val("<?=$mercado_id;?>");
  })
</script>