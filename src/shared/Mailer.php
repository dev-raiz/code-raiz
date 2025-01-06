<?php

namespace coderaiz\shared;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{
    private PHPMailer $mail;

    public function __construct(PHPMailer $mail)
    {
        $this->mail = $mail;

        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;
        $this->mail->isSMTP();
        $this->mail->Host       = MAIL_HOST;
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = MAIL_USERNAME;
        $this->mail->Password   = MAIL_PASSWORD;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = MAIL_PORT;
        $this->mail->CharSet    = "UTF-8";

        $this->mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
    }

    public function send(array $dataSend): void
    {
        $isHTML = (bool) (isset($dataSend['is_html']) === true) ? $dataSend['is_html'] : false;

        foreach ($dataSend['recipients'] as $recipient) {
            $this->mail->addAddress($recipient['email'], $recipient['name']);
        }

        if (isset($dataSend['attachments']) === true) {
            foreach ($dataSend['attachments'] as $attachment) {
                $this->mail->addAttachment($attachment['file']);
            }
        }

        $this->mail->isHTML($isHTML);
        $this->mail->Subject = $dataSend['subject'];
        $this->mail->Body    = $dataSend['body'];

        $this->mail->send();
    }
}
