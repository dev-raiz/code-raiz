<?php

namespace coderaiz\domain\person\service;

use coderaiz\domain\person\entity\Person;
use coderaiz\shared\Mailer;

class SendEmailOfNewGeneratedPassword
{
    private Mailer $mailer;

    public function __construct(Mailer $mailer) {
        $this->mailer = $mailer;
    }

    public function execute(Person $person): void
    {
        $contents = file_get_contents( __DIR__ . '/../../../shared/templates/email/new-password-generated.html');

        $contents = str_replace('#app_name#', APP_NAME, $contents);
        $contents = str_replace('#url_app#', URL_APP, $contents);

        $contents = str_replace('#social_name#', $person->getSocialName(), $contents);
        $contents = str_replace('#email#', $person->getEmail(), $contents);
        $contents = str_replace('#password#', $person->getPassword(), $contents);

        $dataSend['is_html'] = true;
        
        $recipient = [
            'name'  => $person->getSocialName(),
            'email' => $person->getEmail()
        ];

        $dataSend['recipients'][] = $recipient;
        $dataSend['subject']      = 'Geração de Nova Senha';
        $dataSend['body']         = $contents;

        $this->mailer->send($dataSend);
    }
}
