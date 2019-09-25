$(document).ready(function(){

	console.log("scripts.js loaded");

	$('#doacao').on('click',function(e){
		e.preventDefault();
		$('#form_doacao').slideToggle();
	});

	$('#form_doacao').on('submit', function(e){
		//prevent form from submitting
		e.preventDefault();

		var formdata = $('#form_doacao').serializeArray();

		data = {
			action: 'do_doacao',
			valor_doacao: formdata.find(data => data.name == "doacao").value,
			especie_id: formdata.find(data => data.name == "especie_id").value
		}

		$.post(ajaxurl, data, function(response){
			if(response.success){
				$("#total_doado").text(response.new_total);
				$('#inpt_doacao').val('');
				alert("Obrigado por sua doação");
			}else{

			}
		});

	});

	$('.registrar-evento').on('click', function(e){
		e.preventDefault();

		data = {
			'action' : 'do_registrar_evento',
			'user_id' : $('.registrar-evento').data('user'),
			'evento_id' : $('.registrar-evento').data('evento')
		}

		$.post(ajaxurl, data, function(response){
			if(response.success){
				location.reload();
			}else{

			}
		});

	});

	$('#eventos-select').on('change', function(e){
		e.preventDefault();
		var cat_id = $('#eventos-select').find(":selected").data('cat_id');
		window.location.href = location.protocol + '//' + location.host + location.pathname + "?cat=" + cat_id ;

	});

});