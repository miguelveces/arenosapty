$(document).ready(function(){
	var contenidoHTML = '<p> <form action="gridTarjeta.php" method="POST"> <label> No. Tarjeta </label><input type="int" name="tarjeta" id="notarje" class="form-input-corto" required/> <label> Cod. Verificado </label><input type="int" name="codverifi" class="form-input-corto" required/> <div ><br><input class="form-btn" name="submit" type="submit" value="Aceptar" /></div></form></p><div align="right" style="width:170px; margin-top:-46px"> <button class="form-btn" onclick=\"closeModal()\">Cerrar</button></div>';
	var ancho = 300; 
	var alto = 250;
	$('#button').click(function(){
		var bgdiv = $('<div>').attr({
					className: 'bgtransparent',
					id: 'bgtransparent'
					});
		$('body').append(bgdiv);
		var wscr = $(window).width();
		var hscr = $(window).height();
		$('#bgtransparent').css("width", wscr);
		$('#bgtransparent').css("height", hscr);
		var moddiv = $('<div>').attr({
					className: 'bgmodal',
					id: 'bgmodal'
					});	
		$('body').append(moddiv);
		$('#bgmodal').append(contenidoHTML);
		$(window).resize();
	});

	$(window).resize(function(){
		var wscr = $(window).width();
		var hscr = $(window).height();
		$('#bgtransparent').css("width", wscr);
		$('#bgtransparent').css("height", hscr);
		$('#bgmodal').css("width", ancho+'px');
		$('#bgmodal').css("height", alto+'px');
		var wcnt = $('#bgmodal').width();
		var hcnt = $('#bgmodal').height();
		var mleft = ( wscr - wcnt ) / 2;
		var mtop = ( hscr - hcnt ) / 2;
		$('#bgmodal').css("left", mleft+'px');
		$('#bgmodal').css("top", mtop+'px');
	});
	
 });
	
function closeModal(){
	$('#bgmodal').remove();
	$('#bgtransparent').remove();
}