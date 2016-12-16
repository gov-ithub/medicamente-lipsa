function init(){ 
	resetTimers();
	
	$("#ListaAnunturi").on('click', 'a.buton-situatia', function(e){
		var id = $(this).data('id');
		$('a.buton-situatia[data-id='+id+'],.sit[data-id='+id+']').toggleClass("hidden");
	});

	$('#ListaAnunturi').jscroll({
//		debug: true,
		autoTrigger: true,
		nextSelector: 'a.next_page',
		loadingHtml: '<div class="center loader-dots"><i></i><i></i><i></i><i></i><i></i></div>',
		autoTriggerUntil: 5,
//		nextSelector: '.pagination li.active + li a',
//		contentSelector: '#ListaAnunturi',
		callback: function() {
			resetTimers();
			FB.XFBML.parse();
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

	$(document).on('submit', 'form.subscribe_form', function (e) {
		e.preventDefault();
		if ($(this).data('submitting'))
			return false; //double submit

		$('.form-group', this).removeClass('has-error');
		$('.form-group span.help-block', this).remove();
		$(this).data('submitting', true).addClass('submitting');
//		$('button[type=submit] span.submit-label', this).text('Se trimite...');

		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: $(this).serialize(),
			context: this,
	//			dataType: 'json',
			success: function (data) {
				$(this).data('submitting', false).removeClass('submitting');
				$(this).parents('.popover').popover('hide'); //TODO: should also hide related [data-toggle=popover]
			},
			error: function (xhr) {
				$(this).data('submitting', false).removeClass('submitting');
				$('button[type=submit] span.submit-label', this).text('Trimite');
	//			grecaptcha.reset();
				if (xhr.status == 422) {
					for (var field in xhr.responseJSON) {
						$('*[name=' + field + '], input[name=' + field + ']+label', this)
								.last()
								.parents('.input-group')
								.after(
										function () {
											$errors = "";
											for (var err in xhr.responseJSON[field])
												$errors += '<span class="help-block">' + xhr.responseJSON[field][err] + '</span>';
											return $errors;
										}
								)
								.parents('.form-group:first').addClass('has-error');
					}
				} else if (xhr.status == 403) {
					console.log(xhr);
				}
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
		cdown.add(new Date($(this).data('ts') * 1000), $(this).attr('id'));
	});
	$("[data-toggle=popover]").popover({
		html: true, 
		content: function() {
			$('#subscribe-content input[name=patient_id]').val($(this).data('pid'));
			return $('#subscribe-content').html();
		}
	});
}

//	$(document).on('hide.bs.popover', '[data-toggle=popover]', function (e) {
//		console.log(this, e);
////		$(this).slideUp();
//	});

$(document).ready(init);
