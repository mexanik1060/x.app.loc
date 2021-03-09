<?php


namespace System\library\db;



use JetBrains\PhpStorm\NoReturn;
use PDO;
use PDOException;
use RangeException;


class DBPDO
{
    private $connection = null;
    private $statement = null;
    private array $parameter = [];
    protected array $settings = [];


    public function __construct($driver, $hostname, $dbname, $username, $password, $port = 3306)
    {
        try {

            $this->connection = new \PDO($driver . ':dbname=' . $dbname . ';host=' . $hostname . ';port=' . $port, $username, $password, [\PDO::ATTR_PERSISTENT => true]); //, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);


            // Задаем кодировку
            //$this->connection->exec("set names utf8");
            $this->connection->exec("SET NAMES 'utf8'");
            $this->connection->exec("SET CHARACTER SET utf8");
            $this->connection->exec("SET CHARACTER_SET_CONNECTION=utf8");
            $this->connection->exec("SET SQL_MODE = ''");

        } catch (\PDOException $e) {
            throw new \RangeException('Ошибка: Подключение к базе данных не состоялось. 
            Причина:' . '\'' . $e->getMessage() . '\'!!!');
        }


    }


    /**
     * Методы clone и wakeup предотвращают создание экземпляров класса Singleton извне,
     * что исключает возможность дублирования объектов.
     */
    #[NoReturn] public function __clone() {
        trigger_error('Клонировать нельзя.', E_USER_ERROR);
    }

    #[NoReturn] public function __wakeup() {
        trigger_error('Десериализация не допускается.', E_USER_ERROR);
    }

    /**
     * @param array $settings
     */
    public function dbSettings(array $settings): void
    {
        $this->settings = $settings;
    }

    /**
     * @param $sql
     */
    public function dbCreateTable($sql)
    {
        $this->statement = $this->connection->exec($sql);
    }

    /**
     * @return bool
     */
    public function beginTransaction(): bool
    {
        return $this->connection->beginTransaction();
    }

    /**
     * @return bool
     */
    public function endTransaction(): bool
    {
        if ($this->connection->commit()){
            return true;
        }else {
            return $this->connection->rollBack();
        }
    }

    /**
     * @param $sql
     */
    public function dbPrepare(string $sql): void
    {
        $this->statement = $this->connection->prepare($sql);
    }

    /**
     * Привязывает параметр запроса к переменной
     *
     * @param mixed $parameter
     * @param mixed $variable
     * @param int $data_type
     * @param int $length
     */
    public function dbBindParam(mixed $parameter, mixed $variable, $data_type = \PDO::PARAM_STR, $length = 0): void
    {
        if ($length) {
            $this->statement->bindParam($parameter, $variable, $data_type, $length);
        } else {
            $this->statement->bindParam($parameter, $variable, $data_type);
        }

    }

    /**
     * Связывает параметр с заданным значением
     *
     * @param mixed $parameter
     * @param mixed $value
     * @param int $data_type
     */
    public function dbBindValue(mixed $parameter, mixed $value, $data_type = \PDO::PARAM_STR)
    {
            $this->statement->bindValue($parameter, $value, $data_type);
    }

//------------------------обработка данных--------------------------------
    public function dbExecute() {
        try {
            if ($this->statement && $this->statement->execute()) {
                $data = [];

                while ($row = $this->statement->fetch(\PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->row = (isset($data[0])) ?? [];
                $result->rows = $data;
                $result->num_rows = $this->statement->rowCount();
            }
        } catch(\PDOException $e) {
            throw new \RangeException('Ошибка: ' . $e->getMessage() . ' Код ошибки : ' . $e->getCode());
        }
    }

    public function dbQuery($sql, $params = []): \stdClass
    {
        $this->statement = $this->connection->prepare($sql);

        $result = false;

        try {
            if ($this->statement && $this->statement->execute($params)) {
                $data = [];

                while ($row = $this->statement->fetch(\PDO::FETCH_ASSOC)) {
                    $data[] = $row;
                }

                $result = new \stdClass();
                $result->row = (isset($data[0]) ?? []);
                $result->rows = $data;
                $result->num_rows = $this->statement->rowCount();
            }
        } catch (\PDOException $e) {
            throw new \RangeException('Ошибка: ' . $e->getMessage() . ' Код ошибки: ' . $e->getCode() . ' <br />' . $sql);
        }

        if ($result) {
            return $result;
        } else {
            $result = new \stdClass();
            $result->row = [];
            $result->rows = [];
            $result->num_rows = 0;
            return $result;
        }
    }


    public function dbSingle(){
        $this->statement->execute();
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }
//----------------------------------------------------------------------------------------
//Вставляем многомерный массив в базу данных через подготовленный запрос
    public function dbQueryBindInsert($sql, $bind_params = []): void
    {
        $this->statement = $this->connection->prepare($sql);

        if (count($bind_params)) {
            foreach ($bind_params as $parameter => $value) {
                $counter = 1;
                for ($i = 0, $iMax = count($value); $i < $iMax; $i++) {
                    $this->statement->bindValue($counter++, $value[$i]);
                }
                $this->statement->execute();
            }
        }
    }
//----------------------------------------------------------------------------------------
    /**
     * @param $value
     * @return string|string[]
     */
    public function dbEscape($value): array|string
    {
        return str_replace(["\\", "\0", "\n", "\r", "\x1a", "'", '"'], ["\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"'], $value);
    }

    /**
    * Возвращает количество строк, затронутых последним SQL-запросом
    *
    */
    public function dbCountAffected(): int
    {
        if ($this->statement) {
            return $this->statement->rowCount();
        } else {
            return 0;
        }
    }

    /**
     * Получаем id вставленной записи - Возвращает ID последней вставленной строки
     *
     */
    public function dbGetLastId(): string
    {
        return $this->connection->lastInsertId();
    }

    /**
     * Проверка соединения
     *
     * @return bool
     */
    public function dbIsConnected(): bool
    {
        if ($this->connection) {
            return true;
        } else {
            return false;
        }
    }

    public function __destruct()
    {
        $this->connection = null;
    }
}

