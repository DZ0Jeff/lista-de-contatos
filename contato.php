<?php
	include 'config.php';
	include 'banco.php';
	include 'ajudantes.php';
	include 'classes/Contato.php';

	$contatos = new Contatos($conexao);

	$tem_erros = false;
	$erros_validacao = array();

	if (tem_post()) {
		// upload dos anexos
		$contato_id = $_POST['contato_id'];

		if (! isset($_FILES['anexo'])) {
			$tem_erros = true;
			$erros_validacao['anexo'] = 'Insira uma imagem!';
		} else {
			if (tratar_anexo($_FILES['anexo'])) {
				$anexo = array();
				$anexo['contato_id'] = $contato_id;
				$anexo['nome'] = $_FILES['anexo']['name'];
				$anexo['arquivo'] = $_FILES['anexo']['name'];
			} else{
				$tem_erros = true;
				$erros_validacao['anexo'] = 'Apenas imagens formato jpg ou png';
			}
		}

		if (! $tem_erros) {
			$contatos->gravar_anexo($conexao, $anexo);
		}
	}

	$contato = $contatos->exibir_contato($conexao, $_GET['id']);
	$anexos = $contatos->buscar_anexos($conexao, $_GET['id']);

	include "template_contato.php";
?>