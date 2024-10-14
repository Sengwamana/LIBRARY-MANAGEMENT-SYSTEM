<?php
// notification_service.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class NotificationService {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->setup();
    }

    private function setup() {
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.example.com';    // Your SMTP server
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'your-email@example.com';  // SMTP username
        $this->mail->Password = 'your-email-password';     // SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }

    public function sendEmail($to, $subject, $body) {
        try {
            $this->mail->setFrom('no-reply@library.com', 'Library System');
            $this->mail->addAddress($to);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
