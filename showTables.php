<html>
<head>
    <style>
        table {
            border: 1px solid #ccc;
            border-spacing: 0;
            border-collapse: collapse;
        }

        table td, table tr {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: center;
        }

        td {
            min-width: 150px;
        }
    </style>
</head>
<body>
<?php
$pdo = new pdo("mysql:host=localhost;dbname=nkuznetsov", "nkuznetsov", "neto1907");
$sql = 'SHOW TABLES';

$i = 0;
try {
    $result = $pdo->query("SHOW TABLES");
    $table = $result->fetchAll();
    //print_r($table);
} catch (PDOException $e) {
    echo $e->getMessage();
}

echo 'Список таблиц в базе nkuznetsov:' . '<br /><br />';
$c = 0;
foreach ($table as $row) {
    $c++;
    echo 'Таблица #' . $c . ' ' . $row[0] . '<br /><br />';
    $describe = 'DESCRIBE ' . "$row[0]";
//print_r($describe);
    $columnList = $pdo->query($describe);
    $array1 = $columnList->fetchAll();
    echo '<table>';
    foreach ($array1 as $ar) {
        echo '<tr>';
        echo '<td>Название поля -' . $ar[0] . '</td>';
        echo '<td>Тип переменной - ' . $ar[1] . '</td>';
        echo '<td>NULL -' . $ar[2] . '</td>';
        echo '<td>Key - ' . $ar[3] . '</td>';
        echo '<td>Default - ' . $ar[4] . '</td>';
        echo '<td>Extra - ' . $ar[5] . '</td>';
        echo '<tr>';
        //print_r($ar);
    }
    echo '</table><br>';
}
?>
<form action="delete.php" method="post">
    <legend>Удалить поле из таблицы</legend>
    <input type="text" placeholder="Имя таблицы" name="delTable">
    <input type="text" placeholder="Имя поля" name="delValue">
    <input type="submit" name="delete">
</form>

<form action="changeName.php" method="post">
    <legend>Изменить имя поля в таблице</legend>
    <input type="text" placeholder="Имя таблицы" name="changeTable">
    <input type="text" placeholder="Имя изменяемого поля" name="changeName1">
    <input type="text" placeholder="Имя нового поля" name="changeName2">
    <input type="submit" name="changeName">
</form>

</body>
</html>