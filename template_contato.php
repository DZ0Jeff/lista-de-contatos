<html>
	<head>
		<meta charset="utf-8" />
		<title>Gerenciador de Contatos</title>
		<link rel="stylesheet" href="css/estilo.css" type="text/css" />
	</head>
	<body>
		<h1>Contato: <?php echo $contato['nome']; ?> </h1>
			<p>
				<a href="listadedados.php">Voltar para a lista de tarefas</a>.
			</p>
			<p>
			<strong>Telefone:</strong>
				<?php echo $contato['telefone']; ?>
			</p>
			<p>
			<strong>E-mail:</strong>
				<?php echo $contato['email'] ?>
			</p>
			<strong>Descrição:</strong>
				<?php echo $contato['descricao']; ?>
			</p>
			<p>
			<strong>Prazo:</strong>
				<?php echo traduz_data_para_exibir($contato['nasc']); ?>
			</p>
			<p>
			<strong>Prioridade:</strong>
				<?php echo traduz_concluida($contato['concluida']); ?>
			</p>
		<h2>Anexos</h2>
		<!-- lista de anexos -->
		
		<?php if (count($anexos) > 0) : ?>
			<table>
				<tr>
					<th>Arquivo</th>
					<th>Opções</th>
				</tr>

				<?php foreach($anexos as $anexo) : ?>
					<tr>
						<td><?php echo $anexo['nome']; ?></td>
						<td>
							<a href="anexos/<?php echo $anexo['arquivo']; ?>">
								Mostrar
							</a>
							<a href="anexo.php?id=
								<?php echo $anexo['id']; ?> ">
								Remover
							</a>
						</td>
					</tr>
				<?php endforeach ?>
			</table>
		<?php else : ?>
			<p>Não há anexos para essa tarefa.</p>
		<?php endif; ?>

		<!-- formulário para um novo anexo -->
		<form action="#" method="post" enctype="multipart/form-data" >
			<fieldset>
				<legend>Novo Anexo</legend>
				<input type="hidden" name="contato_id" 
					value="<?php echo $contato['id']; ?>">

				<label>
					<?php if($tem_erros && isset($erros_validacao['anexo'])): ?>
						<span class="erro">
							<?php echo $erros_validacao['anexo']; ?>
						</span>
					<?php endif; ?>

					<input type="file" name="anexo">
				</label>

				<input type="submit" name="Enviar">
			</fieldset>
		</form>
	</body>
</html>