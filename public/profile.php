<?php
require __DIR__ . '/../vendor/autoload.php';

use Demo\func\session;

$obj = new session();
$obj->setSession();

?>

<html>
<head>
    <title>主页</title>
</head>
<body>
<div id="profile">
    <b id="welcome">欢迎 :
        <i>
            <?php
            echo $obj->login_session;
            ?>
        </i>
    </b>
    <b id="logout"><a href="out.php">登出</a></b>
</div>
</body>
</html>