<html>
<head>
</head>
<body>
<a href="showTables.php">Назад</a>
</body>
</html>
<?php
ob_start();
//header('Location: showTables.php');
//print_r($_POST);
$pdo = new pdo("mysql:host=localhost;charset=utf8;dbname=nkuznetsov", "nkuznetsov", "neto1907");

$describe = 'DESCRIBE ' . $_POST['changeTable'];

$columnList = $pdo->query($describe);

$array1 = $columnList->fetchAll();

//var_dump($array1);
$i = 0;
foreach ($array1 as $ar) {
    $i++;
    print_r($ar[0]);
    if ($ar[0] !== $_POST['changeName1']) {
        continue;
    }
    $edge = $i - 1;
    $result = $ar;
    var_dump($result);
    if ($result[2] == 'NO') {
        $result[2] = 'NOT NULL';
    }
    if ($result[2] == 'YES') {
        $result[2] = 'NULL';
    }
}
$i = 0;
foreach ($array1 as $ar) {
    $i++;
    if ($i == $edge) {
        $lastRowName = $ar[0];
    }
}

$changeRequest = 'ALTER TABLE `' . $_POST['changeTable'] . '` CHANGE `' . $_POST['changeName1'] . '` `' . $_POST['changeName2'] . '` ' . $result[1] . ' COLLATE "utf8_general_ci" ' . $result[2] . ' AFTER `' . $lastRowName . '`;';
echo '<br />';
print_r($changeRequest);

try {
    $pdo->exec($changeRequest);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit('Ошибка');
}
unset($_POST);
header('Location: showTables.php');
/*
ALTER TABLE `Lesson11_1`
CHANGE `test4` `test5` varchar(20) COLLATE 'utf8_general_ci' NOT NULL AFTER `test3`;*/
