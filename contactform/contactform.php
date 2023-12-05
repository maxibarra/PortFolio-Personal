<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["name"]));
    $correo = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = trim($_POST["message"]);

    // Verifica que los campos no estén vacíos
    if (empty($name) || empty($email) || empty($message)) {
        echo "Por favor, completa todos los campos del formulario.";
        exit;
    }

    // Configura tu dirección de correo electrónico
    $destinatario = "maxi.8379@gmail.com"; 

    // Configura el asunto del correo
    $asunto = "Nuevo mensaje de formulario de contacto de $name";

    // Construye el cuerpo del mensaje
    $contenido_correo = "Nombre: $name\n";
    $contenido_correo .= "Correo Electrónico: $email\n\n";
    $contenido_correo .= "Mensaje:\n$message\n";

    // Configura las cabeceras del correo
    $cabeceras_correo = "De: $name <$email>";

    // Envía el correo
    if (mail($destinatario, $asunto, $contenido_correo, $cabeceras_correo)) {
        echo "OK";
    } else {
        echo "Hubo un problema al enviar el mensaje. Por favor, intenta de nuevo más tarde.";
    }
} else {
    echo "Acceso denegado.";
}
?>