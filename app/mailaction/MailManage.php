<?php

namespace app\mailaction;


use app\database\DBFactory;

class MailManage
{
    public function MoveToTrash($post) {
        foreach ($post as $key => $value) {
            $data = array('id' => explode('check',$key)['1']);
            $db = DBFactory::load();
            $db->insert('UPDATE mail_in SET folder = 3 WHERE id = :id',$data);
        }
    }
    public function MoveToInbox($post) {
        foreach ($post as $key => $value) {
            $data = array('id' => explode('check',$key)['1']);
            $db = DBFactory::load();
            $db->insert('UPDATE mail_in SET folder = 0 WHERE id = :id',$data);
        }
    }
    public function MoveToSpam($post) {
        foreach ($post as $key => $value) {
            $data = array('id' => explode('check',$key)['1']);
            $db = DBFactory::load();
            $db->insert('UPDATE mail_in SET folder = 2 WHERE id = :id',$data);
        }
    }
}