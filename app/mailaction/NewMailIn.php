<?php

namespace app\mailaction;

use app\database\DBFactory;

class NewMailIn
{
    public function AddNew($post)
    {
        if(!empty($_POST['stripped-html'])) {
            $html = $_POST['stripped-html'];
        } else {
            $html = $_POST['stripped-text'];
        }
        $data = array(
            'recipient' => $post['recipient'],
            'sender' => $post['sender'],
            'subject' => $post['subject'],
            'from_' => $post['from'],
            'when_' => date('Y-m-d H:i:s',$post['timestamp']),
            'content' => $html
        );

        foreach ($data as $key => $value) {
            if (!isset($value)) {
                $error = array('Error' => $key . ' is null');
                echo json_encode($error);
                exit();
            }
        }

        $db = DBFactory::load();
        $db->insert('INSERT INTO mail_in (recipient,sender,subject,from_,when_,content) VALUES (:recipient,:sender,:subject,:from_,:when_,:content)', $data);

    }
}