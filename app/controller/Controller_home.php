<?php

namespace app\controller;

use app\auth\getUserInfos;
use app\auth\Permissions;
use app\mailaction\MailManage;
use app\mailaction\MailRead;
use app\mailaction\NewMailOut;

class Controller_home
{
    public $data;

    public function Call()
    {
        try {
            if (!empty($_POST AND $_POST['action'] == 'send')) {
                unset($_POST['action']);
                $d = new NewMailOut();
                $d->setFrom($_POST['from']);
                $d->setRecipient($_POST['to']);
                $d->setSubject($_POST['subject']);
                $d->setContent($_POST['content']);
                if (!empty($_FILES)) {
                    $d->setAttachment($_FILES['attachment']);
                }
                $d->BuildMessageValues();
                $d->send();
            } elseif (!empty($_POST) AND $_POST['action'] == 'delete') {
                unset($_POST['action']);
                $d = new MailManage();
                $d->MoveToTrash($_POST);
            } else {
                //There is no action !
            }
            $r = new getUserInfos();
            $t = new Permissions();

            $t->setId($r->getIdFromSession());
            $perm = $t->GetAccessToUserMail();

            if(isset($_GET['mail'])) {
                if(in_array($_GET['mail'],$perm,true)) {
                    $need = $_GET['mail'];
                }
            } else {
                $need = $perm['0'];
            }

            if(!isset($need)) {
                $need = $perm['0'];
            }

            $d = new MailRead();
            $data['mails'] = $d->getMailIn($need);
            $data['AccessTo'] = $perm;
            $data['UserName'] = $_SESSION['username'];
        } catch (\Exception $e) {
            if (!empty($e)) {
                $error = $e->getMessage();
            }
        } finally {
            if (!empty($error)) {
                $data = array('error' => $error);
            }
            return $data;
        }
    }
}