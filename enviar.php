<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $mensagem = htmlspecialchars($_POST['mensagem']);

    $mail = new PHPMailer(true);

    try {
        // Configuração do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // ou o servidor SMTP do seu provedor
        $mail->SMTPAuth   = true;
        $mail->Username   = 'amdscff@gmail.com';
        $mail->Password   = 'Nd6gcsf4#'; // use App Password se for Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remetente e destinatário
        $mail->setFrom('amdscff@gmail.com', 'CAFEN Website');
        $mail->addAddress('contato@cafen.com', 'CAFEN');

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = "Nova mensagem de contato - CAFEN";
        $mail->Body    = "
          <h2>Nova mensagem recebida:</h2>
          <p><b>Nome:</b> {$nome}</p>
          <p><b>Email:</b> {$email}</p>
          <p><b>Mensagem:</b><br>{$mensagem}</p>
        ";

        $mail->send();
        echo "<p style='color:green;text-align:center;margin-top:2rem;'>Mensagem enviada com sucesso!</p>";
    } catch (Exception $e) {
        echo "<p style='color:red;text-align:center;margin-top:2rem;'>Erro ao enviar: {$mail->ErrorInfo}</p>";
    }
}
?>
