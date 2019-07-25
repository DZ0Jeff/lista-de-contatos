<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gerenciador de Contatos</title>
		<link rel="stylesheet" href="css/main.css" type="text/css" />
	</head>
	<body>
		<h1>Gerenciador de Contatos</h1>
		
		<?php include('formulario.php'); ?>

		<?php if ($exibir_tabela) : ?>
			<?php include('tabela.php'); ?>
		<?php endif; ?>

	</body>
</html>