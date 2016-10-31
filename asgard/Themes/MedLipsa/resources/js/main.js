function init(){
	resetTimers();
	
	$("#ListaAnunturi").on('click', 'a.buton-situatia', function(e){
			var id = $(this).data('id');
			$('a.buton-situatia[data-id='+id+'],.sit[data-id='+id+']').toggleClass("hidden");
	});
	
	$("form.search_form").on('submit', function(e){
		e.preventDefault();
		if($(this).data('submitting'))
			return false; //double submit

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: $(this).serialize(),
			context: this,
	//			dataType: 'json',
			success: function(data){
				$(this).data('submitting', false).removeClass('submitting');
				$("#ListaAnunturi").html(data);
				resetTimers();
			},
			error: function(xhr) {
				$(this).data('submitting', false).removeClass('submitting');

			}
		});
	});
}

function resetTimers(){
	$('p.timer[data-ts]').each(function(){
		cdown.add(new Date($(this).data('ts')), $(this).attr('id'));
	});
}

$(document).ready(init);