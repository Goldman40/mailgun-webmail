<?php

namespace app\controller;


use app\auth\Session;
use app\auth\Signin;
use app\auth\Signup;

class Controller_auth
{
    public function Call()
    {
        try {

            $u = new Session();
            if ($u->LookIfUserConnect()) {
                header('Location: ?a=home');
            } elseif (isset($_POST['action']) && $_POST['action'] == 'connect') {
                unset($_POST['action']);
                $d = new Signin();
                $d->setUsername($_POST['username']);
                $d->setPassword($_POST['password']);
                $d->Signin();
                header('Location: ?a=home');
            } elseif (isset($_POST['action']) && $_POST['action'] == 'register') {
                unset($_POST['action']);
                $d = new Signup();
                $d->setUsername($_POST['username']);
                $d->setPassword($_POST['password1']);
                $d->Signup();
                header('Location: ?a=home');
            } else {
                return false;
            }
        } catch (\Exception $e) {
            if (!empty($e)) {
                $error = array('error' => $e->getMessage());
            }
        } finally {
            if (empty($error)) {
                return false;
            } else {
                return $error;
            }
        }
    }
}