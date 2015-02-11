$(document).ready(function(){
	$('a[data-remote="delete"	]').on('click', function(e){
		e.preventDefault();
		if (!confirm('About to delete. Are you sure?')){
			return false;
		}
		if ($(this).hasClass('disabled')){
			return false;
		}
		$(this).addClass('disabled');
		$.ajax({
			'dataType' : 'json',
			'method' : 'post',
			'context' : $(this),
			'url' : $(this).attr('href'),
			'success' : function(msg){
				$.notify(msg.message);
				$(this).removeClass('disabled');
				if (msg.result){
					$(this).hide();
					$(this).parents('tr').fadeOut(function(){$(this).remove()});
				}
			}
		});
	});

});