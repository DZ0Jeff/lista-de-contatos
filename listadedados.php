<?php 

session_start();

include 'config.php';
include "banco.php";
include "ajudantes.php";
include "classes/Contato.php";

$contatos = new Contatos($conexao);

$exibir_tabela = true;

$tem_erros = false;
$erros_validacao = array();

	if (tem_post()) {
		$contato = array();

		if(isset($_POST['nome']) && strlen($_POST['nome']) > 0)
			$contato['nome'] = $_POST['nome'];
		else {
			$tem_erros = true;
			$erros_validacao ['nome'] = 'O nome da contato é necessário!';
		}

		if(isset($_POST['telefone']) && strlen($_POST['telefone']) > 0) {
			if (validar_fone($_POST['telefone'])) {
				$contato['telefone'] = $_POST['telefone'];
			}
		
			else {
				$tem_erros = true;
				$erros_validacao['telefone'] = 'O telefone para contato é necessário!';
			}
		}
		

		if (isset($_POST['email']) && strlen($_POST['email']) > 0) {
			$contato['email'] = $_POST['email'];
		} else {
			$tem_erros = true;
			$erros_validacao['email'] = 'Um E-mail de Contato é necessário!';
		}
		
		if (isset($_POST['descricao'])) {
			$contato['descricao'] = $_POST['descricao'];
		} 
		else {
			$contato['descricao'] = '';
		}

		if(isset($_POST['nasc']) && strlen($_POST['nasc']) > 0) {

			if (validar_data($_POST['nasc'])) {
				$contato['nasc'] = traduz_data_para_banco($_POST['nasc']);
			} 
			else {
				$tem_erros = true;
				$erros_validacao['nasc'] = "insira uma data valida!";
			}
		}

		if (isset($_POST['concluida'])) {
			$contato['concluida'] = 1; 
		} 
		else {
			$contato['concluida'] = 0;
		}
		
		if (! $tem_erros) {
			$contatos->gravar_contatos($conexao, $contato);

			if (isset($_POST['lembrete']) && $_POST['lembrete'] == '1') {
				enviar_email($contato);
			}

			header('Location: listadedados.php');
			die();
		}
	}

$lista_contatos = $contatos->exibir_contatos($conexao);

$contato = array (
	'id'		=> 0,

	'nome'		=> (isset($_POST['nome'])) ? $_POST['nome'] : '',

	'telefone'	=> (isset($_POST['telefone'])) ? $_POST['telefone'] : '',

	'email'		=> (isset($_POST['email'])) ? $_POST['email'] : '',

	'descricao'	=> (isset($_POST['descricao'])) ? $_POST['descricao'] : '',

	'nasc'		=> (isset($_POST['nasc'])) ? 
	traduz_data_para_banco($_POST['nasc']) : '',

	'concluida' => (isset($_POST['concluida'])) ? $_POST['concluida'] : ''
);
	
include "template.php";

?>