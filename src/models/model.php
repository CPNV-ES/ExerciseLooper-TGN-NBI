<?php
/*
    Project: ExerciseLooper - MAW1.1
    Author: Thomas Grossmann
    Date: 09.09.2022
    Description: 
*/

namespace App\Models;
require_once(SOURCE_DIR."/models/database.php");
use App\Models\Database as Database;

class Model {
    protected $connection;
    public function __construct()
    {
        $database = Database::getInstance();
        $this->connection = $database->getConnection();
    }

    public function select($table, $fields, $where = "") 
    {
        $query = "SELECT $fields FROM $table $where";
        $statement = $this->connection->prepare($query);
        if ($statement->execute()) {
            while ($rows = $statement->fetch()) {
                $fetch[] = $rows;
            }
            return $fetch;
        }
    }

    public function insert($table, $fields, $value = "") 
    {
        $query = "INSERT INTO $fields FROM $table $value";
        $statement = $this->connection->prepare($query);
        if ($statement->execute()) {
            while ($rows = $statement->fetch()) {
                $fetch[] = $rows;
            }
            return $fetch;
        }
    }
}