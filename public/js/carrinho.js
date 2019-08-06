$(document).ready(function(){


	//recuperar a opcao
	op = retornaId(6);
	var mercado = retornaId(3);

	if ( op == "add" ) {

		//console.log("Adicionando produto ao carrinho");
		//recuperar o id
		id = retornaId(5);
		//console.log('Produto '+id);

		produto = JSON.parse( localStorage.getItem("produto"+id) );

		if ( !produto ) {

			$.getJSON("json/produto.php?op=produto&mercado="+mercado+"&id="+id, function(){
				
			}).done(function(dados){
				cache = JSON.stringify(dados);
				localStorage.setItem("produto"+id,cache);
				produto = JSON.parse( cache );
			}).fail(function(){
				$(".produto").html("<p class='nomepro marginpaddin'>Erro ao carregar produto</p>");
			})
		}

		//carrinho

		carrinho = JSON.parse ( localStorage.getItem("carrinho"));
		if ( !carrinho ) {
			//iniciar carrinho
			carrinho = [];
		}
        if (produto == null) {
            setTimeout(function(){  
    		    document.location.reload();
            }, 1000);
        } else {
            $.each(produto, function( key, val ) {
    			//verificar se já existe este item no carrinho
    			c = buscaItem(carrinho, val.id);
    			if ( c == 0 ){
    				//guardar item no carrinho
    				//console.log("Item adicionado ao carrinho: "+val.nome+" "+val.preco);
    
    				//calcular preco total
    				v = val.preco;
    				v = v.replace(",",".");
    				v = parseFloat(v);
    				v = v * 1;
    
    				//criar um item produto para inserir no carrinho
    				p = {
    					id: val.id,
    					nome: val.nome,
    					foto: val.fotop,
    					preco: val.preco,
    					valor: val.valor,
    					total: formatReal(v),
    					qtde: 1,
    					mercado: retornaId(5)
    				};
    				//adicionar o p ao carrinho
    				carrinho.push(p);
    				localStorage.setItem("carrinho", JSON.stringify(carrinho));
    
    			} else {
    				//já tem o item no carrinho
    				alert('O item já foi adicionado ao carrinho');
    			}
    		})
        }
        
	}
	//console.log("Chamar carrinho");
	
	    mostraCarrinho();
	
})




//funcao para buscar item no carrinho
function buscaItem(carrinho,id) {
	c = 0;
    	$.each(carrinho, function ( key, val ){
    		if ( val.id == id ) c++;
    	})
	//console.log("Itens: "+c);
	return c;
}

//função para mostrar o carrinho
function mostraCarrinho() {

	
	//pegar o carrinho do cache
	carrinho = localStorage.getItem("carrinho");

	if ( !carrinho ) {

		//console.log("Sem produtos no carrinho");
		$(".produto").html("<p class='nomepro marginpaddin'>Não existe nenhum item no seu carrinho</p>");

	} else {
		//console.log('Mostrando produtos do carrinho');
		carrinho = JSON.parse( carrinho );
		
    		$(".produto").html(`<h2 class="about-subtitle black-text">Carrinho</h2>
    		<table class='nomepro'>
    			<thead>
    				<tr>
    					<td>Foto</td>
    					<td>Nome</td>
    					<td>Quantidade</td>	
    					<td>Valor</td>	
    					<td>Total</td>								
    					<td>Excluir</td>
    				</tr>
    			</thead>
    
    			<tbody class='tbody'>
    
    			</tbody>
    		</table>
    		<table class='nomepro'>
    		<thead>
    		<tr>
    			<td></td>
    		</tr>
    		</thead>
    		<tbody>
    			<td>Total</td>
    			<td></td>
    			<td id="somatotal"></td>
    		</tbody>
    			<br>
    		</table>
    		<p>
    			<button type='button' class='btn-large red white-text' onclick='limpar()'>Limpar Carrinho</button>
    			<button type='button' class='BotaoFinalizar btn-large green white-text' onclick='comprar()'>Finalizar</button>
    			<div class='marginpaddincarrinho'></div>
    		</p>`);

		//mostrar as linhas dos produtos no tbody
		let somatotal = 0.00;
		
		$.each(carrinho, function ( key, val ){
			//console.log(val);
			$(".tbody").append(`<tr id='linha${key}'>
					<td><img src="${val.foto}" width='70px'></td>
					<td>${val.nome}</td>
					<td><input id="quantidade${key}" type="number" name="quantidade" class="validate" required value="${val.qtde}" onblur="mudarQuantidade(${key},${val.id})"></td>
					<td>R$ ${val.preco}</td>	
					<td>R$ ${val.total}</td>				
					<td>
						<button type='button' class='BotaoExcluirProduto btn-large red white-text' onclick='remover(${key})'><i class='mdi-action-highlight-remove'></i></button>
					</td>
				</tr>`);

				somatotal += parseFloat(val.total.replace(',','.'));
		
				//total = val.valor + total;
		});
		$('#somatotal').html("R$ "+somatotal.toFixed(2).replace('.',','));

	}

}

