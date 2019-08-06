var sound = new Audio("assets/barcode/barcode.wav");

$(document).ready(function() {

    id = retornaId(5);
    var mercado = retornaId(3);
    //produtos = localStorage.getItem("categoria"+id);

	barcode.config.start = 0.1;
	barcode.config.end = 0.9;
	barcode.config.video = '#barcodevideo';
	barcode.config.canvas = '#barcodecanvas';
	barcode.config.canvasg = '#barcodecanvasg';
	barcode.setHandler(function(barcode) {
        //$('#result').html(barcode);
        //location.href=mercado+"/barcode/"+barcode

        $.getJSON("json/produto.php?op=barcode&mercado="+mercado+"&id="+barcode,function(){
		}).done(function(dados){
			preencherProdutos(dados,mercado);

		}).fail(function(){
			$("#result").html("<p class='nomepro marginpaddin valorp red-text'>Não tem produtos cadastrados.</p>");

		})
	});
	barcode.init();

	$('#result').bind('DOMSubtreeModified', function(e) {
        sound.play();
	});

});