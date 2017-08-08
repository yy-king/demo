<?php
/**
 * Created by PhpStorm.
 * User: wanyou
 * Date: 2017/8/8
 * Time: 20:58
 */
namespace Demo\func\csrf;

class token
{
    public function storeCsrfInSession($key, $value)
    {
        if (isset($_SESSION)) {
            $_SESSION[$key] = $value;
        }
    }

    public function removeCsrfFromSession($key)
    {
        $_SESSION[$key] = ' ';
        unset($_SESSION[$key]);
    }

    public function cleanPreviousCsrfs($name)
    {
        foreach ($_SESSION as $key => $val) {
            if (substr($key, 0, strlen($name))) {
                $_SESSION[$key] = ' ';
                unset($_SESSION[$key]);
            }
        }
    }

    public function getCsrfFromSession($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public function generateCsrfToken($formName)
    {
        if (function_exists('hash_algos') && in_array('sha512', hash_algos())) {
            $token = hash('sha512', mt_rand(0, mt_getrandmax()));
        } else {
            $token = ' ';
            for ($i = 0; $i < 128; ++$i) {
                $r = mt_rand(0, 35);
                if ($r < 26) {
                    $c = chr(ord('a') + $r);
                } else {
                    $c = chr(ord('0') + $r - 26);
                }
                $token .= $c;
            }
        }
        $key = $formName . '_' . mt_rand(0, mt_getrandmax());
        $this->cleanPreviousCsrfs($formName);
        $this->storeCsrfInSession($key, $token);
        return array('name' => $key, 'token' => $token);
    }

    public function validateCsrfToken($formName, $tokenValue)
    {
        $token = $this->getCsrfFromSession($formName);
        if ($token === false) {
            return false;
        } elseif ($token === $tokenValue) {
            $result = true;
        } else {
            $result = false;
        }
        $this->removeCsrfFromSession($formName);
        return $result;
    }
}