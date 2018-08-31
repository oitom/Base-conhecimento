<script type="text/javascript">

function readIMG(input) {
    if (input.files && input.files[0]) {    
        var reader = new FileReader();      
        reader.onload = function (e) {  
            $(input).parent().find("img")  
            .attr('src', e.target.result);  
        };      
        reader.readAsDataURL(input.files[0]);   
    }   
}

$(document).ready(function () {

	$($("#conteudo-tipo").find("option:selected").attr("id-form")).collapse('show');

	$("#conteudo-tipo").change(function(){

		$("#formulario .collapse.in").collapse('hide');
		$("#load").collapse('show');

		setTimeout(function() {
			var form = $("#conteudo-tipo").find("option:selected").attr("id-form");
			
			$(form).collapse('show');
			$("#load").collapse('hide');

		}, 1000);

	});

	$(".btn.btn-primary").click(function(){

		alert($("#editor").getContent());

		return false;
	});

	$("#btn-to-right").click(function(){
		var select  = $(this).parent().find("select"); 
		var select2 = $("#btn-to-left").parent().find("select"); 

		select.find(':selected').each(function(){ 
		  select2.append($(this)); 
		});
		select.children("option:selected").remove();

	});

	$("#btn-to-left").click(function(){
		var select  = $(this).parent().find("select"); 
		var select2 = $("#btn-to-right").parent().find("select"); 

		select.find(':selected').each(function(){ 
		  select2.append($(this)); 
		});
		select.children("option:selected").remove();
	});

});
</script>