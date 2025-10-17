<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Caminhos corretos da pasta PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Captura segura dos dados
    $nome = isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $mensagem = isset($_POST['mensagem']) ? htmlspecialchars($_POST['mensagem']) : '';

    if (!$nome || !$email || !$mensagem) {
        echo "<div style='
                background:#F44336;
                color:white;
                padding:15px;
                margin:30px auto;
                width:90%;
                max-width:500px;
                border-radius:8px;
                text-align:center;
                font-family:sans-serif;
              '>Por favor, preencha todos os campos.</div>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        /* ===== CONFIGURAÇÃO SMTP (OUTLOOK / OFFICE 365) ===== */
        $mail->SMTPDebug = 2; // use 2 para ver detalhes
        $mail->isSMTP();
        $mail->Host       = 'smtp.office365.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'seuenail@outlook.com';      // <-- seu email completo
        $mail->Password   = 'suasenhadaconta';     // <-- senha de app (não a senha normal)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        /* ===== REMETENTE E DESTINATÁRIO ===== */
        $mail->setFrom('seuemail@outlook.com.br', 'CAFEN Website');
        $mail->addAddress('contato@cafen.com', 'CAFEN'); // pode trocar por outro e-mail destino

        /* ===== CONTEÚDO ===== */
        $mail->isHTML(true);
        $mail->Subject = "Nova mensagem de contato - CAFEN";
        $mail->Body    = "
            <div style='font-family:Arial, sans-serif; color:#333;'>
                <h2>Nova mensagem recebida do site CAFEN:</h2>
                <p><strong>Nome:</strong> {$nome}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Mensagem:</strong></p>
                <div style='background:#f4f4f4; padding:10px; border-radius:6px;'>{$mensagem}</div>
                <hr style='margin:20px 0;'>
                <p style='font-size:0.9em;color:#888;'>Enviado automaticamente via formulário CAFEN.</p>
            </div>
        ";

        /* ===== ENVIO ===== */
        $mail->send();

        echo "<div style='
                background:#4CAF50;
                color:white;
                padding:15px;
                margin:30px auto;
                width:90%;
                max-width:500px;
                border-radius:8px;
                text-align:center;
                font-family:sans-serif;
                animation:fadeIn 0.8s ease;
              '>Mensagem enviada com sucesso! 🎉</div>";

    } catch (Exception $e) {
        echo "<div style='
                background:#F44336;
                color:white;
                padding:15px;
                margin:30px auto;
                width:90%;
                max-width:500px;
                border-radius:8px;
                text-align:center;
                font-family:sans-serif;
              '>Erro ao enviar: {$mail->ErrorInfo}</div>";
    }
}
?>
