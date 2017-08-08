<?php

/**
 * Created by PhpStorm.
 * User: wanyou
 * Date: 2017/8/7
 * Time: 18:02
 */
namespace Demo\func\db;

use PDO;

class sync
{
    //pdo对象
    public $con = NULL;

    public function __construct()
    {
        if (is_null($this->con)) {
            $this->con = new PDO("mysql:host=localhost;dbname=demo05", "root", "root", [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES `utf8`',
                PDO::ATTR_PERSISTENT => TRUE,
            ]);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
        }
        return $this;
    }

    public function query($sql, $para = NULL)
    {
        $sqlType = strtoupper(substr($sql, 0, 6));
        $cmd = $this->con->prepare($sql);
        if ($para != NULL) {
            $cmd->execute($para);
        } else {
            $cmd->execute();
        }
        if ($sqlType == "SELECT") {
            return $cmd->fetchAll();
        }
        if ($sqlType == "INSERT") {
            return $this->con->lastInsertId();
        }
        return $cmd->rowCount();
    }
}