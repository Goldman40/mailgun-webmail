<?php

namespace app\auth;


use app\database\DBFactory;

class Permissions extends Users
{
    public function GetAccessToUserMail() {
        $db = DBFactory::load();
        $attributes = array(
            'id' => $this->getId()
        );
        $data = $db->prepare('SELECT allow_manage FROM mail_user WHERE id = :id',$attributes,true);
        $data = json_decode($data['allow_manage'],true);
        $data = $data['mails'];
        return $data;
    }
}