<?php 

  require '../../autoload.php';

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



<!DOCTYPE html>

<html class="no-js">



<!--https://www.um.es/docencia/barzana/materializecss/modals.html#!

  Materialize 9.7 do template

-->



<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>MARS - Gerenciador de Busca de Produtos</title>

  <meta name="description" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

  <base href="https://mateuschineis.tk/">

  <!-- Favicon-->

  <link rel="shortcut icon" href="images/icon.png" >



  <!-- Stylesheets -->

  <link rel="stylesheet" href="assets/css/normalize.css">

  <link rel="stylesheet" href="assets/font/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="assets/libs/materialize/css/materialize.min.css" />

  <link rel="stylesheet" href="assets/css/bootstrap.css" media="screen,projection" />



  <link rel="stylesheet" href="assets/css/animate.min.css" media="screen,projection" />

  <link rel="stylesheet" href="assets/libs/sweetalert/sweet-alert.css" media="screen,projection" />



  <link rel="stylesheet" href="assets/libs/owl-carousel/owl.carousel.css" media="screen,projection" />

  <link rel="stylesheet" href="assets/libs/owl-carousel/owl.transitions.css" media="screen,projection" />

  <link rel="stylesheet" href="assets/libs/owl-carousel/owl.theme.css" media="screen,projection" />

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



  <link rel="stylesheet" href="assets/css/main.css">

  <link rel="stylesheet" href="assets/css/style.css">

  <link rel="stylesheet" href="assets/css/responsive.css">



  <!-- Choose your default colors -->

  <link rel="stylesheet" href="assets/css/colors/color4.css">



  <!-- JavaScripts -->

  <script type="text/javascript" src="assets/js/jquery.min.js"></script>



  <script src="assets/js/jquery.easing.1.3.js"></script>

  <script src="assets/js/detectmobilebrowser.js"></script>

  <script src="assets/js/isotope.pkgd.min.js"></script>

  <script src="assets/js/wow.min.js"></script>

  <script src="assets/js/waypoints.js"></script>

  <script src="assets/js/jquery.counterup.min.js"></script>

  <script src="assets/js/jquery.nicescroll.min.js"></script>

  <script src="assets/js/gmaps.js"></script>

  <script src="assets/libs/owl-carousel/owl.carousel.min.js"></script>

  <script src="assets/libs/materialize/js/materialize.min.js"></script>

  <script src="assets/libs/jwplayer/jwplayer.js"></script>

  <script src="assets/libs/sweetalert/sweet-alert.min.js"></script>

  <script src="assets/js/common.js"></script>

  <script src="assets/js/main.js"></script>

  <script src="assets/js/leanModal.js"></script>



  <!--Arquivos da DashBoard-->    





  



    <!-- Bootstrap Datepicker CSS-->

    <link rel="stylesheet" href="admin/vendor/datepicker/css/bootstrap-datepicker3.css">





    <!--/Premiun-->



    <!-- jQuery Circle-->

    <link rel="stylesheet" href="admin/css/grasp_mobile_progress_circle-1.0.0.min.css">

    <!-- Custom Scrollbar-->

    <link rel="stylesheet" href="admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">

    <!-- theme stylesheet-->

    <link rel="stylesheet" href="admin/css/style.default.css" id="theme-stylesheet">



    <!--/Selectize JS-->



    <!-- CSS file-->

    <link rel="stylesheet" href="assets/css/easy-autocomplete.css"> 



    <!--/Selectize JS-->



    <!-- Custom stylesheet - for your changes-->

    <link rel="stylesheet" href="admin/css/custom.css">

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <script src="admin/vendor/popper.js/umd/popper.min.js"> </script>

    <script src="admin/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>

    <script src="admin/vendor/chart.js/Chart.min.js"></script>

    <script src="admin/vendor/jquery-validation/jquery.validate.min.js"></script>

    <script src="admin/js/bootstrap-inputmask.min.js"></script>

    <script src="admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    

    <script type="text/javascript" src="admin/js/parsley.min.js"></script>



    <!-- DataTables -->

    <script src="admin/vendor/datatables/js/jquery.dataTables.js.download"></script>



    <script src="admin/vendor/datatables/js/dataTables.bootstrap4.js.download"></script>



    <script src="admin/vendor/datatables/js/dataTables.responsive.min.js.download"></script>



    <script src="admin/vendor/datatables/js/responsive.bootstrap4.min.js.download"></script>



    <script src="admin/vendor/datatables/js/tables-datatable.js"></script>

    <!-- /DataTables -->



    <!-- Bootstrap DatePicker-->

    <script src="assets/date_picker/picker.date.js"></script>



    <!-- /Bootstrap DatePicker-->



    <!--easyautocomplete-->



    <!-- JS file -->

    <script src="admin/vendor/easyautocomplete/jquery.easy-autocomplete.min.js"></script> 



    <!-- Additional CSS Themes file - not required-->

    <link rel="stylesheet" href="admin/vendor/easyautocomplete/easy-autocomplete.themes.min.css"> 



    <!--/easyautocomplete-->



    <!--Mask Money-->

    <script type="text/javascript" src="admin/vendor/maskMoney/js/jquery.maskMoney.min.js"></script>



    <!-- <script src="admin/js/charts-home.js"></script> -->

    

    <!--Arquivos da DashBoard-->



  <script type="text/javascript" src="js/funcoes.js"></script>

  <script type="text/javascript" src="js/<?=$arquivo;?>" defer></script>





