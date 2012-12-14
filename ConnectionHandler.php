<?php

require_once(dirname(__FILE__) . '/Constants.php');

class ConnectionHandler {
    private $instance = null;
    private $connection;

    /**
     * Gets instance of connection handler
     */
    public function getInstance()
    {
        if (is_null($instance)) {
            $instance = new ConnectionHandler();
        }

        return $instance;
    }

    /**
     * Initializes database to be used
     */
    public function initDatabaseConnection()
    {
        $username = 'root';
        $password = '';

        $this->connection = mysql_connect('localhost', $username, $password);

        return $this->$connection;
    }

    /**
     * Close connection
     */
    public function closeConnection()
    {
        //$this->connection->
    }
}  