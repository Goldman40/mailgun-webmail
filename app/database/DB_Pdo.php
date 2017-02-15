<?php

namespace app\database;

use \PDO;

class DB_Pdo
{
    private $db_host;
    private $db_user;
    private $db_name;
    private $db_pass;
    private $pdo;

    public function __construct($db_host = 'localhost', $db_name = 'yourcms.fr', $db_user = 'root', $db_pass = '')
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }
    private function getPDO()
    {
        if($this->pdo === null) {
            $pdo = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8', $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $pdo;
    }
    public function DBTest() {
        if($this->getPDO() instanceof PDO) {
            return true;
        } else {
            return false;
        }
    }
    public function query($statement, $one = false)
    {
        str_replace('\'', ' ', $statement);

        $req = $this->getPDO()->query($statement);
        $req->setFetchMode(PDO::FETCH_ASSOC);

        if($one) {
            $data = $req->fetch();
        }
        else {
            $data = $req->fetchAll();
        }
        return $data;
    }
    public function prepare($statement, $attributes, $one = false, $isint = false)
    {
        $req = $this->getPDO()->prepare($statement);
        if($isint == false) {
            $req->execute($attributes);
        } else {
            $req->bindValue('first', $attributes['first'], PDO::PARAM_INT);
            $req->bindValue('last', $attributes['last'], PDO::PARAM_INT);
            $req->execute();
        }
        if($req != NULL) {

            $req->setFetchMode(PDO::FETCH_ASSOC);

            if($one) {
                $data = $req->fetch();
            } else {
                $data = $req->fetchAll();
            }
            return $data;
        } else {
            return NULL;
        }
    }
    public function insert($statement, $attributes)
    {
        str_replace('\'', ' ', $statement);
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);

        return true;
    }
}