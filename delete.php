<html>
<head>
</head>
<body>
<a href="showTables.php">Назад</a>
</body>
</html>
<?php
ob_start();
header('Location: showTables.php');
//print_r($_POST);
$pdo = new pdo("mysql:host=localhost;dbname=nkuznetsov", "nkuznetsov", "neto1907");
try {
    $delRequest = 'ALTER TABLE ' . $_POST['delTable'] . ' DROP ' . $_POST['delValue'];
    $pdo->exec($delRequest);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit('Ошибка');
}
unset($_POST);
?>
