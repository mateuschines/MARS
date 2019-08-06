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
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/imagens/icon3.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div id="loader"></div>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner col col-lg-12 col-md-11 col-sm-10 col-10">
            <div class="logo text-uppercase"><img id="logo-ma" src="img/imagens/LogoVerdee.png"></div>
          
            <form method="post" action="paginas/verificacao.php" class="text-left form-validate">
              <div class="form-group-material">
                <input id="login-username" type="text" name="login" required data-msg="Por favor digite seu usuário" class="input-material">
                <label for="login-username" class="label-material">Usuário</label>
              </div>
              <div class="form-group-material">
                <input id="login-password" type="password" name="senha" required data-msg="Por favor digite sua senha" class="input-material">
                <label for="login-password" class="label-material">Senha</label>
              </div>
              <div class="form-group text-center"><button type="submit" id="login" class="btn btn-primary">Entrar</button>
                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
              </div>
            </form><a href="register.php" class="forgot-pass">Esqueceu a Senha?</a>
          </div>
          </div>
          <div class="copyrights text-center">
            <p>Design by Bootstrapious</p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>

    <!--Loader para carregar apaguiNA-->
    <!--
    <script type="text/javascript">
      // Este evendo é acionado após o carregamento da página
      $(window).load(function () {
          //Após a leitura da pagina o evento fadeOut do loader é acionado, esta com delay para ser perceptivo em ambiente fora do servidor.
          jQuery("#loader").delay(2000).fadeOut("slow");
      });
    </script>-->
  </body>
</html>