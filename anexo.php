<?php

	include "banco.php";
	require_once "classes/Contato.php";
	
	$bd = new Contatos($conexao);

	$bd->remover_anexo($conexao, $_GET['id']);
	header('Location: listadedados.php');

?>