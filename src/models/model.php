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
    protected static $connection;

    public static function select($table, $fields, $where = "") 
    {
        $query = "SELECT $fields FROM $table $where";
        $statement = self::$connection->prepare($query);
        if ($statement->execute()) {
            while ($rows = $statement->fetch()) {
                $fetch[] = $rows;
            }
            return $fetch;
        }
    }

    /* /!\ CODE TO REFACTOR ! */
    public static function insert($table, $fields, $values) 
    {
        $splitedValues = explode(',', $values);
        $splitedFields = explode(',', $fields);
        $bindedFields = array_map(function($value) {
            return ":$value";
        }, $splitedFields);
        $strBindedFields = implode(',',$bindedFields);
        
        $query = "INSERT INTO $table ($fields) VALUES ($strBindedFields)";
        $statement = self::$connection->prepare($query);

        for($i = 0; $i < count($splitedValues); $i++) {
            $statement->bindParam($bindedFields[$i], $splitedValues[$i]);
        }

        $statement->execute();
        return self::$connection->lastInsertId();
    }

   public function update($table,$fields, $values, $id) 
    {
        $strValues = "";
        for($i = 0; $i < count($fields); $i++) {
            $field = $fields[$i];
            $strValues .= "$field=:$field";
            if($i < count($fields) - 1) {
                $strValues .= ",";
            }
        }
        $query = "UPDATE $table SET $strValues WHERE id = :id";
        $statement = self::$connection->prepare($query);
        for($i = 0; $i < count($values); $i++) {
            $statement->bindParam(":".$fields[$i], $values[$i]);
        }
        $statement->bindParam(":id", $id);
        $statement->execute();
    }
    public static function initConnection($instance) {
        self::$connection = $instance;
    }
}
Model::initConnection(Database::getInstance()->getConnection());
