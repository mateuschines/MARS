var sound = new Audio("barcode.wav");

$(document).ready(function() {

	barcode.config.start = 0.1;
	barcode.config.end = 0.9;
	barcode.config.video = '#barcodevideo';
	barcode.config.canvas = '#barcodecanvas';
	barcode.config.canvasg = '#barcodecanvasg';
	barcode.setHandler(function(barcode) {
		
		$("#codigoDeBarra").val(barcode);
		$('#myModal').modal('hide');
		sound.play();
		
	});
	barcode.init();
});