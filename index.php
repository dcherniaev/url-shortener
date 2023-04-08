<?php
require __DIR__ . '/check_url.php';
require __DIR__ . '/redirect.php';
require __DIR__ . '/cut.php';

$url = !empty($_POST) ? $_POST['long_link'] : '';
$key = !empty($_GET) ? $_GET['s'] : '';

if (checkURL($url)) {
    $short_url = create_short_url($url);
} else {
    $error = 'Please insert correct URL';
}

if ($key != ''){
    header(redirect($key));
}


?>
<html>
<head>
    <title>Shortly</title>
</head>
<body>
<?php if (isset($error)): ?>
<?= $error ?>
<?php endif; ?>
<?php if (isset($short_url)): ?>
    Your short URL: <?= $short_url ?>
<?php endif; ?>
<br>
<form action="/index.php" method="post">
    <label for="long_link">Long link: </label><input type="text" name="long_link">
    <br>
    <input type="submit" value="Cut!">
</form>
</body>
</html>