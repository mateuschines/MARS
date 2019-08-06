<?php 
  if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 
  require '../../../autoload.php';
  use Mercado\Mercado;

  $mercadoM = new Mercado();

  $id = $nome = $apelido = $endereco = $numeroTelefone = $cnpj = $site = $facebook = $whatsapp = $cidade_id = $cep = $bairro = $instagram = $logo = "";

  if ( isset ( $_GET["id"] ) ) {
    $dados = $mercadoM->buscaMercado($_GET["id"]);

  if ( !empty ( $dados->id ) ) {
      $id = $dados->id;
      $nome = $dados->nome;
      $apelido = $dados->apelido;
      $endereco = $dados->endereco;
      $numeroTelefone = $dados->numeroTelefone;
      $cnpj = $dados->cnpj;
      $site = $dados->site;
      $facebook = $dados->facebook;
      $whatsapp = $dados->whatsapp;
      $cidade_idd = $dados->nomeCidade;
      $cidade_id = $dados->cidade_id;
      $cep = $dados->cep;
      $bairro = $dados->bairro;
      $instagram = $dados->instagram;
      $logo = $dados->logo;
      
    }  

  }



 ?>

 <!-- Breadcrumb-->
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="homeA.php">Home</a></li>
            <li class="breadcrumb-item active">Mercado</li>
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
                  <h4>Cadastro de Mercado</h4>
                </div>
                <div class="card-body">
                  <form name="form1" action="homeA.php?op=salvar&pg=mercado" method="post" data-parsley-validate enctype="multipart/form-data">
                    <input type="text" name="id" class="form-control d-none" readonly value="<?=$id;?>">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" name="nome" placeholder="Digite o nome do Mercado" class="form-control" required data-parsley-required-message="<script>alert('Preencha o nome do Mercado');</script>" value="<?=$nome;?>">
                    </div>
                    <div class="form-group">
                      <label>CNPJ</label>
                      <input type="text" name="cnpj" placeholder="Digite o CNPJ do Mercado" class="form-control" required data-parsley-required-message="<script>alert('Preencha o CNPJ do Mercado');</script>" data-mask="99.999.999/9999-99" value="<?=$cnpj;?>">
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
                      <input type="text" name="endereco" placeholder="Digite o endereço do Mercado" class="form-control" required data-parsley-required-message="<script>alert('Preencha o endereço do Mercado');</script>" value="<?=$endereco;?>">
                    </div>

                    <div class="form-group">
                      <label>Bairro</label>
                      <input type="text" name="bairro" placeholder="Digite o Bairro" class="form-control" value="<?=$bairro;?>">
                    </div>

                    <div class="form-group">
                      <label>Apelido</label>
                      <input type="text" name="apelido" placeholder="Digite o apelido do Mercado" class="form-control" required data-parsley-required-message="<script>alert('Preencha o apelido do Mercado');</script>" value="<?=$apelido;?>">
                    </div>

                    <?php
                      $r = " required
                    data-parsley-required-message=\"Por favor, seleciona uma imagem JPG\" ";

                      if ( !empty($logo) ) $r = "";

                    ?>

                    <label for="foto">Selecione uma Imagem ou Logo</label>
                    <input type="file" name="foto" class="form-control" <?=$r;?> accept="image/jpeg">
                    <br>
                    <?php
                      //verificar se existe foto - mostrar a foto na tela
                      if ( !empty ( $logo ) ) {
                        $logop = "../imagensMercados/".$logo."p.jpg";
                        echo "<img src='$logop' class='img-thumbnail' width='100px'><br>";
                      }
                    ?>

                    <div class="form-group">
                      <label>Telefone</label>
                      <input type="text" name="numeroTelefone" placeholder="Digite o numero de telefone do Mercado" class="form-control" required data-parsley-required-message="<script>alert('Preencha o numero de telefone do Mercado');</script>" data-mask="(99) 9999-9999?9" value="<?=$numeroTelefone;?>">
                    </div>
                    <div class="form-group">
                      <label>WhatsApp</label>
                      <input type="text" name="whatsapp" placeholder="Digite o WhatsApp do Mercado" class="form-control" data-mask="(99) 9999-9999?9" value="<?=$whatsapp;?>">
                    </div>
                    <div class="form-group">
                      <label>Site</label>
                      <input type="text" name="site" placeholder="www.seumercado.com" class="form-control" value="<?=$site;?>">
                    </div>
                    <div class="form-group">
                      <label>Facebook</label>
                      <input type="text" name="facebook" placeholder="Cole o link da pagina do face aqui!" class="form-control" value="<?=$facebook;?>">
                    </div>

                    <div class="form-group">
                      <label>Instagram</label>
                      <input type="text" name="instagram" placeholder="Digite o instagram do mercado aqui!" class="form-control" value="<?=$instagram;?>">
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

?>