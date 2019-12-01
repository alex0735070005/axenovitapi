<?php

namespace App\Service;

abstract class ValidateService {

    static public function validateRegistration($data) {
        $erros = [];

        if (empty($data['username'])) {
            $erros['username'] = ['type' => 'not valid', 'message' => 'username is not valid'];
        }
        if (empty($data['email'])) {
            $erros['email'] = ['type' => 'not valid', 'message' => 'email is not valid'];
        }
        if (empty($data['password'])) {
            $erros['password'] = ['type' => 'not valid', 'message' => 'password is not valid'];
        }

        if (count($erros) > 0) {
            return [
                'result' => false,
                'message' => 'data registration form is not valid',
                'errors' => $erros
            ];
        }
        return true;
    }

}
