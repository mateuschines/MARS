$(document).ready(function(){

	id = retornaId(5);
    var mercado = retornaId(3);
    //var carrinho = retornaId(6);
    //console.log("id cliente " +id + " mercado " + mercado);
    

    $.getJSON("json/comprasRealizadas.php?&mercado="+mercado+"&id="+id, function(){
        $(".produto").html("<img src='images/imagens/load1.gif'> Carregando produtos...");
    }).done(function(dados){
        listaDeCompras(dados);
    }).fail(function(){
        $(".produto").html("<p class='nomepro marginpaddin black-text'>Voçê não fez nenhuma compra</p>");
    })
 

})//fim ready function

function listaDeCompras(dados) {
    var mercado = retornaId(3);
    var carrinho = retornaId(4);

    $(".produto").html(`<h2 class="about-subtitle black-text">Compras Realizadas</h2>
            <table class='nomepro'>
                <thead>
                    <tr>
                        <td>Nome Do Mercado</td>
                        <td>Data Da Compra</td>
                        <td>Valor total</td>						
                        <td>Relatório</td>
                    </tr>
                </thead>
    
                <tbody class='tbody'>
    
                </tbody>
            </table>
            `);
		$.each(dados, function ( key, val ){
			$(".tbody").append(`<tr id='linha${key}'>
					<td>${val.nome}</td>
					<td>${val.data}</td>
					<td>R$ ${val.preco}</td>	
                    <td>
                        <a href='salvar/gerarRelPDF.php?id=${val.carrinho_id}' class='waves-effect waves-light btn-large blue white-text' target='_blank'>|</a>
						
					</td>
                </tr>
                `);
		
                //total = val.valor + total;
                //<button data-target="modal1" class='btn modal-trigge waves-effect waves-light btn-large blue white-text' onclick='modal(${val.carrinho_id})'>I</button>
		});
       

}
