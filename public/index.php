<?php



    $conf['opcache.enable'] = 0;  

    $conf['cache'] = 0;                       // Page cache

    $conf['page_cache_maximum_age'] =  0;     // External cache TTL

    $conf['preprocess_css'] = FALSE;          // Optimize css

    $conf['preprocess_js'] = FALSE;           // Optimize javascript

    $conf['views_skip_cache'] = TRUE; 



  if (session_status() !== PHP_SESSION_ACTIVE) {

    session_cache_limiter('private');



    session_cache_expire(60);

    session_start();

  }



  if ( empty ( $_SERVER['HTTPS'] ) ) {



    header("location: https://mateuschineis.tk");

  

  }





  $pagina = "home";







  if ( isset ($_GET["param"])) {



    $param = trim ($_GET["param"]);







    $param = explode("/", $param);







    $mercado = $param[0];







    if ( isset ( $param[1] ) )  $pagina = $param[1];







    if ( empty ( $pagina ) ) $pagina = "home";



  }







  $arquivo = $pagina.".js";







  if ( empty ( $mercado ) ) {







    include "selecionarMercado.php";



    exit;



    



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

  <!-- <meta http-equiv='cache-control' content='no-cache'>

  <meta http-equiv='expires' content='0'>

  <meta http-equiv='pragma' content='no-cache'> -->

  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />

  <meta http-equiv="Pragma" content="no-cache" />

  <meta http-equiv="Expires" content="0" />

  

  <base href="https://mateuschineis.tk/">



  <!-- Favicon-->



  <link rel="shortcut icon" href="images/icon.png" >







  <!-- Stylesheets -->



  <link rel="stylesheet" href="assets/css/normalize.css">



  <link rel="stylesheet" href="assets/font/font-awesome/css/font-awesome.min.css">



  <link rel="stylesheet" href="assets/libs/materialize/css/materialize.min.css" media="screen,projection" />



  <link rel="stylesheet" href="assets/css/bootstrap.css" media="screen,projection" />







  <link rel="stylesheet" href="assets/css/animate.min.css" media="screen,projection" />



  <link rel="stylesheet" href="assets/libs/sweetalert/sweet-alert.css" media="screen,projection" />







  <link rel="stylesheet" href="assets/libs/owl-carousel/owl.carousel.css" media="screen,projection" />



  <link rel="stylesheet" href="assets/libs/owl-carousel/owl.transitions.css" media="screen,projection" />



  <link rel="stylesheet" href="assets/libs/owl-carousel/owl.theme.css" media="screen,projection" />



  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">







  <link rel="stylesheet" href="./admin/vendor/easyautocomplete/easy-autocomplete.min.css"> 







  <link rel="stylesheet" href="assets/css/main.css">



  <link rel="stylesheet" href="assets/css/style.css">



  <link rel="stylesheet" href="assets/css/responsive.css">







  <!-- Choose your default colors -->



  <link rel="stylesheet" href="assets/css/colors/color4.css">







  <!-- JavaScripts -->



  <script type="text/javascript" src="assets/js/jquery.min.js"></script>







  <script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>



  <script type="text/javascript" src="assets/js/detectmobilebrowser.js"></script>



  <script type="text/javascript" src="assets/js/isotope.pkgd.min.js"></script>



  <script type="text/javascript" src="assets/js/wow.min.js"></script>



  <script type="text/javascript" src="assets/js/waypoints.js"></script>



  <script type="text/javascript" src="assets/js/jquery.counterup.min.js"></script>



  <script type="text/javascript" src="assets/js/jquery.nicescroll.min.js"></script>



  <!-- <script src="assets/js/gmaps.js"></script> -->



  <script type="text/javascript" src="assets/libs/owl-carousel/owl.carousel.min.js"></script>



  <script type="text/javascript" src="assets/libs/materialize/js/materialize.min.js"></script>



  <script type="text/javascript" src="assets/libs/jwplayer/jwplayer.js"></script>



  <script type="text/javascript" src="assets/libs/sweetalert/sweet-alert.min.js"></script>



  <script type="text/javascript" src="assets/js/common.js"></script>



  <script type="text/javascript" src="assets/js/main.js"></script>



  <script type="text/javascript" src="assets/js/leanModal.js"></script>







   <!-- JS file -->



   <script src="./admin/vendor/easyautocomplete/jquery.easy-autocomplete.min.js"></script> 







  <!-- Additional CSS Themes file - not required-->











  <!-- barcode JS -->



  <script src="assets/barcode/barcode.js"></script>







  <link rel="manifest" href="webmanifest.json">



  







  <script type="text/javascript" src="js/funcoes.js"></script>



  <script type="text/javascript" src="js/<?=$arquivo;?>" defer></script>











</head>







<body>







    <!-- Preloader --> 







    <div id="preloader">







      <div class="loader">







            <svg class="circle-loader" height="50" width="50">







              <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="6" stroke-miterlimit="10" />







            </svg>







        </div>    







    </div><!--preloader end-->





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



                  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>



                  <ul class="right static-menu">





                    <li class="search-form-li">



                      <a id="initSearchIcon" class=""><i class="mdi-action-search"></i> </a>



                      <div class="search-form-wrap hide">



                        <form id="produto_id" action="javascript:func()" class="">



                            <input type="search" name="produto_idd" id="produto_idd" class="search">



                            <button type="submit"><i class="mdi-action-search"></i>



                            </button>



                            <input type="hidden" name="produto_id" id="produto_id" class="form-control">



                        </form>



                      </div>



                    </li>







                    <li class="margMenu">



                      <a class="modal-trigger" href="#modalCamera" data-activates="dropdown3">



                        <i class="mdi-image-camera-alt"></i>



                      </a>



                    </li>







                    <li class="margMenu">



                      <a href="<?=$mercado?>/carrinho">



                        <i class="mdi-action-shopping-cart"></i>



                      </a>



                    </li>



                    



                    <!-- <li>



                      <a class="modal-trigger" href="#modal2">



                        <i class="fa fa-user fa-fw right"></i>



                      </a>



                    </li> -->



                    <li>



                      <a class="dropdown-button blog-submenu-init" href="#!" data-activates="dropdown1">



                        <i class="fa fa-user fa-fw right"></i>



                      </a>



                    </li>



                  </ul>











                  <ul class="inline-menu side-nav" id="mobile-demo">







                  <!-- Mini Profile // only visible in Tab and Mobile -->



                    <li class="mobile-profile">



                     <div class="profile-inner">



                        <!--<div class="pp-container">



                            <img src="images/person.png" alt="">



                        </div>-->







                        <?php



                          if (isset($_SESSION["site"]["id"])){



                            echo strtoupper("<h3>".$_SESSION["site"]["nome"]."</h3>");



                          } else {



                              echo "<h3>Faça Login</h3>";



                          }



                        ?>



                        



                      </div>



                    </li><!-- mini profile end-->



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



                    <li>



                      <a class="menu-smooth-scroll modal-trigger" data-section="#modal1" href="#modal1">



                        <i class="fa fa-file-text fa-fw"></i>



                        Categorias



                      </a>



                    </li>



                  </ul>



                  <ul id="dropdown1" class="inline-menu submenu-ul dropdown-content">



                    <li>



                      <?php



                        if (isset($_SESSION["site"]["id"])){



                          echo strtoupper($_SESSION["site"]["nome"]);



                        } else {echo "Home";}



                      ?>



                    </li>



                    <li>



                      <?php



                        if (isset($_SESSION["site"]["id"])){



                          echo "<a href='$mercado/comprasRealizadas/".$_SESSION["site"]["id"]."'>Compras Realizadas</a>";



                        }



                      ?>



                    </li>



                    <li>



                      <?php



                        if (isset($_SESSION["site"]["id"])){



                          echo "<a href='cadastro/cliente.php?id=".$_SESSION["site"]["id"]."'>Alterar Dados</a>";



                        } else {echo "<a href='cadastro/cliente.php'>Cadastre-se</a>";}



                      ?>



                    </li>



                    <li>



                      <?php



                        if (isset($_SESSION["site"]["id"])){



                          echo "<a href='sair.php'>Sair</a>";



                        } else {echo "<a href='$mercado/login'>Entre</a>";}



                      ?>



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







    <!-- Modal Structure -->



    <div id="modal1" class="modal white">



      



      <div class="modal-footer">



        <ul class="inline-menu inline-menuu clearfix portfolio-category" id="portfolio-msnry-sort menu">



            <!--esta carregando as categorias pelo modal do arquivo js-->



        </ul>



      </div>



    </div>







    <div id="modalCamera" class="modal">



      <div class="modal-content">



        <script src="assets/barcode/CarregarBarcode.js"></script>



        <div id="barcode">



          <video id="barcodevideo" autoplay></video>



          <canvas id="barcodecanvasg" ></canvas>



        </div>



        <canvas id="barcodecanvas" ></canvas>



        <div id="result"></div>



        </div>







      <div class="modal-footer">



        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat red">Fechar</a>



      </div>



    </div>







    <!-- Modal Pessoa -->



    <div id="modal2" class="modal brand-bg">



      



      <div class="modal-footer">



        <ul class="inline-menu clearfix portfolio-category " id="portfolio-msnry-sort menu">



            <li class="">



              <a href="cadastro/cliente.php">Cadastre-se</a>



            </li>



            <li>



              <a href="">Entre</a>



            </li>



        </ul>



      </div>



    </div>







    <!-- Home Sectionstart -->



    



    <!-- #contact Section end -->







    <!-- Portfolio Section start -->



    <div class='login'></div>







      <div id="home" class="padd-tb-120 portfolio-top">



        <!--<?=$mercado." ".$arquivo;?>-->



        <div class="portfolio-inner">



          <div class="container">



            <div class="row">



              <div class="col-sm-12">



               <!-- <ul class="inline-menu inline-menuu clearfix portfolio-category" id="portfolio-msnry-sort menu">







                </ul>-->



              </div>



            </div>



            <div class="titulo">



              



            </div>



            







          </div>



        </div>



        



      </div>



<!-- .container end -->







                        











      <div class="container">



        <div class="row produto center-align">







        </div>



        <br><br>



        <div id="historico">



        







        </div><br><br>



 



        <div class="relacionados">







        </div>



      </div>















      







    <br><br><br>







    <div class="add">



      <button class="add-button btn-Hidden btn brand-bg" id="add">Adicionar a Página Inicial</button>



      <button class="btn red  btn-Hidden darken-4" id="cancel">Cancelar</button>



    </div>







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



    //Funcao para AutoComplete







      var options = {



      url: "./admin/arquivos/produtolsSite.php",







      getValue: "nome",







      list: {



        match: {



          enabled: true



        },



          maxNumberOfElements: 5,







          onClickEvent: function() {



            var selectedItemValue = $("#produto_idd").getSelectedItemData().id;







              $("#produto_id").val(selectedItemValue).trigger("change");



              



              location.href=mercado+"/produto/"+selectedItemValue



          }



          



        }







      };







      $("#produto_idd").easyAutocomplete(options);







      



 



  </script>



  <script src="app.js"></script>







</body>







</html>







<!--https://www.um.es/docencia/barzana/materializecss/modals.html#!



  Materialize 9.7 do template



-->