<?php

namespace coderaiz\shared;

class GoogleRecaptcha
{
    public function __construct() {
    }

    public function validate(string $recaptchaResponse): bool
    {
        $url     = "https://www.google.com/recaptcha/api/siteverify";
        $payload = "secret=" . SITE_SECRET . "&response=" . $recaptchaResponse;
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
    
        $result = json_decode($response);
    
        return (bool) $result->success;
    }
}