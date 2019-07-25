<table>
	<tr>
		<th>Nome:</th>
		<th>Telefone:</th>
		<th>E-mail:</th>
		<th>Descrição:</th>
		<th>Data de nascimento:</th>
		<th>Favoritos:</th>
		<th>Opções:</th>
	</tr>
	<?php foreach ($lista_contatos as $contato) : ?>
		<tr>
			<td>
				<a href="contato.php?id=<?php echo $contato['id']; ?> ">
					<?php echo $contato['nome']; ?>
				</a>
			</td>
			<td>
				<?php echo $contato['telefone']; ?> 
			</td>
			<td>
				<?php echo $contato['email']; ?> 
			</td>
			<td>
				<?php echo $contato['descricao']; ?> 
			</td>
			<td>
				<?php echo $validator->traduz_data_para_exibir($contato['nasc']); ?> 
			</td>
			<td>
				<?php echo $validator->traduz_concluida($contato['concluida']); ?> 
			</td>
			<td>
				<a href="editar.php?id=<?php echo $contato['id']; ?> ">
					Editar
				</a>
				<a href="remover.php?id=<?php echo $contato['id']; ?> ">
					Remover
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>