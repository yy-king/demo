<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

if (!\Demo\func\auth::Auth()) {
    $obj = new  \Demo\func\login();
    $obj->loginIn(new Demo\func\request\Request);
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