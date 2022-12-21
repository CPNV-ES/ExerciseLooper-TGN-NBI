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

    /**
     * Initialize the connection instance for the Model class.
     *
     * @param object $instance Connection instance to be used by the Model class.
     *
     * @return void
     */
    public static function initConnection($instance)
    {
        self::$connection = $instance;
    }

    /**
     * Select rows from the specified table in the database.
     *
     * @param string $table  Name of the table to select rows from.
     * @param string $fields Fields to be selected.
     * @param array  $where  (Optional) WHERE conditions to filter rows.
     *
     * @return array|bool Array of selected rows, or false if an error occurred.
     */
    public static function select($table, $fields, $where = [])
    {
        $whereClause = self::generateWhere($where);

        $query = "SELECT $fields FROM $table $whereClause";
        $statement = self::$connection->prepare($query);

        // Bind values for the WHERE clause.
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        // Execute the statement and return the selected rows.
        if ($statement->execute()) {
            return $statement->fetchAll();
        }

        return false;
    }


    /**
     * Generate a WHERE clause for a SELECT, UPDATE or DELETE query.
     *
     * @param array $where Array of WHERE conditions.
     *
     * @return string Generated WHERE clause.
     */
    private static function generateWhere($where)
    {
        if (empty($where)) {
            return "";
        }

        $strWhere = "WHERE ";

        foreach ($where as $key => $value) {
            $strWhere .= "$key = :$key and ";
        }

        return substr($strWhere, 0, -5);
    }


    /**
     * Insert a new row in a table.
     *
     * @param string $table Table name.
     * @param string $fields Comma-separated list of fields.
     * @param string $values Comma-separated list of values.
     *
     * @return int ID of the inserted row.
     */
    public static function insert($table, $fields, $values)
    {
        $bindedFields = array_map(function ($value) {
            return ":$value";
        }, explode(',', $fields));

        $query = "INSERT INTO $table ($fields) VALUES (" . implode(',', $bindedFields) . ")";
        $statement = self::$connection->prepare($query);

        foreach (array_combine($bindedFields, explode(',', $values)) as $field => $value) {
            $statement->bindValue($field, htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
        }

        $statement->execute();
        return self::$connection->lastInsertId();
    }


    /**
     * Update a record in a table
     *
     * @param string $table The name of the table to update
     * @param array $fields An array of field names to be updated
     * @param array $values An array of values to be set for the corresponding fields
     * @param mixed $where The ID or an associative array of WHERE clauses
     */
    public function update($table, $fields, $values, $where)
    {
        $strValues = "";
        foreach ($fields as $key => $field) {
            $strValues .= "$field=:$field";
            if ($key < count($fields) - 1) {
                $strValues .= ",";
            }
        }

        $whereType = gettype($where);
        // If it's an integer or a string (presumably the ID of the record)
        if ($whereType == 'integer' || $whereType == 'string') {
            $query = "UPDATE $table SET $strValues WHERE id = :id";
            $statement = self::$connection->prepare($query);
            for ($i = 0; $i < count($values); $i++) {
                $statement->bindValue(":" . $fields[$i], htmlspecialchars($values[$i], ENT_QUOTES, 'UTF-8'));
            }
            $statement->bindValue(":id", $where);
            $statement->execute();
        } else {
            $strWhere = self::generateWhere($where);
            $query = "UPDATE $table SET $strValues $strWhere";
            $statement = self::$connection->prepare($query);

            foreach ($fields as $key => $field) {
                $statement->bindValue(":$field", htmlspecialchars($values[$key], ENT_QUOTES, 'UTF-8'));
            }

            // Bind the values in the WHERE clause to the corresponding fields
            foreach (array_keys((array) $where) as $key) {
                $statement->bindValue(":$key", htmlspecialchars($where[$key], ENT_QUOTES, 'UTF-8'));
            }
            // Execute the statement
            $statement->execute();
        }
    }



    /**
     * Delete a record from a table
     *
     * @param string $table The name of the table to delete from
     * @param array $where An associative array of WHERE clauses
     */
    public function delete($table, $where)
    {
        $strWhere = self::generateWhere($where);
        $query = "DELETE FROM $table " . $strWhere;
        $statement = self::$connection->prepare($query);

        // Bind the values in the WHERE clause to the corresponding fields
        foreach (array_keys($where) as $key) {
            $statement->bindValue(":$key", $where[$key]);
        }

        $statement->execute();
    }
}
Model::initConnection(Database::getInstance()->getConnection());
