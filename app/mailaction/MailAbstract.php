<?php

namespace app\mailaction;


use Mailgun\Mailgun;

abstract class MailAbstract
{
    protected $id;
    protected $recipient;
    protected $sender;
    protected $subject;
    protected $from_;
    protected $when_;
    protected $content;
    protected $folder;
    protected $read;
    protected $attachment;

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
        $this->id = $id;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function setRecipient($recipient)
    {
        $mgClient = new Mailgun(PUBKEY);
        $result = $mgClient->get('address/validate', array('address' => $recipient));
        $data = $result->http_response_body->is_valid;
        if($data) {
            $this->recipient = $recipient;
        } else {
            throw new \Exception('Recipient not valid');
        }
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getFrom()
    {
        return $this->from_;
    }

    public function setFrom($from_)
    {
        $from = explode('@',$from_);
        $this->from_ = $from[0];
    }

    public function getWhen()
    {
        return $this->when_;
    }

    public function setWhen($when_)
    {
        $this->when_ = $when_;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getFolder()
    {
        return $this->folder;
    }

    public function setFolder($folder)
    {
        $this->folder = $folder;
    }

    public function getRead()
    {
        return $this->read;
    }

    public function setRead($read)
    {
        $this->read = $read;
    }

    public function getAttachment()
    {
        $array['attachment'] = $this->attachment;
        return $array;
    }

    public function setAttachment($attachment)
    {
        if(!empty($attachment['name'][0])) {
            $max = count($attachment['name']) - 1;
            $this->attachment = array();
            for ($i = 0; $i <= $max; $i++) {
                $dir = dirname($attachment['tmp_name'][$i]);
                $name = $attachment['name'][$i];
                rename($attachment['tmp_name'][$i], $dir . '\\' . $name);
                $this->attachment[] = $dir . '\\' . $name;
            }
        }
    }
}