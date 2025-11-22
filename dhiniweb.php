<?php
declare(strict_types=1); // PHP 8.4 recommended

$name = "Dhini julia";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halo dari PHP 8.4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .box {
            background: #ffffff;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.12);
            text-align: center;
        }
        h1 { margin-bottom: 12px; }
        p { font-size: 16px; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Halo! 👋</h1>
        <p>Ini web PHP sederhana buatan <b><?= htmlspecialchars($name) ?></b></p>
        <p>Salam kenal dari PHP 8.4!</p>
    </div>
</body>
</html>