</head>



<body>



  <div id="preloader">







      <div class="loader">







            <svg class="circle-loader" height="50" width="50">







              <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />







            </svg>







        </div>    







    </div><!--preloader end-->



     <!--Aqui vai o botao home-->



     <style>

      input[type=number]::-webkit-inner-spin-button,

        input[type=number]::-webkit-outer-spin-button {

            -webkit-appearance: none;

            margin: 0;

        }

    </style>



  <!-- Main Container -->

  <main id="app" class="main-section">

    <!-- header navigation start -->

    <header id="navigation" class="root-sec white nav">

      <div class="container">

        <div class="row">

          <div class="col-sm-12">

            <div class="nav-inner">

            <nav class="primary-nav">



<div class="clearfix nav-wrapper">



  <a href="<?=$mercado;?>" class="left brand-logo menu-smooth-scroll" data-section="#home"><img src="images/imagens/Drrnovo.png" alt="">



  </a>



  <a data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>



  <ul class="right static-menu">



    <li class="margMenu">



      <a class="modal-trigger" data-activates="dropdown3">



        <i class="mdi-image-camera-alt"></i>



      </a>



    </li>







    <li class="margMenu">



      <a>



        <i class="mdi-action-shopping-cart"></i>



      </a>



    </li>



    



    <!-- <li>



      <a class="modal-trigger" href="#modal2">



        <i class="fa fa-user fa-fw right"></i>



      </a>



    </li> -->



  </ul>











  <ul class="inline-menu side-nav" id="mobile-demo">


    <li><!-- Modal Trigger -->



        <a href="<?=$mercado;?>" data-section="#home" class="menu-smooth-scroll" >



          <i class="fa fa-file-text fa-fw"></i>



          Home 



        </a>



    </li>



    <li><!-- Modal Trigger -->



        <a class="menu-smooth-scroll" data-section="selecionarMercado.php" href="selecionarMercado.php">



          <i class="fa fa-file-text fa-fw"></i>



          Selecione outro mercado 



        </a>



    </li>



  </ul>










</div>



</nav>

            </div>

          </div>

        </div>

      </div>



      <!-- .container end -->

    </header>








