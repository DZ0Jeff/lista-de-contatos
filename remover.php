<?php

	require_once 'config.php';
	require_once "banco.php";
	require_once "classes/Contato.php";

	$contatos = new Contatos($conexao);

	$contatos->remover_tarefa($conexao, $_GET['id']);
	header('Location: listadedados.php');

?>