$(document).ready(function(){

	id = retornaId(5);
    var mercado = retornaId(3);
    var carrinho = retornaId(4);

    loginSistema();
 

})//fim ready function

function loginSistema() {
    var mercado = retornaId(3);
    var carrinho = retornaId(4);
	
    $(".login").html(`
    <br><br>
    <section id="contact" class="scroll-section root-sec brand-bg padd-tb-120 contact-wrap">
    <div class="container">
      <div class="row">
        <div class="contact-inner">
          <div class="col-sm-12 card-box-wrap">
            <div class="row">
              <div class="clearfix section-head contact-text">
                <div class="col-sm-12">
                  <h2 class="title">Entrar</h2>
                </div>
              </div> <!-- contact text end -->

              <div class="clearfix contact-form">
                <div class="col-sm-12">
                  <div class="clearfix card-panel grey lighten-5 cform-wrapper">
                    <form action="verificar.php" method="post" id="contactForm" novalidate data-parsley-validate>    
                    <input type="hidden" name="carrinho" value="`+carrinho+`">
                    <input type="hidden" name="mercado" value="`+mercado+`">                 
                      <div class="input-field">
                        <input autocomplete="off" id="email" type="email" name="email" class="validate input-box" required data-parsley-required-message="<script>alert('Preencha o e-mail');</script>">
                        <label for="email" class="input-label">Email</label>
                      </div>
                      <div class="input-field">
                        <input autocomplete="off" id="" type="password" name="senha" class="validate input-box" data-parsley-required-message="<script>alert('Preencha a senha');</script>">
                        <label for="senha" class="input-label">Senha</label>
                      </div>
                      <div class="input-field submit-wrap clearfix">
                        <button type="submit" class="left waves-effect btn-flat brand-text submit-btn">Entrar</button>
                        <div class="right form-loader-area">
                          <svg class="circular size-20" height="20" width="20">
                            <circle class="path" cx="10" cy="10" r="7" fill="none" stroke-width="3" stroke-miterlimit="10" />
                          </svg>
                        </div>
                      </div>
                      <div class="input-field submit-wrap clearfix">
                        <a href="cadastro/cliente.php" class="left waves-effect btn-flat brand-text submit-btn">Não Sou Cadastrado</a>
                        <div class="right form-loader-area">
                          <svg class="circular size-20" height="20" width="20">
                            <circle class="path" cx="10" cy="10" r="7" fill="none" stroke-width="3" stroke-miterlimit="10" />
                          </svg>
                        </div>
                      </div>
                      <div class="input-field submit-wrap clearfix">
                        <a href="forgot.php" class="left waves-effect btn-flat brand-text submit-btn">Esqueceu a Senha?</a>
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
        `);

}