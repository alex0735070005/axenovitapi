<?php

namespace App\Service;

abstract class EncoderService {

    static public function encodePassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    static public function encodeApiKey($email, $username) {
        return md5(uniqid("{$email}{$username}", true));
    }
}
