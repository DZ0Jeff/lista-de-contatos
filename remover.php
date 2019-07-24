<?php

	include 'config.php';
	include "banco.php";
	require_once "classes/Contato.php";

	$contatos = new Contatos($conexao);

	$contatos->remover_tarefa($conexao, $_GET['id']);
	header('Location: listadedados.php');

?>