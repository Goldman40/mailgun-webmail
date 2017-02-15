<?php

namespace app\auth;

use app\database\DBFactory;

class Signup extends Users
{

    public function Signup()
    {
        if (ALLOW_REGISTER === true) {
            $this->setSession(Session::GenerateSession());
            $this->setPassword(CryptPass::CryptPass($this->getPassword()));
        $attributes = array(
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'session' => $this->getSession(),
            'allow_manage' =>  json_encode(array('mails' => array('none')))
        );
            $this->CheckIfUserExist();
            $db = DBFactory::load();
            $db->insert($this->sql_signup, $attributes);
        } else {
            throw new \Exception('Register disabled');
        }
    }

    private function CheckIfUserExist() {
        $attributesUser = array('username' => $this->getUsername());

        $db = DBFactory::load();
        $dataUser = $db->prepare($this->sql_signup_check_username,$attributesUser);

        if(!empty($dataUser)) {
            throw new \Exception('Le compte existe deja');
        }
    }
}