<?php

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









  $pagina = "mercado";







  if ( isset ($_GET["param"])) {



    $param = trim ($_GET["param"]);







    $param = explode("/", $param);







    $mercado = $param[0];







    if ( isset ( $param[1] ) )  $pagina = $param[1];







    if ( empty ( $pagina ) ) $pagina = "mercado";



  }







  $arquivo = $pagina.".js"; 



  



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

  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>

  <base href="https://mateuschineis.tk/">



  <!-- Favicon-->



  <link rel="shortcut icon" href="images/icon.png" >







  <!-- Stylesheets -->



  <link type="text/css" rel="stylesheet" href="assets/css/normalize.css">



  <link type="text/css" rel="stylesheet" href="assets/font/font-awesome/css/font-awesome.min.css">



  <link type="text/css" rel="stylesheet" href="assets/libs/materialize/css/materialize.min.css" media="screen,projection" />



  <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.css" media="screen,projection" />







  <link type="text/css" rel="stylesheet" href="assets/css/animate.min.css" media="screen,projection" />



  <link type="text/css" rel="stylesheet" href="assets/libs/sweetalert/sweet-alert.css" media="screen,projection" />







  <link type="text/css" rel="stylesheet" href="assets/libs/owl-carousel/owl.carousel.css" media="screen,projection" />



  <link type="text/css" rel="stylesheet" href="assets/libs/owl-carousel/owl.transitions.css" media="screen,projection" />



  <link type="text/css" rel="stylesheet" href="assets/libs/owl-carousel/owl.theme.css" media="screen,projection" />



  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">







  <link type="text/css" rel="stylesheet" href="assets/css/main.css">



  <link type="text/css" rel="stylesheet" href="assets/css/style.css">



  <link type="text/css" rel="stylesheet" href="assets/css/responsive.css">







  <!-- Choose your default colors -->



  <link type="text/css" rel="stylesheet" href="assets/css/colors/color4.css">



  <link rel="manifest" href="webmanifest.json">



  <!-- JavaScripts -->



  <script type="text/javascript" src="assets/js/jquery.min.js"></script>







  <script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>



  <script type="text/javascript" src="assets/js/detectmobilebrowser.js"></script>



  <script type="text/javascript" src="assets/js/isotope.pkgd.min.js"></script>



  <script type="text/javascript" src="assets/js/wow.min.js"></script>



  <script type="text/javascript" src="assets/js/waypoints.js"></script>



  <script type="text/javascript" src="assets/js/jquery.counterup.min.js"></script>



  <script type="text/javascript" src="assets/js/jquery.nicescroll.min.js"></script>



  <!-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script> -->



  <!-- <script src="assets/js/gmaps.js"></script> -->



  <script type="text/javascript" src="assets/libs/owl-carousel/owl.carousel.min.js"></script>



  <script type="text/javascript" src="assets/libs/materialize/js/materialize.min.js"></script>



  <script type="text/javascript" src="assets/libs/jwplayer/jwplayer.js"></script>



  <script type="text/javascript" src="assets/libs/sweetalert/sweet-alert.min.js"></script>



  <script type="text/javascript" src="assets/js/common.js"></script>



  <script type="text/javascript" src="assets/js/main.js"></script>



  <script type="text/javascript" src="assets/js/leanModal.js"></script>







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







    <!-- Portfolio Section start -->



    <section id="portfolio" class="scroll-section root-sec white portfolio-wrap">



      <div class="padd-tb-55 brand-bg portfolio-top">



        <div class="portfolio-inner">



          <div class="container">



            <div class="row">



              <div class="col-sm-12">



                <h2 class="title">



                <?php



                if (isset($_SESSION["site"]["id"])){



                  echo strtoupper($_SESSION["site"]["nome"]);



                 } ?>  



                Selecione o Mercado</h2>



              </div>



            </div>



          </div>



        </div>



        <!-- .container end -->



      </div>







      <div class="portfolio-bottom">



        <div class="container">



          <div class="row">



            <div class="col-sm-12">



              <ul class="clearfix protfolio-item" id="protfolio-msnry">



              



              <!-- Single Portfolio-->



                



                  



                



                <!--/ single portfolio -->



















              </ul>



            </div>



          </div>



        </div>



      </div>



    </section>



    <!-- #portfolio Section end -->

    

    <br><br>

     <div class="add">



      <button class="add-button btn-Hidden btn brand-bg" id="add">Adicionar a Página Inicial</button>



      <button class="btn btn-Hidden red darken-4" id="cancel">Cancelar</button>



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



  <script src="app.js"></script>

  





</body>







</html>







<!--https://www.um.es/docencia/barzana/materializecss/modals.html#!



  Materialize 9.7 do template



-->