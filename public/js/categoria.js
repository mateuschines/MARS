$(document).ready(function(){
	//id = retornaId(6);
	id = retornaId(5);
	console.log('ID da categoria :  '+id);

	var mercado = retornaId(3);
    //console.log("Mercado: "+mercado);

	produtos = localStorage.getItem("categoria"+id);

	if (produtos) {
	//	console.log("Produtos do cache");
	//	dados = JSON.parse(produtos);
	//	preencherProdutos(dados);

	/*PARA CARREGAR SEMPRE DO SELECT PARA PODER ATUALIZAR (PROVISORIO)*/
		//console.log("Produtos do JSON");
		$.getJSON("json/produto.php?op=categoria&mercado="+mercado+"&id="+id,function(){
			$(".produto").html("<img src='images/imagens/load1.gif'> Carregando produtos...");

		}).done(function(dados){
			preencherProdutos(dados,mercado);
			//cache = JSON.stringify(dados);
			//localStorage.setItem("categoria"+id,cache);

		}).fail(function(){
			$(".produto").html("<p class='nomepro marginpaddin'>Não tem produtos cadastrados.</p>");

		})	

	/*fIM PROVISORIO*/

	} else {
		//console.log("Produtos do JSON");
		$.getJSON("json/produto.php?op=categoria&mercado="+mercado+"&id="+id,function(){
			$(".produto").html("<img src='images/imagens/load1.gif'> Carregando produtos...");

		}).done(function(dados){
			preencherProdutos(dados,mercado);
			//cache = JSON.stringify(dados);
			//localStorage.setItem("categoria"+id,cache);

		}).fail(function(){
			$(".produto").html("<p class='nomepro marginpaddin'>Não tem produtos cadastrados.</p>");

		})
	}
})