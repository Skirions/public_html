<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$to = "info@senra1.eu";
$subject = "Nuevo mensaje desde el formulario web";

$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$message = isset($_POST['message']) ? nl2br(strip_tags(trim($_POST['message']))) : '';
// 🔒 Honeypot aquí
$honeypot = isset($_POST['website']) ? trim($_POST['website']) : '';
if (!empty($honeypot)) {
    echo '<div class="alert alert-danger">Error al enviar el mensaje.</div>';
    exit;
}
if (empty($name) || empty($email) || empty($message)) {
    echo '<div class="alert alert-danger">Por favor, completa todos los campos.</div>';
    exit;
}

$body = "
<html>
  <body>
    <p><strong>Nombre:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Mensaje:</strong><br>$message</p>
  </body>
</html>
";

$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

if (mail($to, $subject, $body, $headers)) {
    echo '<div class="alert alert-success">Gracias, tu mensaje ha sido enviado correctamente.</div>';
} else {
    echo '<div class="alert alert-danger">Lo sentimos, ocurrió un error al enviar el mensaje. Inténtalo más tarde.</div>';
}

