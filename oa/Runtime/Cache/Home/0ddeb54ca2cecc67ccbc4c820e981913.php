<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2 style="text-align: center;background-color: #1f292e;color: #fff0ff;"><?php echo ($data["email_title"]); ?></h2>
    <p style="text-indent:12px;text-decoration: underline;"><?php echo ($data["email_content"]); ?></p>
</body>
</html>