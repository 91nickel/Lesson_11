<html>
<head>
</head>
<body>
<a href="showTables.php">Назад</a>
</body>
</html>
<?php
ob_start();
var_dump($_POST);
$pdo = new pdo("mysql:host=localhost;charset=utf8;dbname=nkuznetsov", "nkuznetsov", "neto1907");
try {
    $delRequest = 'ALTER TABLE ' . $_POST['delTable'] . ' DROP ' . $_POST['delValue'];
    print_r($delRequest);
    $pdo->exec($delRequest);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit('Ошибка');
}
unset($_POST);
header('Location: showTables.php');
?>
