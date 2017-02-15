<?php

namespace app\mailaction;

use app\database\DBFactory;

class MailRead
{
    public function getMailIn($recipient = 'mail@mail.com')
    {
        if ($recipient != NULL) {

            $db = DBFactory::load();
            $attributes = array('recipient' => $recipient);
            $data = $db->prepare('SELECT * FROM mail_in WHERE folder = 0 AND recipient = :recipient ORDER BY id DESC',$attributes);
            return $data;
        } else {
            throw new \Exception('Recipient not valid');
        }
    }

    public function getMailOut()
    {
        $db = DBFactory::load();
        $data = $db->query('SELECT * FROM mail_out ORDER BY id DESC');
        return $data;
    }

    public function getMailSpam()
    {
        $db = DBFactory::load();
        $data = $db->query('SELECT * FROM mail_in WHERE folder = 2 ORDER BY id DESC');
        return $data;
    }

    public function getMailTrash($recipient)
    {
        if ($recipient != NULL) {

            $db = DBFactory::load();
            $attributes = array('recipient' => $recipient);
            $data = $db->prepare('SELECT * FROM mail_in WHERE folder = 3 AND recipient = :recipient ORDER BY id DESC',$attributes);
            return $data;
        } else {
            throw new \Exception('Recipient not valid');
        }
    }
}