

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Enviar ventas del día</title>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <meta name="robots" content="noindex, nofollow">
</head>
<body>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Datos de las ventas del día
$ventas = array(
    array("Producto 1", 10),  // Ejemplo: Nombre del producto y cantidad vendida
    array("Producto 2", 5),
    array("Producto 3", 8)
);

// Calcular el total de ventas
$total = 0;
foreach ($ventas as $venta) {
    $total += $venta[1];
}

// Construir la tabla HTML
$table = '<table border="1">';
$table .= '<tr><th>Producto</th><th>Cantidad</th></tr>';
foreach ($ventas as $venta) {
    $table .= '<tr><td>' . $venta[0] . '</td><td>' . $venta[1] . '</td></tr>';
}
$table .= '<tr><td>Total</td><td>' . $total . '</td></tr>';
$table .= '</table>';

// Configurar datos del correo
$sender_name = "Enviando Cuentas del día";
$sender_email = "noreply@mailer.org";
$username = "buildbrainhn@gmail.com";
$password = "wwis mspx zbrx smvk"; // Reemplazar con tu contraseña de Gmail
$receiver_email = "info@ellas-beauty.com";
$subject = "Ventas del día";
$message = "Estas son las ventas del día:<br><br>" . $table;

// Enviar el correo electrónico
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom($sender_email, $sender_name);
$mail->addAddress($receiver_email);
$mail->Username = $username;
$mail->Password = $password;
$mail->Subject = $subject;
$mail->msgHTML($message);

// Manejo de errores
try {
    $mail->send();
    echo '<p id="info_msg">¡Correo enviado!</p>';
} catch (Exception $e) {
    echo '<p id="info_msg">Error al enviar el correo: ' . $mail->ErrorInfo . '</p>';
}
?>

</body>
</html>

