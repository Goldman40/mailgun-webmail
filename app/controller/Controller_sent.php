<?php

namespace app\controller;


use app\mailaction\MailRead;

class Controller_sent
{
    public function Call() {
        $d = new MailRead();
        $data = $d->getMailOut();
        return $data;
    }
}