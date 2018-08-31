<script type="text/javascript">
	$('#confirma-ext').click(function(){
		var id = $('#itens-restricao input').length;
		if($('#bloqueia-ext').val() != "")
			$('#restricao-ext').append('<div class="col-md-3"> <div class="input-group"> <span class="input-group-addon"> <input id="ext-restrito-' + id + '" name="ext-restrito[]" type="checkbox" checked value="' + $('#bloqueia-ext').val() + '"> </span> <label for="ext-restrito-" class="form-control">' + $('#bloqueia-ext').val() + '</label> </div> </div>');
	});
</script>