<?php
/*
    Project: ExerciseLooper - Maw1.1
    Author: Thomas Grossmann
    Date: 12.09.2022
    Description: Class Database that create the PDO Connection using the Singleton Pattern
*/

namespace Src\Models;

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

    /**
     * Private constructor for the Database class, to implement the singleton pattern
     */
    private function __construct()
    {
        $configFile = parse_ini_file(SOURCE_DIR . '/config/config.ini');

        // Save the configuration values
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

    /**
     * Get the singleton instance of the Database class
     *
     * @return Database Singleton instance of the Database class
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Get the PDO connection object
     *
     * @return PDO PDO connection object
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
