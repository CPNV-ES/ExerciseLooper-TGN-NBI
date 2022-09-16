<?php
/*
    Project: ExerciseLooper - MAW1.1
    Author: Thomas Grossmann
    Date: 12.09.2022
    Description: Model Class with centralization of all SQL queries
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
    /* /!\ CODE TO REFACTOR ! */
    public function insert($table, $fields, $values) 
    {
        $splitedValues = explode(',', $values);
        $splitedFields = explode(',', $fields);
        $bindedFields = array_map(function($value) {
            return ":$value";
        }, $splitedFields);
        $strBindedFields = implode(',',$bindedFields);
        
        $query = "INSERT INTO $table ($fields) VALUES ($strBindedFields)";
        $statement = $this->connection->prepare($query);

        for($i = 0; $i < count($splitedValues); $i++) {
            $statement->bindParam($bindedFields[$i], $splitedValues[$i]);
        }

        $statement->execute();
        return $this->connection->lastInsertId();
    }
}