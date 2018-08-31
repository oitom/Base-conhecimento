<script type="text/javascript">
$(document).ready(function () {
	
	$("#conteudo-tipo").change(function(){

		setTimeout(function() {
			var form = $("#conteudo-tipo").find("option:selected").attr("id-form");
			
			$("#formulario .collapse.in").collapse('hide');
			$(form).collapse('show');

		}, 500);

	});


});
</script>