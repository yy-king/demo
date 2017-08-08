<?php
/**
 * Created by PhpStorm.
 * User: wanyou
 * Date: 2017/8/8
 * Time: 13:34
 */
namespace Demo\func\request;

class Request
{
    public function __construct()
    {
        return $this;
    }

    public function input($val, $dft = null)
    {
        $_svr = $_SERVER;
        $_post = $_POST;
        $_get = $_GET;

        if ($_svr['REQUEST_METHOD'] === 'GET') {
            $_param = isset($_get[$val]) ? $_get[$val] : $dft;
        }
        if ($_svr['REQUEST_METHOD'] === 'POST') {
            $_param = isset($_post[$val]) ? $_post[$val] : $dft;
        }

        return $_param;
    }

    public static function req($val, $dft = null)
    {
        return (new self)->input($val, $dft);
    }

    public static function offsetSet($val, $dft)
    {
        $_svr = $_SERVER;
        $_post = $_POST;
        $_get = $_GET;

        if ($_svr['REQUEST_METHOD'] === 'GET') {
           $_get[$val] = $dft;
        }
        if ($_svr['REQUEST_METHOD'] === 'POST') {
            $_post[$val] = $dft;
        }
    }
}