<?php

namespace Panda\connexion;

use PDO;
use PDOException;

class conx
{

    public PDO $dbh;

    public function __construct()
    {
        require_once 'enum.php';
        $path = File::CONX->path();
        require_once $path;

        try {
            $this->dbh = new PDO('mysql:host=' . $conf['db']['host'] . ';dbname=' . $conf['db']['dataBase'], $conf['db']['user'], $conf['db']['password']);
        } catch (PDOException $e) {
            $msg = "Erreur !:" . $e->getMessage() . '<br/>';
            die($msg);
        }
    }

    public function request(string $selected, string $from, bool $where = false, string $key = '', string $val = '', bool $order = false, string $whatOrder = '', string $direction = 'DESC', bool $limit = false, string $howMany = '', string $fetchMode = 'fetchAll'): mixed
    {
        $completion = '';

        if ($where) {
            $completion = ' WHERE ' . $key . '=' . $val;
        }
        if ($order) {
            $completion .= ' ORDER BY ' . $whatOrder . ' ' . $direction;
        }
        if ($limit) {
            $completion .= ' LIMIT ' . $howMany;
        }
        if (!$where && !$order && !$limit) {
            $completion = null;
        }

        return $this->dbh->query('SELECT ' . $selected . ' FROM ' . $from . $completion, PDO::FETCH_ASSOC)->{$fetchMode}();
    }

    public function lastID(){
        return $this->dbh->lastInsertId();
    }
    public function search()
    {
        return $this->dbh->prepare('SELECT p.title, p.id, p.author, u.firstname, u.lastname FROM post p LEFT JOIN user u ON u.id = p.author WHERE concat(u.firstname, u.lastname, p.title) regexp ?');
    }

    public function insertArrayBDD(string $table, array $data): void
    {
        $keysComm = implode(", ", array_keys($data));
        $keysCommCols = implode(", :", array_keys($data));


        $sql = sprintf("INSERT INTO %s (%s) VALUES(%s)", $table, $keysComm, ":" . $keysCommCols);
        $addUser = $this->dbh->prepare($sql);
        $addUser->execute($data);
    }

    public function insertBDD(string $table, object $data): bool
    {
        $dataTab = get_object_vars($data);
        $fields = array_keys($dataTab);
        $values = array_values($dataTab);
        $values_count = count($values);
        $values_str = '';
        for ($i = 0; $i < $values_count; ++$i) {
            $values_str .= ':p' . $i;
            if ($i < $values_count - 1) {
                $values_str .= ',';
            }
        }

        $reqinsert = sprintf("INSERT INTO %s (%s) VALUES(%s)", $table, implode(',', $fields), $values_str);
        $prepared = $this->dbh->prepare($reqinsert);
        for ($i = 0; $i < (int)count($dataTab); $i++) {
            switch (gettype($values[$i])) {
                case "NULL":
                    $type = PDO::PARAM_NULL;
                    break;
                case "boolean":
                    $type = PDO::PARAM_BOOL;
                    break;
                case "integer":
                    $type = PDO::PARAM_INT;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
            $prepared->bindParam(':p' . $i, $values[$i], $type);
        }
        return $prepared->execute();
    }

    public function __destruct()
    {
        is_null($this->dbh);
    }
}
