<?php

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