<?php
class Database
{
    /**************************************
     * Работа с БД
     **************************************/
    private $mysqli;
    private $res;
    public function __construct()
    {
        $this->connect();
    }
    public function connect()
    {
        if (isset($this->mysqli))
        {
            return $this->mysqli;
        }
        else
        {
            $this->mysqli = new mysqli(DB_HOST,DB_LOGIN,DB_PASS,DB_NAME);
        }
    }
    public function query($query)
    {
        if (empty($query))
        {
            return false;
        }
        else
        {
            return $this->res = $this->mysqli->query($query);
        }
    }
    public function results()
    {
        $this->mysqli->errno;
        $this->mysqli->error;
        $results = array();
        //var_dump($res = $this->res);
        while ($res = $this->res->fetch_assoc()) {
            $results[] = $res;
        }
        return $results;
    }
    public function result() {
        return $this->res->fetch_assoc();
    }

    public function resId()
    {
        return $this->mysqli->insert_id;
    }
}