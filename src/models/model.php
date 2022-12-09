<?php
/*
    Project: ExerciseLooper - MAW1.1
    Author: Thomas Grossmann
    Date: 12.09.2022
    Description: Model Class with centralization of all SQL queries
*/

namespace Src\Models;

use Src\Models\Database;

class Model
{
    protected static $connection;

    public static function select($table, $fields, $where = [])
    {
        $strWhere = self::generateWhere($where);
        $query = "SELECT $fields FROM $table $strWhere";
        $statement = self::$connection->prepare($query);

        foreach($where as $key => $value) {
            $statement->bindParam(":".trim($key),trim($value));
        }

        if ($statement->execute()) {
            while ($rows = $statement->fetch()) {
                $fetch[] = $rows;
            }
            return $fetch;
        }
    }

    private static function generateWhere($where) {
        if (!empty($where)) {
            $strWhere = "WHERE ";
            foreach ($where as $key => $value) {
                    $strWhere .= "$key = :$key and ";
            }
            $strWhere = substr($strWhere, 0 , -5);
            return $strWhere;
        }
        return "";
    } 

    /* /!\ CODE TO REFACTOR ! */
    public static function insert($table, $fields, $values)
    {
        $splitedValues = explode(',', $values);
        $splitedFields = explode(',', $fields);
        $bindedFields = array_map(function ($value) {
            return ":$value";
        }, $splitedFields);
        $strBindedFields = implode(',', $bindedFields);

        $query = "INSERT INTO $table ($fields) VALUES ($strBindedFields)";
        $statement = self::$connection->prepare($query);

        for ($i = 0; $i < count($splitedValues); $i++) {
            $statement->bindParam(trim($bindedFields[$i]), trim($splitedValues[$i]));
        }

        $statement->execute();
        return self::$connection->lastInsertId();
    }

    public function update($table, $fields, $values, $where)
    {
        $strValues = "";
        for ($i = 0; $i < count($fields); $i++) {
            $field = $fields[$i];
            $strValues .= "$field=:$field";
            if ($i < count($fields) - 1) {
                $strValues .= ",";
            }
        }
        $whereType = gettype($where);

        if($whereType == 'integer' || $whereType == 'string') {
            $query = "UPDATE $table SET $strValues WHERE id = :id";
            $statement = self::$connection->prepare($query);
            for ($i = 0; $i < count($values); $i++) {
                $statement->bindParam(":" . $fields[$i], $values[$i]);
            }
            $statement->bindParam(":id", $where);
            $statement->execute();
        } else {
            $strWhere = self::generateWhere($where);
            $query = "UPDATE $table SET $strValues $strWhere";
            $statement = self::$connection->prepare($query);

            for ($i = 0; $i < count($values); $i++) {
                $statement->bindParam(":$fields[$i]", $values[$i]);
            }
            foreach($where as $key => $value) {
                $statement->bindParam(":".trim($key),trim($value));
            }
            $statement->execute();
        }

    }

    public function delete($table, $where)
    {
        $strWhere = self::generateWhere($where);
        $query = "DELETE FROM $table $strWhere";
        $statement = self::$connection->prepare($query);
        foreach($where as $key => $value) {
            $statement->bindParam(":$key",$value);
        }
        $statement->execute();
    }

    public static function initConnection($instance)
    {
        self::$connection = $instance;
    }
}
Model::initConnection(Database::getInstance()->getConnection());