<br><br>
    <!-- Contact Section end -->

    <section id="contact" class="scroll-section root-sec brand-bg padd-tb-120 contact-wrap">

      <div class="container">

        <div class="row">

          <div class="contact-inner">

            <div class="col-sm-12 card-box-wrap">

              <div class="row">

                <div class="clearfix section-head contact-text">

                  <div class="col-sm-12">

                    <h2 class="title"><?php 

                      if (isset ( $_GET["id"] )){

                            echo "ALTERAR DADOS";

                          } else {echo "CADASTRE-SE";}?>

                    </h2>

                  </div>

                </div> <!-- contact text end -->



                <div class="clearfix contact-form">

                  <div class="col-sm-12">

                    <div class="clearfix card-panel grey lighten-5 cform-wrapper">

                      <form action="salvar/cliente.php" method="post" id="contactForm" novalidate data-parsley-validate>

                        <div class="input-field">

                          <input type="hidden" name="id" class="validate input-box" value="<?=$id;?>">

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" id="nome" type="text" name="nome" class="validate input-box" required data-parsley-required-message="<script>alert('Preencha o nome do Cliente');</script>" value="<?=$nome;?>">

                          <label for="nome" class="input-label">Nome</label>

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" type="text" name="cpf" class="validate input-box" required data-parsley-required-message="<script>alert('Preencha o CPF do Cliente');</script>" data-mask="999.999.999-99" value="<?=$cpf;?>">

                          <label for="cpf" class="input-label">CPF</label>

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" type="number" name="rg" class="validate input-box" required data-parsley-required-message="<script>alert('Preencha o RG do Cliente');</script>" value="<?=$rg;?>">

                          <label for="rg" class="input-label">RG</label>

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" id="dtNascimento" type="text" name="dtNascimento" class="validate input-box" data-mask="99/99/9999" required data-parsley-required-message="<script>alert('Preencha sua data de nascimento');</script>" value="<?=$dtNascimento;?>">

                          

                          <label for="dtNascimento" class="input-label">Data de Nascimento</label>

                        </div>     

                        <div class="input-field">

                          <select name="sexo" id="sexo" class="select" required data-parsley-required-message="Selecione seu sexo">

                            <option value="" disabled selected>--Escolha a Opção--</option>

                            <option value="Masculino">Masculino</option>

                            <option value="Feminino">Feminino</option>

                            <option value="Outro">Outros</option>

                          </select>  

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" type="text" name="cep" class="validate input-box" required data-parsley-required-message="<script>alert('Preencha o Cep');</script>" data-mask="99-999-999" value="<?=$cep;?>">

                          <label for="cep" class="input-label">CEP</label>

                        </div>

                        <div class="input-field">

                        <input autocomplete="off" id="cidade_idd" type="text" name="cidade_idd" placeholder="Digite a Cidade" class=".eac-green-light validate input-box ">



                          <input autocomplete="off" id="cidade_id" type="hidden" name="cidade_id" class="validate input-box">

                          <!-- <label for="cidade_id" class="input-label">Cidade</label> -->

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" id="" type="text" name="endereco" class="validate input-box" required data-parsley-required-message="<script>alert('Preencha o endereço do Cliente');</script>" value="<?=$endereco;?>">

                          <label for="endereco" class="input-label">Endereço</label>

                        </div>                                                

                        <div class="input-field">

                          <input autocomplete="off" id="" type="text" name="numero" class="validate input-box" maxlength="5" value="<?=$numero;?>">

                          <label for="numero" class="input-label">Numero</label>

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" id="" type="text" name="complemento" class="validate input-box" value="<?=$complemento;?>">

                          <label for="complemento" class="input-label">Complemento</label>

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" id="" type="text" name="bairro" class="validate input-box" value="<?=$bairro;?>">

                          <label for="bairro" class="input-label">Bairro</label>

                        </div>                        

                        <div class="input-field">

                          <input autocomplete="off" id="" type="text" name="celular" class="validate input-box" required data-parsley-required-message="<script>alert('Preencha o numero do celular do Cliente');</script>" data-mask="(99) 9999-9999?9" value="<?=$celular;?>">

                          <label for="celular" class="input-label">Celular</label>

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" id="" type="text" name="whatsapp" class="validate input-box" data-mask="(99) 9999-9999?9" value="<?=$whatsapp;?>">

                          <label for="whatsapp" class="input-label">WhatsApp</label>

                        </div>                        

                        <div class="input-field">

                          <input autocomplete="off" id="email" type="email" name="email" class="validate input-box" required data-parsley-required-message="<script>alert('Preencha o e-mail');</script>" value="<?=$email;?>">

                          <label for="email" class="input-label">Email</label>

                        </div>

                        <div class="input-field">

                          <input autocomplete="off" id="" type="password" name="senha" class="validate input-box" <?php if (empty($email)) echo "required"; ?> data-parsley-required-message="<script>alert('Preencha a senha');</script>">

                          <label for="senha" class="input-label">Senha</label>

                        </div>

                        <div class="input-field submit-wrap clearfix">

                        <?php 

                          if (isset ( $_GET["id"] )){

                                echo "<button type='submit' class='left waves-effect btn-flat brand-text submit-btn'>Alterar</button>";

                              } else {echo "<button type='submit' class='left waves-effect btn-flat brand-text submit-btn'>Salvar</button>";}

                        ?>

                          <div class="right form-loader-area">

                            <svg class="circular size-20" height="20" width="20">

                              <circle class="path" cx="10" cy="10" r="7" fill="none" stroke-width="3" stroke-miterlimit="10" />

                            </svg>

                          </div>

                        </div>

                      </form>

                    </div>

                  </div> <!-- ./contact form end -->

                </div>

              </div>

            </div>

          </div>

        </div>

      </div> <!-- ./container end -->

    </section>

    <!-- #contact Section end -->





    <!-- Footer Section end -->

    <footer id="footer" class="root-sec white root-sec footer-wrap">

      <div class="container">

        <div class="row">

          <div class="col-sm-12">

            <div class="clearfix footer-inner">

              <ul class="left social-icons">

                <li><a href="#" class="tooltips tooltipped facebook" data-position="top" data-delay="50" data-tooltip="Facebook"><i class="fa fa-facebook"></i></a>

                </li>

                <li><a href="#" class="tooltips tooltipped linkedin" data-position="top" data-delay="50" data-tooltip="Linkdin"><i class="fa fa-linkedin"></i></a>

                </li>

                <li><a href="#" class="tooltips tooltipped twitter" data-position="top" data-delay="50" data-tooltip="Twitter"><i class="fa fa-twitter"></i></a>

                </li>

                <li><a href="#" class="tooltips tooltipped google-plus" data-position="top" data-delay="50" data-tooltip="Google Plus"><i class="fa fa-google-plus"></i></a>

                </li>

                <li><a href="#" class="tooltips tooltipped instagram" data-position="top" data-delay="50" data-tooltip="Instagram"><i class="fa fa-instagram"></i></a>

                </li>

                <!--<li><a href="#" class="tooltips tooltipped dribbble" data-position="top" data-delay="50" data-tooltip="Dribbble"><i class="fa fa-dribbble"></i></a>

                </li>

                <li><a href="#" class="tooltips tooltipped behance" data-position="top" data-delay="50" data-tooltip="Behance"><i class="fa fa-behance"></i></a>

                </li>-->

              </ul> <!-- ./social icons end -->

              <div class="right copyright">

                <p>&copy; MARS - Gerenciador de Busca de Produtos</p>

              </div>

            </div>

          </div>

        </div>

      </div> <!-- ./container end-->

    </footer>

    <!-- #footer end -->



  </main>

  <!-- Main Container end-->

  <script type="text/javascript">

  $(document).ready(function() {

      $('.select').material_select();

    });



  $("#sexo").val("<?=$sexo;?>");



    var options = {

      url: "admin/arquivos/cidades.json",



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

  <?php } ?>





</body>



</html>



<!--https://www.um.es/docencia/barzana/materializecss/modals.html#!

  Materialize 9.7 do template

-->