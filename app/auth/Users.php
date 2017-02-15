<?php

namespace app\auth;

abstract class Users
{
    protected $sql_signup = 'INSERT INTO mail_user (username,password,session,allow_manage) VALUES (:username, :password, :session, :allow_manage)';
    protected $sql_signin = 'SELECT * FROM mail_user WHERE username = :username';
    protected $sql_getIdFromSession = 'SELECT id FROM mail_user WHERE session = :session';
    protected $sql_getUsernameByid = 'SELECT username FROM mail_user WHERE id = :id';
    protected $sql_getGeneralInfoById = 'SELECT * FROM mail_user WHERE id = :id';
    protected $sql_InsertNewSession = 'UPDATE mail_user SET session = :session WHERE id = :id';
    protected $sql_VerifyConnexion = 'SELECT * FROM mail_user WHERE username = :username AND session = :session';
    protected $sql_signup_check_username = 'SELECT * FROM mail_user WHERE username = :username';
    protected $id;
    protected $username;
    protected $password;
    protected $session;
    protected $allow_manage;

    public function getId()
    {
        if (!isset($this->id)) {
            throw new \Exception('Id null');
        } else {
            return $this->id;
        }
    }

    public function setId($id)
    {
        if ($id == '0' AND isset($_SESSION['id'])) {
            $this->id = $_SESSION['id'];
        } elseif (is_numeric($id)) {
            $this->id = intval($id);
        } else {
            throw new \Exception('Impossible de definir l\'id');
        }
    }

    public function getUsername()
    {
        if (empty($this->username)) {
            throw new \Exception('Pseudo Null');
        } else {
            return $this->username;
        }
    }

    public function setUsername($username)
    {
        if (strlen($username) <= 20) {
            $this->username = $username;
        } else {
            throw new \Exception('Pseudo invalide');
        }
    }

    public function getPassword()
    {
        if (empty($this->password)) {
            throw new \Exception('Password Null');
        } else {
            return $this->password;
        }
    }

    public function setPassword($password)
    {
        if (strlen($password) >= 6) {
            $this->password = $password;
        } else {
            throw new \Exception('Mot de passe invalide, doit être supérieur à 6 caractères');
        }
    }

    public function getSession()
    {
        if (empty($this->session)) {
            throw new \Exception('session Null');
        } else {
            return $this->session;
        }
    }

    public function setSession($session)
    {
        $this->session = $session;
    }

}