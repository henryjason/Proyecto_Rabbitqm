<?php

namespace DB {

    use Mysqli;

    class SqlMySql extends SqlAbstract
    {
        public function __construct($server, $database, $user, $password)
        {
            parent::__construct($server, $database, $user, $password);
        }

        public function connect()
        {
            $this->driver = new mysqli($this->server, $this->user, $this->password, $this->database);
            if ($this->driver->connect_errno) {
                printf("Failed to connect to MySQL: (%s) %s", $this->driver->connect_errno, $this->driver->connect_error);
                exit;
            }
        }
        public function disconnect()
        {
            $this->driver->close();
        }

        public function runSql($sql)
        {
            return $this->driver->query($sql);
        }

        public function nextResultRow($result)
        {
            return $result->fetch_assoc();
        }
    }
}
