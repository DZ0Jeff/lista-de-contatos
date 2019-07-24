<form method="POST">
	<input type="hidden" name="id" 
		value="<?php echo $contato['id']; ?>" />
	<fieldset>
		<legend>Novo Contato:</legend>

		<label>
			Nome:
			<?php if ($tem_erros && isset($erros_validacao['nome'])) : ?>
				<span class="erro">
					<?php echo $erros_validacao['nome']; ?>
				</span>
			<?php endif ?>
			<input type="text" name="nome"
				value="<?php echo $contato['nome']; ?> " />
		</label>

		<label>
			Telefone:
			<?php if ($tem_erros && isset($erros_validacao['telefone'])) : ?>
				<span class="erro">
					<?php echo $erros_validacao['telefone']; ?>
				</span>
			<?php endif ?>
		<input type="text" name="telefone" 
			value="<?php echo $contato['telefone'] ?>" />
		</label>

		<label>
			E-mail:
			<?php if ($tem_erros && isset($erros_validacao['email'])) : ?>
				<span class="erro">
					<?php echo $erros_validacao['email']; ?>
				</span>
			<?php endif ?>
		<input type="text" name="email" value="<?php echo $contato['email'] ?>" />
		</label>

		<label>
			Descrição:
			<textarea name="descricao">
				<?php echo $contato['descricao']; ?>
			</textarea>
		</label>

		<label>
			Data de nascimento:
			<?php if ($tem_erros && isset($erros_validacao['nasc'])) : ?>
				<span class="erro">
					<?php echo $erros_validacao['nasc']; ?>
				</span>
			<?php endif ?>
			<input type="text" name="nasc" value=
			"<?php echo traduz_data_para_exibir($contato['nasc']); 
				?>" />
		</label>

		<fieldset>
			<legend>Favoritos:</legend>
			<label>
				Sim?
				<input type="checkbox" name="concluida" value="1"
					<?php echo ($contato['concluida'] == 1) ? 'checked' : ''; ?> 
					/>
			</label>

			<label>
				Lembrete por E-mail:
				<input type="checkbox" name="lembrete" value="1" />
			</label>
		</fieldset>

		<br>
			<input type="submit" value="<?php echo ($contato['id'] > 0)? 'Atualizar' : 'Cadastrar'; ?> " />
		<nav>
			<ul>
				<li>
					<?php echo ($contato['id'] != 0) ? 
                		"<a href='listadedados.php'?>Cancelar</a>" : ''; 
            		?>
					
					<a href="lista.php?id=<?=$contato['id']; ?>">Favoritos</a>
				</li>
			</ul>
		</nav>
	</fieldset>
</form>