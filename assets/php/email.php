<?php
mb_internal_encoding("UTF-8");

/* 1. Destinatário fixo */
$to = 'fariasergio909@gmail.com';

/* 2. Valores padrão caso o formulário não mande algo */
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : 'Mensagem do site';
$name    = isset($_POST['name'])    ? trim($_POST['name'])    : '';
$email   = isset($_POST['email'])   ? trim($_POST['email'])   : '';
$phone   = isset($_POST['phone'])   ? trim($_POST['phone'])   : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

/* 3. Monta o corpo – comece a variável antes de concatenar */
$body  = "Nome: {$name}\r\n";
$body .= "E-mail: {$email}\r\n";
$body .= "Telefone: {$phone}\r\n\r\n";
$body .= "Mensagem:\r\n{$message}\r\n";

/* 4. Cabeçalhos – “From” deve ser um e-mail do próprio domínio para evitar SPAM;
      use Reply-To para responder ao remetente */
$headers  = "From: site@seudominio.com.br\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

/* 5. Validação de e-mail e envio */
if (filter_var($email, FILTER_VALIDATE_EMAIL) && mb_send_mail($to, $subject, $body, $headers)) {
    echo '<div class="status-icon valid"><i class="fa fa-check"></i></div>';
} else {
    echo '<div class="status-icon invalid"><i class="fa fa-times"></i></div>';
}
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if (mb_send_mail($to, $subject, $body, $headers)) {
        echo 'SUCESSO: Email enviado.';
    } else {
        echo 'ERRO: Email não foi enviado. Verifique o servidor.';
    }
} else {
    echo 'ERRO: Email inválido.';
}
?>
