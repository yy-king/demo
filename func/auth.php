<?php
/**
 * Created by PhpStorm.
 * User: wanyou
 * Date: 2017/8/8
 * Time: 13:14
 */
namespace Demo\func;

use Demo\func\db\sync;
use Demo\func\request\Request;

class auth
{
    public $login_session;

    public static function setSession()
    {
        $username = Request::req('username');
        $password = Request::req('password');

        //连接mysql
        $query = new sync();

        $username = stripslashes($username);
        $password = md5(md5(md5(stripslashes($password))));

        $query = $query->query("select * from login where password='$password' AND username='$username'");

        $info = current($query);
        if (isset($info['USERNAME'])) {
            $_SESSION['login_user'] = $username;
            return true;
        } else {
            return "用户名或密码不正确 ";
        }
    }

    public function getUserInfo()
    {
        session_start();
        $user_check = $_SESSION['login_user'];

        $db = new sync();
        $ses_sql = $db->query("select username from login where username='$user_check'");

        $row = $ses_sql[0];
        $this->login_session = $row['USERNAME'];

        if (!isset($this->login_session)) {
            header('Location:index.php');
        }
    }

    public static function Auth()
    {
        if (isset($_SESSION['login_user'])) {
            header("location:profile.php");
        }
        return false;
    }
}