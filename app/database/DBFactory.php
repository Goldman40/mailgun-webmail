<?php

namespace app\database;


class DBFactory
{
    static function load() {
        require_once('app/config.php');
        return new DB_Pdo(DB_HOST,DB_NAME,DB_USER,DB_PASS);
    }
    static function Test() {
        $db = new DB_Pdo();
        return $db->DBTest();
    }
}