<?php

namespace app\controller;

use app\mailaction\MailManage;
use app\mailaction\MailRead;

class Controller_spam
{
    public function Call() {
        if(!empty($_POST) AND $_POST['action'] == 'MoveToIn') {
            unset($_POST['action']);
            $d = new MailManage();
            $d->MoveToInbox($_POST);
        }
        $d = new MailRead();
        return $d->getMailSpam();
    }
}