// function total(){

// 	 $.each(carrinho, function ( key, value ){

// 	 	 total = value.valor++

// 	 })
// 	 return total;
// }

//funcao para remover item do carrinho
function remover(id) {
	var mercado = retornaId(3);
	if ( confirm ( "Deseja mesmo excluir?") ){
		//console.log("Excluir Produto "+id);
		carrinho = JSON.parse( localStorage.getItem("carrinho") );
		carrinho.splice(id, 1);
		carrinho = JSON.stringify( carrinho );
		localStorage.setItem("carrinho", carrinho);
		location.href=mercado+"/carrinho"
	}
}

//funcao para apagar o carrinho
function limpar() {
	var mercado = retornaId(3);
	if ( confirm ( "Deseja mesmo limpar o carrinho?" ) ) {
		//limpa esta variavel do cache
		localStorage.clear("carrinho");
		location.href=mercado+"/carrinho";
	}
}





function comprar(){

	let carrinho = localStorage.getItem("carrinho");

	quantidade = $('#quantidade').val();
	var mercado = retornaId(3);

	$.post("https://mateuschineis.tk/carrinho.php",{data: carrinho, mercado: mercado},function(dadosResposta){

		    dadosResposta = dadosResposta.split("|");
		    console.log(dadosResposta)
    		if ( dadosResposta[0] == 1) {
    			alert(dadosResposta[1]);
    		} else {
    			localStorage.clear("carrinho");
    			console.log(mercado+"/pagamento/"+dadosResposta[1]);
    			alert("Sua compra foi realizada com sucesso!");
    			location.href=mercado+"/pagamento/"+dadosResposta[1];
    		}

	});

}


function mudarQuantidade(key,id) {
	qtde = $("#quantidade"+key).val();

	//retirar este produto do carrinho
	carrinho = JSON.parse( localStorage.getItem("carrinho") );
	carrinho.splice(key, 1);
	carrinho = JSON.stringify( carrinho );
	localStorage.setItem("carrinho", carrinho);

	//adicionar o produto com nova quantidade
	produto = JSON.parse( localStorage.getItem("produto"+id) );

	carrinho = JSON.parse ( localStorage.getItem("carrinho"));
	if ( !carrinho ) {
		//iniciar carrinho
		carrinho = [];
	}

	$.each(produto, function( key, val ) {
		//verificar se já existe este item no carrinho

		c = buscaItem(carrinho, val.id);
		if ( c == 0 ){
			//guardar item no carrinho
			//console.log("Item adicionado ao carrinho: "+val.nome);

			//calcular preco total
			v = val.preco;
			v = v.replace(",",".");
			v = parseFloat(v);
			v = v * qtde;

			//criar um item produto para inserir no carrinho
			p = {
				id: val.id,
				nome: val.nome,
				foto: val.fotop,
				preco: val.preco,
				valor: val.valor,
				total: formatReal(v),
				qtde: qtde,
				mercado: val.mercado
			};
			//adicionar o p ao carrinho
			carrinho.push(p);
			localStorage.setItem("carrinho", JSON.stringify(carrinho));

		} else {
			//já tem o item no carrinho
			alert('O item já foi adicionado ao carrinho');
		}
	})

	//atualizar o carrinho de compras
	mostraCarrinho();

}

function formatReal( int )
{
	return (int).toLocaleString('pt-BR', {
		// Ajustando casas decimais
		minimumFractionDigits: 2,  
		maximumFractionDigits: 2
	});
}