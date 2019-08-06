
$(document).ready(function(){

	id = retornaId(5);
	//console.log('ID da categoria :  '+id);

	tipo = retornaId(4);

	var mercado = retornaId(3);
    //console.log("Mercado: "+mercado);

	$('.modal-trigger').leanModal();

	//se tiver algum erro ela ficara carregabdi infinitamente
	$(".load").fadeOut("slow",function(){//fadeOut ele some porem ele ainda esta ali e nao deixa usar as coisas na camada de traz

		$(".load").hide();//hide é para sumir, de verdade
	})

	dadosCategoria = localStorage.getItem("cat");

	if (dadosCategoria) {
		// se existir algo no localStorage
	//	console.log("categorias do Cache");
		//string em json
	//	dados = JSON.parse(dadosCategoria);
		//preencher o menu
	//	preencherCategoria(dados);

	/*PARA CARREGAR SEMPRE DO SELECT PARA PODER ATUALIZAR (PROVISORIO)*/
		//console.log("Categorias do JSON - Home");

		//importar as categorias do json
		//getjson para pegar os dados do json
		$.getJSON("json/categoria.php?mercado="+mercado, function(){
			$("#msg").html("<p><img src='images/imagens/load1.gif'> Carregando categorias...</p>");
		}).done(function(dados){
			//se deu certo ele devolve os dados
			
			//transfornmar o json em string
// 			cache = JSON.stringify(dados);
			//guardar os dados no cache
// 			localStorage.setItem("categoriasm",cache);

			preencherCategoria(dados,mercado);
			preencherSubtitle(dados,id)
		}).fail(function(){
			//se deu erro mostrar mensagens
			$("#msg").html("<p>Erro ao carregar categorias...</p>");
		})

	/*fIM PROVISORIO*/
	} else {

		//console.log("Categorias do JSON");

		//importar as categorias do json
		//getjson para pegar os dados do json
		$.getJSON("json/categoria.php?mercado="+mercado, function(){
			$("#msg").html("<p><img src='images/imagens/load1.gif'> Carregando categorias...</p>");
		}).done(function(dados){
			//se deu certo ele devolve os dados
			
			//transfornmar o json em string
// 			cache = JSON.stringify(dados);
			//guardar os dados no cache
// 			localStorage.setItem("categoriasm",cache);

			preencherCategoria(dados,mercado);
			preencherSubtitle(dados,id)
		}).fail(function(){
			//se deu erro mostrar mensagens
			$("#msg").html("<p>Erro ao carregar categorias...</p>");
		})

	}//fim se nao dadosCategoria	

	function preencherCategoria(dados,mercado){
	    console.log("dados")
	    console.log(dados)
		if($.isArray(dados)){
		    
    		$.each(dados, function(key,val) {
    			//.hmtl ele apaga o que tem e coloca o deele ja o prepend e o apend mantem e coloca o dele junto
    			// $(".inline-menuu").prepend("<li><a href='"+mercado+"/categoria/"+val.id+"' data-target=''>"+val.categoria+"</a></li>");
    			$(".inline-menuu").prepend(`
    			<div class="collection">
    				<a  class="collection-item" href='${mercado}/categoria/${val.id}' data-target=''>
    					${val.categoria}
    					</a>
    			</div>`);
    			
    		})
		}
		$("#msg").html('');
	}

	function preencherSubtitle(dados,id){
	    if($.isArray(dados)){
    		$.each(dados, function(key,val) {
    			if ((val.id == id) && (tipo == "categoria")){
    				//.hmtl ele apaga o que tem e coloca o deele ja o prepend e o apend mantem e coloca o dele junto
    				$(".titulo").prepend("<h1 class='about-subtitle black-text'>"+val.categoria+"</h1>");
    			}
    
    			
    		})
	    }
		$("#msg").html('');
	}

})

//fucao para pegar o id
function retornaId(pos){
	pagina = window.location.href;
	//console.log("Pagina:  "+pagina);
	p = pagina.split("/");
	//console.log("Posição: " + p[pos] );
	return p[pos];
}


//funcao para preencher os produtos
function preencherProdutos(dados,mercado){
	$(".produto").html("");
	if($.isArray(dados)){
    	$.each(dados, function(key,val) {
    		//.hmtl ele apaga o que tem e coloca o deele ja o prepend e o apend mantem e coloca o dele junto
    		$(".produto").append(`<div class="col l3 s12 m6 center-align">
              <div class="card">
                <img src="${val.fotop}" class="responsive-img">
                <p  class='nomepro'>${val.nome}</p>
                <p class="valor">R$ ${val.preco}</p>
                <a href="${mercado}/produto/${val.id}" class="btn-large brand-bg white-text">Detalhes</a>
              </div>
            </div>`);
    	});
	}
}

  

