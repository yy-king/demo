<?php
require __DIR__ . '/../vendor/autoload.php';
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
            echo '用户' . Demo\func\auth::getUserInfo();
            ?>
        </i>
    </b>
    <b id="logout"><a href="out.php">登出</a></b>
</div>
</body>
</html>