<?php
/**
 * Created by PhpStorm.
 * User: wanyou
 * Date: 2017/8/7
 * Time: 17:40
 */
namespace Demo\func;

use Demo\func\db\sync;

class session
{
    public $login_session;

    public function setSession()
    {
        session_start();
        $user_check = $_SESSION['login_user'];

        $connection = new sync();
        $ses_sql = $connection->query("select username from login where username='$user_check'");

        $row = $ses_sql[0];
        $this->login_session = $row['USERNAME'];

        if (!isset($this->login_session)) {
            header('Location:index.php');
        }
    }
}