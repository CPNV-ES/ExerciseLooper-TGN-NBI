<?php

namespace App\Db;

use PDO;
use PDOException;

class Database
{
    private $connection;

    public function __construct()
    {
        $db = parse_ini_file(SOURCE_DIR.'/config/config.ini');
        try {
            $pdo = new PDO('mysql:host='.$db['dbhost'].';dbname='.$db['dbname'], $db['user'], $db['pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->connection;
    }
}