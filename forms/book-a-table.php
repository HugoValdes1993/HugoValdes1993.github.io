<?php
/**
* Requires the "PHP Email Form" library
* The "PHP Email Form" library is available only in the pro version of the template
* The library should be uploaded to: vendor/php-email-form/php-email-form.php
* For more info and help: https://bootstrapmade.com/php-email-form/
*/
// incluir la clase php mailer
require_once("../assets/vendor/phpmailer/PHPMailerAutoload.php");

use PHPMailer\PHPMailer\PHPMailer;

// Create a new PHPMailer instance
$mail = new PHPMailer;

$strProtocoloSeguro = "tls";
$strNombreHost = "smtp.gmail.com";
$strPuertoHost = "587";
    
// Set UTF-8 encoding
$mail->CharSet = 'UTF-8';			

// Tell PHPMailer to use SMTP
$mail->isSMTP();

// Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages			
$mail->SMTPDebug = 0;

// Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

// Whether to use SMTP authentication
$mail->SMTPAuth = true;

// Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = $strProtocoloSeguro;

// Set the hostname of the mail server
$mail->Host = $strNombreHost;

// Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = $strPuertoHost;

$strMensajeRecepFinal = "Mesa reservada";

$strMensajeRecepFinal = nl2br($strMensajeRecepFinal);
			
$mail->msgHTML($strMensajeRecepFinal);

// Replace the plain text body with one created manually
$mail->AltBody = "Para ver el mensaje debe utilizar un cliente de correo compatible con HTML.";

//
// Send the message, check for errors
//

if ($mail->send())
{

  echo json_encode(array("filas_afectadas" => 1, "error" => 0, "error_desc" => ""));
  //Se cierra la conexion para evitar posibles reenvios de correo
  $mail->smtpClose();

}
else
{
  echo json_encode(array("filas_afectadas" => 0, "error" => 1, "error_desc" => "No se ha podido enviar la reserva, intentelo mas tarde"));
}

?>