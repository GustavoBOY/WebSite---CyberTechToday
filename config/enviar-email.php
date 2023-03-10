<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Valida os dados
    $errors = array();
    if (empty($name)) {
        $errors[] = 'O nome é obrigatório';
    }
    if (empty($email)) {
        $errors[] = 'O e-mail é obrigatório';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'O e-mail não é válido';
    }
    if (empty($subject)) {
        $errors[] = 'O assunto é obrigatório';
    }
    if (empty($message)) {
        $errors[] = 'A mensagem é obrigatória';
    }

    // Envia o e-mail se não houver erros
    if (empty($errors)) {
        $to = 'gustavoboy1702@gmail.com';
        $headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $email . "\r\n";
        $headers .= 'Content-Type: text/plain; charset=utf-8' . "\r\n";
        $message = "Nome: $name\nE-mail: $email\nAssunto: $subject\nMensagem:\n$message";
        mail($to, $subject, $message, $headers);
        header('Location: index.html');
        exit;
    }
} else {
    header('Location: contact.html');
    exit;
}
?>
