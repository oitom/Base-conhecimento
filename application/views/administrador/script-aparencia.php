<script type="text/javascript">

function logoIMG(input) {
    if (input.files && input.files[0]) {    
        var reader = new FileReader();      
        reader.onload = function (e) {  
            $(input).parent().find("img")  
            .attr('src', e.target.result);
            $("#preview-tela #pv_topo img").attr('src', e.target.result);
        };      
        reader.readAsDataURL(input.files[0]);   
    }   
}

function bannerIMG(input) {
    if (input.files && input.files[0]) {    
        var reader = new FileReader();      
        reader.onload = function (e) {  
            $(input).parent().find("img")  
            .attr('src', e.target.result);
            $("#preview-tela #pv_cabecario").css('background-image', "url("+e.target.result+")");
        };      
        reader.readAsDataURL(input.files[0]);   
    }   
}

$(document).ready(function () {

	$("#pv_cabecario").css("background-image", "url("+$("#img-banner").attr("src")+")");

	$("#preview-tela #pv_corpo").css("background-color", $("#bg-corpo").val());
	$("#bg-corpo").change(function(){
		$("#preview-tela #pv_corpo").css("background-color", $(this).val());
	});

	$("#preview-tela #pv_corpo").css("color", $("#font-corpo").val());
	$("#font-corpo").change(function(){
		$("#preview-tela #pv_corpo").css("color", $(this).val());
	});


	$("#preview-tela #pv_corpo>div:last-child").css("background-color", $("#bg-conteudo").val());
	$("#bg-conteudo").change(function(){
		$("#preview-tela #pv_corpo>div:last-child").css("background-color", $(this).val());
	});

	$("#preview-tela .selected").css("background-color", $("#bg-selected").val());
	$("#bg-selected").change(function(){
		$("#preview-tela .selected").css("background-color", $(this).val());
	});

	$("#preview-tela #pv_rodape").css("background-color", $("#bg-topo-rodape").val());
	$("#preview-tela #pv_topo").css("background-color", $("#bg-topo-rodape").val());
	$("#bg-topo-rodape").change(function(){
		$("#preview-tela #pv_topo").css("background-color", $(this).val());
		$("#preview-tela #pv_rodape").css("background-color", $(this).val());

	});

	$("#preview-tela #pv_topo").css("color", $("#font-topo-rodape").val());
	$("#preview-tela #pv_rodape").css("color", $("#font-topo-rodape").val());
	$("#font-topo-rodape").change(function(){
		$("#preview-tela #pv_topo").css("color", $(this).val());
		$("#preview-tela #pv_rodape").css("color", $(this).val());
	});

	$("#preview-tela #pv_cabecario").css("color", $("#font-cabecario").val());
	$("#font-cabecario").change(function(){
		$("#preview-tela #pv_cabecario").css("color", $(this).val());
	});

});
</script>