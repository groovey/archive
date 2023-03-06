<?php

namespace App\Services;

/**
 * Postgres sql wrapper class
 */
class DB
{
    public $conn;

    /**
     * Constructor to connect to db
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Connect to the database via env variables
     */
    public function connect()
    {
        $host     = getenv('DB_HOST');
        $port     = getenv('DB_PORT');
        $database = getenv('DB_DATABASE');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        
        try {
            $conn = "host=$host port=$port dbname=$database user=$username password=$password";
            $this->conn = pg_connect($conn);
            return $this->db;
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    /**
     * Gets the current connection resource
     */
    public function getConnection()
    {
        return $this->conn;
    }

    /**
    * Executes query syntax
    */
    public function query($query)
    {
        $result = pg_query($this->conn, $query);
        if (!$result) {
            print "Something is wrong with the query: $query";
            die();
        }
        
        return $result;
    }
    
    /**
     * Fetch associate data array
     */
    public function fetch($query)
    {
        $data   = [];
        $result = $this->query($query);

        while ($row = pg_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }
}
