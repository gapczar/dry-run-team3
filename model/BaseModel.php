<?php

require_once(dirname(dirname(__FILE__)) . '/ConnectionHandler.php');

abstract class BaseModel {

    abstract protected function getTableName();

    abstract protected function getInsertFields();

    abstract protected function getFieldsToUpdate();

    abstract protected function transformRowToObjectModel($row);

    /**
     * Instantiates this class
     */
    public function __construct() 
    {
        ConnectionHandler::getInstance()->initDatabaseConnection();
    }

    /**
     * Retrieves all data
     */
    public function retrieveAll($conditions = '', $offset = 0, $limit = 0)
    {
        $tableName = $this->getTableName();

        $sql = "SELECT ".$tableName.".* FROM ".$tableName." WHERE 1 ";

        if (strlen($conditions) > 0) {
            $sql .= ' AND '.$conditions;
        }

        if ($limit > 0) {
            $sql .= " LIMIT (".$offset.', '.$limit.')';
        }

        $results = mysql_query($sql);

        return $this->hydrateData($results);
    }

    /**
     * Retrieve data by pk
     */
    public function retrieveByPk($id)
    {
        try {
            $tableName = $this->getTableName();
            $condition = $tableName.'.id = '.$id;

            $users = $this->retrieveAll($condition);

            if (count($users) > 0) {
                return $users[0];
            }

            return null;

        } catch(\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Retrieve one by columns
     */
    public function retrieveOneByColumns($columns = array())
    {
        try {
            $conditions = $this->implodeGivenColumns($columns);
            $users = $this->retrieveAll($conditions);

            if (count($users) > 0) {
                return $users[0];
            }

            return null;
        } catch(\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Retrieve array by columns
     */
    public function retrieveArrayByColumns($columns = array(), $offset = 0, $limit = 0)
    {
        try {  
            $conditions = $this->implodeGivenColumns($columns);

            return $this->retrieveAll($conditions, $offset, $limit);
        } catch(\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Inserts data
     */
    public function doInsert($data)
    {
        try {
            $tableName = $this->getTableName();

            $sql = "INSERT INTO ".$tableName.
                    '('.implode(', ', $this->getInsertFields()).')'.
                    $this->getValues($data);

            mysql_query($sql);

            return mysql_insert_id();

        } catch(\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Do update
     */
    public function doUpdate($condition)
    {
        try {
            $tableName = $this->getTableName();
            $fields = $this->getFieldsToUpdate();

            $sql = "UPDATE ".$tableName." SET ".$fields.
                    ' WHERE '.$condition;

        } catch(\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * implode columns to make as condition
     */
    private function implodeGivenColumns($columns)
    {
        $ctr = 0;
        $conditions = '';
        $tableName = $this->getTableName();
        $length = count($columns) - 1;

        foreach ($columns as $key => $columnValue) {
            $conditions .= $tableName.'.'.$key.' = '.$columnValue;

            if ($ctr != $length) {
                $conditions .= ' AND ';
            }

            $ctr++;
        }

        return $conditions;
    }

    /**
     * Gets values
     */
    private function getValues($data)
    {
        $values = '';

        if (count($data) > 0) {
            $implodedValues = implode(', ', $data);

            $values = 'VALUES ('.$implodedValues.')';
        }
        
        return $values;
    }

    /**
     * hydrates data
     */
    protected function hydrateData($results)
    {   
        $users = array();

        while ($row = mysql_fetch_array($results, MYSQL_NUM)) {
            $users[] = $this->transformRowToObjectModel($row);
        }

        return $users;
    }
}
