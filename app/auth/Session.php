<?php

namespace app\auth;


use app\database\DBFactory;

class Session extends Users
{
    public function LookIfUserConnect() {
        $db = DBFactory::load();
        if(!empty($_SESSION['session']) && !empty($_SESSION['username'])) {
            $attributes = array(
                'session' => $_SESSION['session'],
                'username' => $_SESSION['username']
            );
            $data = $db->prepare($this->sql_VerifyConnexion,$attributes);
            if(!$data) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    static function GenerateSession() {
        $session = sha1(SALT.uniqid().microtime());
        return $session;
    }
}