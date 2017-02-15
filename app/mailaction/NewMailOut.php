<?php

namespace app\mailaction;


use app\database\DBFactory;
use Mailgun\Mailgun;

class NewMailOut extends MailAbstract
{
    public $data;
    public $attachment;

    public function BuildMessageValues() {
        $this->data = array(
            'from' => 'YourCMS <' . $this->getFrom() . '@yourcms.fr>',
            'to' => $this->getRecipient(),
            'subject' => $this->getSubject(),
            'text' => $this->getContent()
        );
    }
    public function send()
    {
        $mgClient = new Mailgun(KEY);
        $domain = 'yourcms.fr';
        $mgClient->sendMessage($domain,$this->data,$this->getAttachment());
        $this->StoreInDB();
    }
    private function StoreInDB() {
        $attributes = array(
            'from_' => $this->getFrom() . '@yourcms.fr',
            'recipient' => $this->getRecipient(),
            'subject' => $this->getSubject(),
            'content' => $this->getContent(),
            'username' => 'YourCMS'
        );
        $db = DBFactory::load();
        $db->insert('INSERT INTO mail_out (from_,recipient,subject,content,username,when_) VALUES(:from_ , :recipient , :subject , :content , :username , NOW())',$attributes);
    }
}