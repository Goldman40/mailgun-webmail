<?php

namespace app\auth;


use app\database\DBFactory;

class Signin extends Users
{
    private $data;

    public function Signin() {
        $db = DBFactory::load();
        $attributes= array('username' => $this->getUsername());
        $this->data = $db->prepare($this->sql_signin,$attributes,true);
        return $this->NowSignin();
    }
    private function NowSignin() {
        if(!$this->data OR !CryptPass::VerifyHash($this->data['password'],$this->getPassword())) {
            throw new \Exception('Mot de passe ou identifiant incorrect');
        } else {
            $attributes = array(
                'session' => Session::GenerateSession(),
                'id' => $this->data['id']
            );
            $db = DBFactory::load();
            $db->insert($this->sql_InsertNewSession,$attributes);
            $_SESSION['session'] = $attributes['session'];
            $_SESSION['username'] = $this->data['username'];
            return true;
        }
    }
}