<?php

namespace app\auth;


use app\database\DBFactory;

class getUserInfos extends Users
{
    public function getIdFromSession() {
        $db = DBFactory::load();
        $attributes = array('session' => $_SESSION['session']);
        $data = $db->prepare($this->sql_getIdFromSession,$attributes,true);
        return $data['id'];
    }
    public function getPseudoById() {
        $db = DBFactory::load();
        $attributes = array('id' => intval($this->id));
        $data = $db->prepare($this->sql_getUsernameByid,$attributes,true);
        if(!$data) {
            $data['Pseudo'] = 'unknown';
        }
        return $data['Pseudo'];
    }
    public function getGeneralInfoById() {
        $db = DBFactory::load();
        $attributes = array('id' => intval($this->getId()));
        $data = $db->prepare($this->sql_getGeneralInfoById,$attributes,true);
        return $data;
    }
}