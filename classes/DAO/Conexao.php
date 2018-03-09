<?php

class Conexao {

    protected static $db;

    private function __construct() {
        try {
            self::$db = new PDO("mysql:host=localhost; dbname=compraspagseguro", "root", "root");
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            die("Connection Error: " . $e->getMessage());
        }
    }

    public static function conecta() {

        if (!self::$db) {
            new Conexao();
        }
        return self::$db;
    }

}
