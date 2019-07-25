<?php 

session_start();

require_once 'config.php';
require_once "banco.php";
require_once "ajudantes.php";
require_once "classes/Contato.php";
require_once "classes/Helper.php";

$contatos = new Contatos($conexao);
$validator = new Helper();

$exibir_tabela = true;

$tem_erros = false;

	# Gravação de tarefas 

	if (isset($_GET['nome']) && $_GET['nome'] != '') {
		$contato = array();
		$contato['nome'] = $_GET['nome'];

		if (isset($_GET['telefone'])) {
			$contato['telefone'] = $_GET['telefone'];
		} 

		else {
			$contato['telefone'] = '';
		}

		if (isset($_GET['email'])) {
			$contato['email'] = $_GET['email'];
		}

		else {
			$contato['email'] = '';
		}
	
		if (isset($_GET['descricao'])) {
			$contato['descricao'] = $_GET['descricao'];
		} 
		else {
			$contato['descricao'] = '';
		}

		if (isset($_GET['nasc'])) {
			$contato['nasc'] = $validator->traduz_data_para_banco($_GET['nasc']);
		} 
		else {
			$contato['nasc'] = '';
		}

		if (isset($_GET['concluida'])) {
			$contato['concluida'] = 1; 
		} 
		else {
			$contato['concluida'] = 0;
		}
			
		$contatos->gravar_contatos($conexao, $contato); 
	}

	#exbição de tarefas

	$lista_contatos = $contatos->exibir_favoritos($conexao, $_GET['id']);

# valores dos espaços

$contato = array (
	'id'		=> 0,
	'nome'		=> '',
	'telefone'	=> '',
	'email'		=> '',
	'descricao'	=> '',
	'nasc'		=> '',
	'concluida' => 1
);
	
include "template.php";
?>