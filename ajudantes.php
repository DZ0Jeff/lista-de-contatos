<?php


# traduzir data 

	function traduz_data_para_banco($data)
	{
		if ($data == "") {
			return "";
		}

		$dados = explode("/", $data);

		if (count($dados) != 3) {
			return $data;
		}

		$data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";

		return $data_mysql;
	}

# fim da tradução

# retornar data pt-br

	function traduz_data_para_exibir($data)
	{
		if ($data == "" OR $data == "0000-00-00") {
			return "";
		}

		$dados = explode("-", $data);

		if (count($dados) != 3) {
			return $data;
		}

		$data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

		return $data_exibir;
	}

# fim da tradução 

# tradução de checkbox

	function traduz_concluida($concluida)
	{
		if ($concluida == 1) {
			return 'Melhores Amigos';
		}

		return 'Conhecidos';
		
	}

# fim da tradução

# validação de erros

	function tem_post()
	{
		if (count($_POST) > 0) {
			return true;
		}
		
		return false;
	}
# fim da valicação de erros

# Expressões regulares

	function validar_data($data)
	{
		$padrão = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
		$resultado = preg_match($padrão, $data);

		if(! $resultado){
			return false;
		}

		$dados = explode('/', $data);

		$dia = $dados[0];
		$mes = $dados[1];
		$ano = $dados[2];

		$resultado = checkdate($mes, $dia, $ano);

		return $resultado;
	}

	function validar_fone($data)
	{
		$padrão = '/^[0-9]{5}\-[0-9]{4}$/';
		$resultado = preg_match($padrão, $data);

		return $resultado;
	}

# Fim das expressões

#validação de anexos
	
	function tratar_anexo($anexo)
	{
		$padrão = '/^.+(\.jpg|\.png)$/';
		$resultado = preg_match($padrão, $anexo['name']);

		if (! $resultado) {
			return false;
		}

		move_uploaded_file($anexo['tmp_name'], "anexos/{$anexo['name']}");

		return true;
	}

# Envivar e-mail

	function enviar_email($contato, $anexos = array())
	{
		include "biblioteca/PHPMailer/PHPMailerAutoload.php";

		$corpo = preparar_corpo_email($contato, $anexos);
		$email = new PHPMailer();
		$email->isSMTP();
		$email->Host = "smtp.gmail.com";
		$email->Port = 587;
		$email->SMTPSecure = 'tls';
		$email->SMTPAuth = true;
		$email->Username = (LOGIN);
		$email->Password = (SENHA);
		$email->setFrom(USERNAME, CABECALHO);
		$email->addAddress(EMAIL_NOTIFICACAO);
		$email->Subject = "Contato: {$contato['nome']}";
		$email->msgHTML($corpo);

		foreach ($anexos as $anexo) {
			$email->addAttachment("anexos/{$anexo['arquivo']}");
		}
		$email->send();

	}

	function preparar_corpo_email($contato, $anexos)
	{
	
		ob_start();

		include "template_email.php";

		$corpo = ob_get_contents();

		ob_end_clean();

		return $corpo;
	}

?>