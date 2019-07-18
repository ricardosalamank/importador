<?php
class Database
{
    public static function StartUp()
    {

        $pdo = new PDO('pgsql:host=192.168.4.61;dbname=demosolatidev;port=5432', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}