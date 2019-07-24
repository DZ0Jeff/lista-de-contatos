<?php

	require_once "config.php";
	# Credencias do Usuario e tipo de banco de dados

	/*$bdServidor = '127.0.0.1';
	$bdUsuario = 'sistemacontatos';
	$bdSenha = 'contatos';
	$bdBanco = 'contatos';*/

	$conexao = mysqli_connect(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
	#$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

	if (mysqli_connect_errno($conexao)) {
		echo "<center>Erro de conexao ao banco de dados! Por favor Verifique os dados!</center>";
		die();
	}

?>