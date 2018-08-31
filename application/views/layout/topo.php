<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">	
	<title><?php echo $titulo; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>estilo.css">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS; ?>font-awesome-4.2.0/css/font-awesome.min.css">
	<style type="text/css">
<?php 
	if( isset($plataforma)){
		preg_match_all('/(.*?)~\s?(.*?)(\||$)/', $plataforma->estilo, $matches);
	    $estilos = array_combine(array_map('trim', $matches[1]), $matches[2]);
	    foreach ($estilos as $seletor => $style) { echo $seletor."{".$style."}"; } 
	}
?>
	</style>
<?php?>
</head>
<body>
