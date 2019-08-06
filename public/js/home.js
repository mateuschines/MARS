$(document).ready(function () {
  var mercado = retornaId(3);
  //console.log("Mercado: "+mercado);
	//produtos do cache
	//produtos = localStorage.getItem("produtos");

	$.getJSON("json/produto.php?mercado="+mercado, function(){
		$(".produto").html("<img src='images/imagens/load1.gif'> Carregando Produtos");
	}).done(function(dados) {

		//console.log("Carregando Produtos do JSON");
		//jogar dados no .produtos
		preencherProdutos(dados,mercado);
		//cache = JSON.stringify(dados);
		//localStorage.setItem("produtos", dados);

	}).fail(function() {

		//console.log("Carregando Produtos do cache");
		//dados = JSON.parse(produtos);
		preencherProdutos(dados,mercado);

	})

})


