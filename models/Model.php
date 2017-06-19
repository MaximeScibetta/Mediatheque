<?php

namespace Models;

use \PDO;

class Model
{
    public function connectDB()
    {
        $dbConfig = @parse_ini_file(DB_INI_FILE);
        $dsn = sprintf(
            'mysql:dbname=%s;host=%s',
            $dbConfig['DB_NAME'],
            $dbConfig['DB_HOST']
        );
        try {

            return new PDO(
                $dsn,
                $dbConfig['DB_USER'],
                $dbConfig['DB_PASS'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                ]
            );
        } catch (PDOException $e) {

            return false;
        }
    }

}