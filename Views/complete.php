<?php
require_once(ROOT_PATH .'Controllers/ContactController.php');
$contact = new ContactController();
$contact->updateOrCreate();
$_SESSION = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>入力内容は、正常に送信されました。</p>
    <button onclick="location.href='index.php'">トップページへ</button>
</body>
</html>