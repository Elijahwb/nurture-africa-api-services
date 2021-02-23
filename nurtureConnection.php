<?php

    include("connectionStatus.php");

    class Connection
    {
        public $pdo;

        public $domain;

        public $domainUserName;

        public $domainPassword;

        public $databaseName;

        public $host;

        function __construct($host, $databaseName, $userName, $domainPassword)
        {
            //initialization of the class properties
            $this->databaseName = $databaseName;
            $this->domainUserName = $userName;
            $this->domainPassword = $domainPassword;
            $this->databaseName = $databaseName;
            $this->host = $host;
            $this->domain = "mysql:host=$host;dbname=$databaseName";
            $this->pdo = null;
        }
        //instantiation of the connection to the DATABASE
        function openConnection()
        {
            try
            {
                $this->pdo = new PDO($this->domain, $this->domainUserName, $this->domainPassword);

                return new ConnectionStatus("CONNECTION SUCCESSFUL", $this->pdo);
            }
            //In case of an error
            catch(Exception $exception)
            {
                return new ConnectionStatus("CONNECTION FAILED", "Nothing");
            }
        }

        //Close the DATABASE connection
        function closeConnection()
        {
            $this->pdo = null;
        }
    }

    class ServerConnection{
        function connectToServer(){
        #Connection("sql313.epizy.com", "epiz_26340426_xyladb", "epiz_26340426", "LfLzX8XpjxNHhxC");
        return new Connection("localhost", "id14606467_nurtureafrica", "id14606467_sandra", "a8--v!6(Rj{ZtUjy");
      }
    }
?>
