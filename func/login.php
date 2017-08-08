<?php
/**
 * Created by PhpStorm.
 * User: wanyou
 * Date: 2017/8/7
 * Time: 17:29
 */
namespace Demo\func;

class login
{
    public $error = '';

    public function loginIn($request)
    {
        $userName = $request->input('username');
        $password = $request->input('password');

        if (empty($userName) || empty($password)) {
            $this->error = "用户名或密码不可以为空";
            return false;
        } else {
            $ret = auth::setSession();
            $ret === true ? header("location: profile.php") : $this->error = $ret;
            return true;
        }
    }

    public function loginOut()
    {
        session_start();
        if (session_destroy()) {
            header("Location:/");
        }
    }
}

