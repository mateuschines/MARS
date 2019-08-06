
$(document).ready(function(){

	id = retornaId(5);
	console.log("idproduto"+id)
	var mercado = retornaId(3);

	if ( id == undefined ) {
		//se o produto nao existir
		alert('Produto inexistente');
		location.href='index.php';
	} else {

		//recuperar do cache
		produto = localStorage.getItem("produto"+id);

		//verificar se o produto existe no cache
		if ( produto ) {
			//produto do cache
		//	dados = JSON.parse(produto);
		//	preencherProduto(dados);
		//	console.log("Produto carregado do cache");

		/*PARA CARREGAR SEMPRE DO SELECT PARA PODER ATUALIZAR (PROVISORIO)*/
			//produto do json
			$.getJSON("json/produto.php?op=produto&mercado="+mercado+"&id="+id, function(){
				$(".produto").html("<img src='images/imagens/load1.gif'> Carregando produtos...");
			}).done(function(dados1){
				preencherProdutos(dados1,mercado);
				//cache = JSON.stringify(dados1);
				//localStorage.setItem("produto"+id, cache);
				//console.log("Produto armazenado no cache");

			}).fail(function(){
				$(".produto").html("<p class='nomepro marginpaddin'>Não tem Produtos cadastrados</p>");
				
			})

			$.getJSON("json/produtoAntigaPromocao.php?op=produto&mercado="+mercado+"&id="+id, function(){
				$(".grafico").html("<img src='images/imagens/load1.gif'> Carregando produtos...");
				
			}).done(function(dados2){
				preencherGrafico(dados2);
			}).fail(function(){
				$("#grafico").html(`
				<p class='nomepro center-align'>Este produto não tem historico de preço!</p><br>
			`);
				
			})

			$.getJSON("json/produtosRelacionados.php?op=produto&mercado="+mercado+"&id="+id, function(){
				
			}).done(function(dados3){
				produtosRelacionados(dados3,mercado);
			}).fail(function(){
				$(".grafico").html("<p class='nomepro marginpaddin'>Não tem produtos relacionados</p>");
			})

		/*fIM PROVISORIO*/
		} else {
			//produto do json
			$.getJSON("json/produto.php?op=produto&mercado="+mercado+"&id="+id, function(){
				$(".produto").html("<img src='images/imagens/load1.gif'> Carregando produtos...");
			}).done(function(dados1){
				preencherProdutos(dados1,mercado);
				//cache = JSON.stringify(dados1);
				//localStorage.setItem("produto"+id, cache);
				
			}).fail(function(jqXHR, textStatus, errorThrown){

				$(".produto").html("<p class='nomepro marginpaddin'>Não tem Produtos cadastrados</p>");
				
			})

			$.getJSON("json/produtoAntigaPromocao.php?op=produto&mercado="+mercado+"&id="+id, function(){
				
			}).done(function(dados2){
				preencherGrafico(dados2);
			}).fail(function(){
				$("#grafico").html(`
				<p class='nomepro marginpaddin'>Este produto não tem historico de preço!</p>
			`);
				
			})

			$.getJSON("json/produtosRelacionados.php?op=produto&mercado="+mercado+"&id="+id, function(){
				
			}).done(function(dados3){
				produtosRelacionados(dados3,mercado);
			}).fail(function(){
				$(".grafico").html("<p class='nomepro marginpaddin'>Não tem produtos relacionados</p>");
			})
		}
	}

})

function preencherProdutos(dados1,mercado) {
    if($.isArray(dados1)){
    	$.each(dados1, function( key, val ) {
    		//mostrar os dados do produto na tela
    		//fazer 2 colunas (4, 8)
    		$(".produto").html(`
    			<div class="row">
    
    	            <div class="col-sm-6 col-md-4">
    	              <div class="person-img">
    	                <img class="z-depth-1" src="${val.fotog}" alt="${val.nome}">
    	              </div>
    	            </div>
    	            <!-- about me image -->
    
    	            <div class="col-sm-6 col-md-4">
    	              
    	                <div class="person-about">
    	                <h3 class="about-subtitle">${val.nome} <div class="red-text"> R$ ${val.preco}</div></h3>
    	                
    	                <p>${val.descricao}</p>
    	                <p>Esta Promoção expira em ${val.dataFinal}</p>
    	                <a class="waves-effect waves-light btn-large brand-bg white-text" href='${mercado}/carrinho/${val.id}/add' >Adicionar ao carrinho</a>
    	              
    	            </div>
    	            <div class='marginpaddincarrinho'></div>
    			</div>
    			`);
    	})
    }

}

function preencherGrafico(dados2) {
	$("#historico").html(`
	<h2 class="about-subtitle black-text">Historico de Preços</h2>
            <table class='nomepro'>
                <thead>
                    <tr>
                        <td>Produto</td>
                        <td>Data Do inicio da Promoção</td>
                        <td>Data Do fim da Promoção</td>
                        <td>Valor da Promoção anterior</td>
                    </tr>
                </thead>
    
                <tbody id='grafico'>
    
                </tbody>
			</table>`);
			if($.isArray(dados2)){
    			setTimeout(() => {
    
    				$.each(dados2, function ( key, val ){
    					
    					$("#grafico").append(`<tr id='linha${key}'>
    							<td>${val.nome}</td>
    							<td>${val.dataInicial}</td>
    							<td>${val.dataFinal}</td>
    							<td>R$ ${val.preco}</td>
    						</tr>
    						`);
    						//total = val.valor + total;
    						//<button data-target="modal1" class='btn modal-trigge waves-effect waves-light btn-large blue white-text' onclick='modal(${val.carrinho_id})'>I</button>
    				});
    			},1500)
			}
		
       

}


function produtosRelacionados(dados, mercado) {
    var mercado = retornaId(3);
	var carrinho = retornaId(4);

	$(".relacionados").html(`<h2 class="about-subtitle black-text">Produtos Relacionados</h2>`);
	if($.isArray(dados)){
    	$.each(dados, function (key,val) {
    	$(".relacionados").append(`
    			
    					<div class="col-sm-6 col-md-4">
    					<div class="card center-align">
    						<a href='${mercado}/produto/${val.id}'>
    							<div class="person-img">
    								<img class="" src="${val.foto}" alt="${val.nome}">
    								<p>${val.nome}</p>
    								<p class='valor'>R$ ${val.preco}</p>
    							</div>
    						</a>
    						</div>
    					</div>
    				`);
    		});
	}
       

}
