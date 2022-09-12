<?php

namespace App\Models;

use PDO;
use PDOException;

class Database
{
    private $connection;
    private static $instance;
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbpass;

    private function __construct()
    {
        $configFile = parse_ini_file(SOURCE_DIR . '/config/config.ini');
        $this->dbhost = $configFile['dbhost'];
        $this->dbname = $configFile['dbname'];
        $this->dbuser = $configFile['user'];
        $this->dbpass = $configFile['pass'];
        try {
            $this->connection = new PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname, $this->dbuser, $this->dbpass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Failed to connect to DB : " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
