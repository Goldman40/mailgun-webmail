<?php

namespace app\controller;


use app\auth\getUserInfos;
use app\auth\Permissions;
use app\mailaction\MailManage;
use app\mailaction\MailRead;

class Controller_trash
{
    public function Call() {
        try {
            if (!empty($_POST) AND $_POST['action'] == 'MoveToIn') {
                unset($_POST['action']);
                $d = new MailManage();
                $d->MoveToInbox($_POST);
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

            $d = new MailRead();
            $data['mails'] = $d->getMailTrash($need);
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