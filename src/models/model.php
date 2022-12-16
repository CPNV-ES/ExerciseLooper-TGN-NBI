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
        // Set the connection instance for the Model class.
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
        // Generate the WHERE clause based on the provided conditions.
        $whereClause = self::generateWhere($where);

        // Prepare the SELECT statement.
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
        // Return an empty string if no WHERE conditions are provided.
        if (empty($where)) {
            return "";
        }

        // Initialize the WHERE clause with the "WHERE" keyword.
        $strWhere = "WHERE ";

        // Append each WHERE condition to the clause.
        foreach ($where as $key => $value) {
            $strWhere .= "$key = :$key and ";
        }

        // Remove the last "and" from the clause.
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
        // Bind each field name with a placeholder.
        $bindedFields = array_map(function ($value) {
            return ":$value";
        }, explode(',', $fields));

        // Create the INSERT query.
        $query = "INSERT INTO $table ($fields) VALUES (" . implode(',', $bindedFields) . ")";
        $statement = self::$connection->prepare($query);

        // Bind each value to its corresponding placeholder.
        foreach (array_combine($bindedFields, explode(',', $values)) as $field => $value) {
            $statement->bindValue($field, $value);
        }

        // Execute the query and return the ID of the inserted row.
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
        // Initialize a string to hold the SET clause
        $strValues = "";
        // Loop through the fields and create the SET clause
        foreach ($fields as $key => $field) {
            $strValues .= "$field=:$field";
            // Add a comma if it's not the last field
            if ($key < count($fields) - 1) {
                $strValues .= ",";
            }
        }

        // Check the type of the where parameter
        $whereType = gettype($where);
        // If it's an integer or a string (presumably the ID of the record)
        if ($whereType == 'integer' || $whereType == 'string') {
            // Create the query with a WHERE clause using the ID
            $query = "UPDATE $table SET $strValues WHERE id = :id";
            // Prepare the statement
            $statement = self::$connection->prepare($query);
            // Bind the values to the corresponding fields
            for ($i = 0; $i < count($values); $i++) {
                $statement->bindValue(":" . $fields[$i], $values[$i]);
            }
            // Bind the ID to the WHERE clause
            $statement->bindValue(":id", $where);
            // Execute the statement
            $statement->execute();
        } else {
            // If it's not an integer or a string, it must be an associative array of WHERE clauses
            // Call the generateWhere method to create the WHERE clause string
            $strWhere = self::generateWhere($where);
            // Create the query with the WHERE clause
            $query = "UPDATE $table SET $strValues $strWhere";
            // Prepare the statement
            $statement = self::$connection->prepare($query);
            // Bind the values to the corresponding fields
            foreach ($fields as $key => $field) {
                $statement->bindValue(":$field", $values[$key]);
            }
            // Bind the values in the WHERE clause to the corresponding fields
            foreach (array_keys((array) $where) as $key) {
                $statement->bindValue(":$key", $where[$key]);
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
        // Call the generateWhere method to create the WHERE clause string
        $strWhere = self::generateWhere($where);
        // Create the query with the WHERE clause
        $query = "DELETE FROM $table " . $strWhere;
        // Prepare the statement
        $statement = self::$connection->prepare($query);
        // Bind the values in the WHERE clause to the corresponding fields
        foreach (array_keys($where) as $key) {
            $statement->bindValue(":$key", $where[$key]);
        }
        // Execute the statement
        $statement->execute();
    }
}
Model::initConnection(Database::getInstance()->getConnection());
