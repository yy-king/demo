<?php
require __DIR__ . '/../vendor/autoload.php';

use Demo\func\login;

$obj = new login();
$obj->loginIn(new Demo\func\request\Request);

if (isset($_SESSION['login_user'])) {
    header("location:profile.php");
}
?>

<html>
<body>
<div id="main">
    <div id="login">
        <form action="" method="post">
            <label>用户名 :</label>
            <input id="name" name="username" type="text"><br/><br/>
            <label>密&nbsp;码 :</label>
            <input id="password" name="password" type="password">
            <input name="submit" type="submit" value=" Login ">
            <span><?php echo $obj->error; ?></span>
        </form>
    </div>
</div>
</body>
</html>