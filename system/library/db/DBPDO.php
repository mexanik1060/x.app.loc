<?php


namespace System\library\db;


class DBPDO
{
    private $connection = null;
    private $statement = null;

    public function __construct(string $driver, string $dbname, string $hostname, string $username, string $password, int $port = 3306)
    {
        try {
            $this->connection = new \PDO($driver . ':dbname=' . $dbname . ';host=' . $hostname . ';port=' . $port, $username, $password);//, [\PDO::ATTR_PERSISTENT => true]
            //----------//Включено на єтапе разработки
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

            // Задаем кодировку
            $this->connection->exec("set names utf8");
/*
            //-----------
            if ($this->connection) {
                echo 'Подключился к база данных';
            }//-----------
*/
        } catch (\PDOException $e) {

            throw new \RuntimeException('Не удалось подключиться к базе данных. Причина: \'' . $e->getMessage() . '\'');

        }
    }

    public function prepare($sql)
    {
        $this->statement = $this->connection->prepare($sql);
    }






    public function dbIsConnection()
    {
        if ($this->connection){
            //return true;
            echo '<br> DB connect OK';
        } else {//return false;
        echo '<br> DB connect NO';}
    }
    public function __destruct()
    {
        $this->connection = null;

    }



}
