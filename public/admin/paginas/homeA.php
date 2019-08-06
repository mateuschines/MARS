<?php 
    include "../app/login.php";

    if ($_SESSION["sistema"]["tipo"] == "Master"){
        header("Location: home.php");
    }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MARS - Gerenciador de Busca de Produtos</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="../css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">

    <!--Premiun-->
    <!-- DataTables CSS-->
    <link rel="stylesheet" href="../vendor/datatables/css/dataTables.bootstrap4.css">

    <link rel="stylesheet" href="../vendor/datatables/css/responsive.bootstrap4.min.css">

    <!-- Bootstrap Datepicker CSS-->
    <link rel="stylesheet" href="../vendor/datepicker/css/bootstrap-datepicker3.css">


    <!--/Premiun-->

    <!-- jQuery Circle-->
    <link rel="stylesheet" href="../css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">

    <!--/Selectize JS-->

    <!-- CSS file -->
    <link rel="stylesheet" href="../vendor/easyautocomplete/easy-autocomplete.min.css"> 

    <!--/Selectize JS-->

    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/imagens/icon3.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

     <!-- JavaScript files-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="../js/bootstrap-inputmask.min.js"></script>
    <script src="../vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    
    <script type="text/javascript" src="../js/parsley.min.js"></script>

    <!-- DataTables -->
    <script src="../vendor/datatables/js/jquery.dataTables.js.download"></script>

    <script src="../vendor/datatables/js/dataTables.bootstrap4.js.download"></script>

    <script src="../vendor/datatables/js/dataTables.responsive.min.js.download"></script>

    <script src="../vendor/datatables/js/responsive.bootstrap4.min.js.download"></script>

    <script src="../vendor/datatables/js/tables-datatable.js"></script>
    <!-- /DataTables -->

    <!-- Bootstrap DatePicker-->
    <script src="../vendor/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="../vendor/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>

    <!-- /Bootstrap DatePicker-->

    <!--easyautocomplete-->

    <!-- JS file -->
    <script src="../vendor/easyautocomplete/jquery.easy-autocomplete.min.js"></script> 

    <!-- Additional CSS Themes file - not required-->
    <link rel="stylesheet" href="../vendor/easyautocomplete/easy-autocomplete.themes.min.css">

      <!-- barcode JS -->
      <script src="../arquivos/barcode/barcode.js"></script>

    <!--/easyautocomplete-->

    <!--Mask Money-->
    <script type="text/javascript" src="../vendor/maskMoney/js/jquery.maskMoney.min.js"></script>

    <script src="../js/charts-home.js"></script>
    
    <!-- Main File-->
    <script src="../js/front.js"></script>
        
  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center">
            <img id="logo-ma" src="../img/imagens/LogoBrancaU.png">
            </div>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <?php
            if($_SESSION["sistema"]["tipo"] == "Master") {
              echo "<div class='sidenav-header-logo'><a href='home.php' class='brand-small text-center'> 
              <strong>MA</strong><strong class='text-primary'>RS</strong></a>
              </div>";
            } else {
              echo "<div class='sidenav-header-logo'><a href='homeA.php' class='brand-small text-center'> 
              <strong>MA</strong><strong class='text-primary'>RS</strong></a>
              </div>";
            }
          ?>
          
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="homeA.php"> <i class="icon-home"></i>Home                             </a></li>
            <!-- <li><a href="#DropdownCadastro" aria-expanded="false" data-toggle="collapse"> <i class="icon-form"></i>Cadastros</a>
              <ul id="DropdownCadastro" class="collapse list-unstyled ">
                <li><a href="home.php?op=cadastro&pg=cidade">Cidade</a></li>
                
                <li><a href="home.php?op=cadastro&pg=mercado">Mercado</a></li>
                <li><a href="home.php?op=cadastro&pg=cliente">Cliente</a></li>
                <li><a href="home.php?op=cadastro&pg=usuario">Usuário</a></li>
                <li><a href="home.php?op=cadastro&pg=categoria">Categoria</a></li>
                <li><a href="home.php?op=cadastro&pg=produto">Produto</a></li>
                <li><a href="home.php?op=cadastro&pg=promocao">Promoção</a></li>
              </ul>
            </li> -->
            <!-- <li><a href="#DropdownListar" aria-expanded="false" data-toggle="collapse"> <i class="icon-grid"></i>Listar</a>
              <ul id="DropdownListar" class="collapse list-unstyled ">
                <li><a href="home.php?op=listas&pg=cidade">Cidade</a></li>
                <li><a href="home.php?op=listas&pg=mercado">Mercado</a></li>
                <li><a href="home.php?op=listas&pg=cliente">Cliente</a></li>
                <li><a href="home.php?op=listas&pg=usuario">Usuário</a></li>
                <li><a href="home.php?op=listas&pg=categoria">Categoria</a></li>
                <li><a href="home.php?op=listas&pg=produto">Produto</a></li>
                <li><a href="home.php?op=listas&pg=promocao">Promoção</a></li>
              </ul>
            </li> -->
            <li><a href="homeA.php?op=listas&pg=cidade">Cidade</a></li>
            <li><a href="homeA.php?op=listas&pg=mercado">Mercado</a></li>
            <li><a href="homeA.php?op=listas&pg=cliente">Cliente</a></li>
            <li><a href="homeA.php?op=listas&pg=usuario">Usuário</a></li>
            <li><a href="homeA.php?op=listas&pg=categoria">Categoria</a></li>
            <li><a href="homeA.php?op=listas&pg=produto">Produto</a></li>
            <li><a href="homeA.php?op=listas&pg=promocao">Promoção</a></li>
            <li><a href="homeA.php?op=listas&pg=vendidos">Produtos Vendidos</a></li>
            <li><a href="#DropdownRelatorio" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart"></i>Relatórios</a>
              <ul id="DropdownRelatorio" class="collapse list-unstyled ">
                <li><a href="homeA.php?op=relatorio&pg=produtosMaisVendidos">Produtos Mais Vendidos</a></li>
                <li><a href="homeA.php?op=relatorio&pg=produtosNuncaVendidos">Produtos não foram vendidos</a></li>
                <li><a href="homeA.php?op=relatorio&pg=clientesMaisCompraram">Clientes Mais Compraram</a></li>
                <li><a href="homeA.php?op=relatorio&pg=clientesNuncaCompraram">Clientes Nunca Comprou</a></li>
                <li><a href="homeA.php?op=relatorio&pg=mercadoMaisVende">Mercado Mais vende</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="homeA.php" class="navbar-brand">
                 <div class="brand-text d-none d-md-inline-block"><strong class="">Bem Vindo, <?php echo strtoupper($_SESSION["sistema"]["nome"]); ?></strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Notifications dropdown-->
                
                <!-- Messages dropdown-->
               
                <!-- Languages dropdown    -->
                
                <!-- Log out-->
                <li class="nav-item"><a href="sair.php" class="nav-link logout"> <span class="d-none d-sm-inline-block">Sair</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      <!--Onde Roda o PHP com as paginas-->

      <?php

      $op = $pg = "";
        //recuperar o op
        if ( isset ( $_GET["op"] ) ) {
          $op = trim ( $_GET["op"] );
        }
        if ( isset ( $_GET["pg"] ) ) {
          $pg = trim ( $_GET["pg"] );
        }

        //echo "Conteudo do op e do pg: $op $pg";

        if ( empty ( $pg ) ) {
          $pagina = "dashboard.php";
        } else {
          $pagina = $op."/".$pg.".php";
        }

        //verificar se o arquivo existe
        if ( file_exists( $pagina ) ) {
          include $pagina;
        } else {
          include "erro.php";
        }
        //webSocket socket.io
      ?>
      
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>&copy; Mateus Rocha - <?php echo date("Y"); ?></p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by Bootstrapious</p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>

  </body>
</html>