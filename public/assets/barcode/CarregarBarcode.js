var sound = new Audio("assets/barcode/barcode.wav");

op = retornaId(6);
var mercado = retornaId(3);

$(document).ready(function() {

	barcode.config.start = 0.1;
	barcode.config.end = 0.9;
	barcode.config.video = '#barcodevideo';
	barcode.config.canvas = '#barcodecanvas';
	barcode.config.canvasg = '#barcodecanvasg';
	barcode.setHandler(function(barcode) {
        //$('#result').html("json/produtoBarcode.php?op=barcode&mercado="+mercado+"&id="+barcode);
        $.getJSON("json/produtoBarcode.php?op=barcode&mercado="+mercado+"&id="+barcode,function(){
		}).done(function(dados){
            sound.play();
            $.each(dados, function ( key, val ){
                //console.log("chinesss "+val.id)
                sound.play();
                location.href=mercado+"/produto/"+val.id
            });
        }).fail(function(){
            sound.play();
            $("#result").html("<p class='nomepro marginpaddin valorp red-text'>Não tem produtos cadastrados.</p>");
        })
	});
	barcode.init();

	// $('#result').bind('DOMSubtreeModified', function(e) {
    //     sound.play();
	// });

});