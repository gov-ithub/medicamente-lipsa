function init(){
	resetTimers();
	
	$("#ListaAnunturi").on('click', 'a.buton-situatia', function(e){
			var id = $(this).data('id');
			$('a.buton-situatia[data-id='+id+'],.sit[data-id='+id+']').toggleClass("hidden");
	});

	$('#ListaAnunturi').jscroll({
		debug: true,
		autoTrigger: true,
		nextSelector: 'a.next_page',
		loadingHtml: '<div class="center cssload-jumping"><i></i><i></i><i></i><i></i><i></i></div>',
		autoTriggerUntil: 5,
//		nextSelector: '.pagination li.active + li a',
//		contentSelector: '#ListaAnunturi',
		callback: function() {
			//again hide the paginator from view
			$('ul.pagination:visible:first').hide();

		}
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
				$(this).data('submitting', false);
				cdown.reset();
				$("#ListaAnunturi").html(data);
				resetTimers();
				FB.XFBML.parse();
			},
			error: function(xhr) {
				$(this).data('submitting', false);

			}
		});
	});
	
	$( "#pasul1" ).click(function() {
		$("#pagina-2").removeClass("hidden");
		$("#pasul1").addClass("hidden");
		$("html, body").animate({ scrollTop: $("#pagina-2").offset().top }, 600);
	});
	$( "#persoana-contact" ).click(function() {
		$("#pagina-persoana").removeClass("hidden");
		$("#persoana-contact").addClass("hidden");
		//$(document).scrollTop( $("#pagina-persoana").offset().top );
		 $("html, body").animate({ scrollTop: $("#pagina-persoana").offset().top }, 600);
	});
	$( "#pasul2" ).click(function() {
		$("#pagina-3").removeClass("hidden");
		$("#pasul2").addClass("hidden");
		$("html, body").animate({ scrollTop: $("#pagina-3").offset().top }, 600);
	});
}

function resetTimers(){
	$('p.timer[data-ts]').each(function(){
		cdown.add(new Date($(this).data('ts')), $(this).attr('id'));
	});
}

$(document).ready(init);