$(document).ready(function(){
    $("#historico").hide();

	//recuperar a opcao
	id = retornaId(5);
    
    //buscar em um json os dados da venda - nome co cliente, email e id da venda

    $.getJSON("json/venda.php?venda="+id, function(){
        $(".produto").html("<img src='images/imagens/load1.gif'> Carregando produto...");
    }).done(function(dados){
        
        //JOGAR OS DADOS NA TELA
        preencherVenda(dados);

    }).fail(function(){
        $(".produto").html("<p class='nomepro marginpaddin'>Não foi possivel realizar pagamento, pois não existe produto!</p>");
    })

    //buscar em um json os itens vendidos


    
})

function preencherVenda(dados) {
    
    let somatotal = 0.00;
    let totaal = 0.00;
    if($.isArray(dados)){
    	$.each(dados, function( key, val ) {
            //onSubmit="atualiza()" 
            $(".produto").html(`
            <form target="pagseguro" method="post" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" onSubmit="atualiza()" >
                
            <input name="receiverEmail" type="hidden" value="mateus-chineis@live.com">  
            <input name="currency" type="hidden" value="BRL">  
            <input name="encoding" type="hidden" value="UTF-8">  
            <input name="shippingType" type="hidden" value="3"> 
     
            <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
            <input name="itemId1" type="hidden" value="0001">  
            <input name="itemDescription1" type="hidden" value="Compra No Site MARS">  
            <input name="itemAmount1" type="hidden" id="totalForm">  
            <input name="itemQuantity1" type="hidden" value="1">  
            <input name="itemWeight1" type="hidden" value="0">  
     
            <!-- Código de referência do pagamento no seu sistema (opcional) -->  
             <input name="reference" type="hidden" value="Chines"> 
                
            
                <h2 class="about-subtitle black-text">Pague com PagSeguro</h2>
                <div class="input-field">
                    <input class='nomepro' type="text" name="senderName">
                    <label for="senderName" class="input-label">Nome Completo</label>
                </div>
                <div class="input-field">
                    <input class='nomepro' type="text" name="senderEmail">
                    <label for="senderEmail" class="input-label">Email</label>
                </div>
                <!-- Dados do comprador (opcionais) -->  
                <!-- <input name="senderName" type="text" >    -->  
                <!-- <input name="senderEmail" type="text"> --> 
            
                <p class="nomepro">Valor da sua Compra: <span id="total"></span></strong></p>
                <button alt="Pague com PagSeguro" name="submit" type="submit" class="btn">Efetuar Pagamento</button>
                    
                <br><p class="text-center nomepro"><small>* Você será direcionado para a tela de pagamento do PagSeguro, nela você poderá selecionar o modo de pagamento desejado (Boleto ou Cartão de Crédito), bem como forma e parcelamento (parcelas acima de R$ 5,00)</small></p>
               <!-- <input alt='Pague com PagSeguro' name='submit' type='image' src='https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/205x30-comprar.gif'/> -->
    
                    <!--  <p class="text-center">
                    <button alt="Pague com PagSeguro" name="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Efetuar Pagamento</button>
                    <br><p class="text-center"><small>* Você será direcionado para a tela de pagamento do PagSeguro, nela você poderá selecionar o modo de pagamento desejado (Boleto ou Cartão de Crédito), bem como forma e parcelamento (parcelas acima de R$ 5,00)</small></p>
                </p> -->
                
            </form>
            `);
            somatotal += parseFloat(val.somaProduto);
    	})
    	}
        
        
    


    
    $('#total').html("R$ "+somatotal.toFixed(2).replace('.',','));
    let muda = somatotal.toFixed(2);
    $('#totalForm').val(muda);

}

function atualiza() {
    setTimeout(function(){ 
        location.href="index.php";
     }, 2500);
   

}