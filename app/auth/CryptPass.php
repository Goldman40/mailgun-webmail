<?php

namespace app\auth;


class CryptPass
{
    static function CryptPass($pass) {
        $cost = 10;
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $salt = sprintf("$2a$%02d$", $cost) . $salt;
        $hash = crypt($pass, $salt);
        return $hash;
    }
    static function VerifyHash($sql_password,$password) {
        if ( hash_equals($sql_password, crypt($password, $sql_password)) ) {
           return true;
        } else {
            return false;
        }
    }
}