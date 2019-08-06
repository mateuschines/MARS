$(document).ready(function () {
    localStorage.clear("carrinho");
    var mercado = retornaId(3);
    //console.log("Mercado: MERCADO.JS");
      //produtos do cache
      //mercados = localStorage.getItem("mercados");
  
      $.getJSON("json/mercado.php", function(){
          $(".produto").html("<img src='images/imagens/load1.gif'> Carregando Produtos");
      }).done(function(dados) {
  
          //console.log("Carregando Produtos do JSON");
          //jogar dados no .produtos
          preencherMercados(dados);
          //cache = JSON.stringify(dados);
          //localStorage.setItem("mercados", dados);
  
      }).fail(function() {
  
          //console.log("Carregando Produtos do cache");
          //dados = JSON.parse(mercados);
          preencherMercados(dados);
  
      })
  
  })
  

function preencherMercados(dados) {
	$(".protfolio-item").html("");
    if($.isArray(dados)){
    	$.each(dados, function( key, val ) {
    		//mostrar os dados do produto na tela
    		//fazer 2 colunas (4, 8)
    		$(".protfolio-item").prepend(`
    		<li class="single-port-item">
    				<a href="${val.apelido}">
    					<div class="protfolio-image">
    					<img src="${val.logog}" alt="${val.nome}">
    					<div class="protfolio-content waves-effect waves-block waves-light">
    						<div class="protfolio-content__inner">
    						<h2 class="p-title">${val.apelido}</h2>
    						</div>
    					</div>
    					<div class="p-overlay"></div>
    					</div>
    				</a>
    		</li>		
    			`);
    	})
    }
}
  