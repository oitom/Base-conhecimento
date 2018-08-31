<script>
setTimeout(function() {$("#msg-sucesso").fadeOut();}, 3000);
 
var page = 1;
var maxpage = $("#npaginas").val();
var limite  = $("#limite").val();
var tabela = $("#tabela").val();

$('.p-'+page).addClass('active');

$('.a-next').click(function(){
	if(page < maxpage)
	{	
		page++;
		$.post("paginacao", {tabela:tabela, pagina:page, limite:limite}, function(conteudo)
		{
			$(".table tbody").html(conteudo);
		});
		$('.pagination li.active').removeClass('active');
		$('.p-'+page).addClass('active');
	}
	return false;
});

$('.a-prev').click(function(){
	if(page > 1)
	{	
		page--;
		$.post("paginacao", {tabela:tabela, pagina:page, limite:limite}, function(conteudo)
		{
			$(".table tbody").html(conteudo);
		});
		$('.pagination li.active').removeClass('active');
		$('.p-'+page).addClass('active');
	}
	return false;
});

$('.page').click(function(){
	
	page = $(this).html();
	
	$.post("paginacao", {tabela:tabela, pagina:page, limite:limite}, function(conteudo)
	{
		$(".table tbody").html(conteudo);
	});
	$('.pagination li.active').removeClass('active');
	$('.p-'+page).addClass('active');

	return false;
});

</script>