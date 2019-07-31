<?php
	require_once 'classes/Helper.php';
	require_once 'banco.php';

	$validator = new Helper($conexao);
?>

<h1>Contato: <?php echo $contato['nome']; ?></h1>

<h2>Telefone: <?php echo $contato['telefone']; ?></h2>
<h2>E-mail: <?php echo $contato['email']; ?></h2>


<p>
	<strong>Descrição:</strong>
	<?php echo $contato['descricao']; ?>
</p>
<p>
	<strong>Data de Nascimento</strong>
	<?php $validator->traduz_data_para_exibir($contato['nasc']); ?>
</p>
<p>
	<strong>Favorito:</strong>
	<?php echo $validator->traduz_concluida($contato['concluida']); ?>
</p>

<?php if (count($anexos) > 0): ?>
	<p><strong>Atenção!</strong> Esse contato tem informações complementares!!!</p>
<?php endif; ?>
