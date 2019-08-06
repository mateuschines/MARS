<form target="pagseguro" method="post" action="https://pagseguro.uol.com.br/checkout/v2/payment.html">
    <!-- Campos obrigatórios https://ws.sandbox.pagseguro.uol.com.br/v2/checkout  https://pagseguro.uol.com.br/checkout/v2/payment.html -->  
    
    <input name="receiverEmail" type="hidden" value="mateus-chineis@live.com">  
    <input name="currency" type="hidden" value="BRL">  
    <input name="encoding" type="hidden" value="UTF-8">  
    <input name="shippingType" type="hidden" value="3"> 

    <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
    <input name="itemId1" type="hidden" value="0001">  
    <input name="itemDescription1" type="hidden" value="Inscrição no Vestibular (33) - Inscrição: 0002683">  
    <input name="itemAmount1" type="hidden" value="50.00">  
    <input name="itemQuantity1" type="hidden" value="1">  
    <input name="itemWeight1" type="hidden" value="0">  

    <!-- Código de referência do pagamento no seu sistema (opcional) -->  
    <input name="reference" type="hidden" value="vestibular-0002683">  

    <!-- Dados do comprador (opcionais) -->  
    <input name="senderName" type="text" >    
    <input name="senderEmail" type="text"> 

    <p class="text-center valor"><strong>Valor da Inscrição: R$ 50,00</strong></p>

    <p class="text-center">
        <button alt="Pague com PagSeguro" name="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Efetuar Pagamento</button>
        <br><p class="text-center"><small>* Você será direcionado para a tela de pagamento do PagSeguro, nela você poderá selecionar o modo de pagamento desejado (Boleto ou Cartão de Crédito), bem como forma e parcelamento (parcelas acima de R$ 5,00)</small></p>
    </p>
</form>