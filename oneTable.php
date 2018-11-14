<?php
//var_dump($_POST);
$pdo = new pdo("mysql:host=localhost;charset=utf8;dbname=nkuznetsov", "nkuznetsov", "neto1907");

try {
    $result = $pdo->query("SHOW TABLES");
    $table = $result->fetchAll();
    //print_r($table);
} catch (PDOException $e) {
    echo $e->getMessage();
}
$c = 0;
foreach ($table as $row) {
    if ($row[0] == $_POST['tableName']) {
        $c++;
        echo 'Таблица #' . $c . ' ' . $_POST['tableName'] . '<br /><br />';
        $describe = 'DESCRIBE ' . "$row[0]";
        $columnList = $pdo->query($describe);
        $array1 = $columnList->fetchAll();
        echo '<table>';
        echo '<tr>';
        echo '<td>Название поля</td>';
        echo '<td>Тип переменной</td>';
        echo '<td>NULL</td>';
        echo '<td>Key</td>';
        echo '<td>Default</td>';
        echo '<td>Extra</td>';
        echo '<tr>';
        foreach ($array1 as $ar) {
            echo '<tr>';
            echo '<td>' . $ar[0] . '</td>';
            echo '<td>' . $ar[1] . '</td>';
            echo '<td>' . $ar[2] . '</td>';
            echo '<td>' . $ar[3] . '</td>';
            echo '<td>' . $ar[4] . '</td>';
            echo '<td>' . $ar[5] . '</td>';
            echo '<tr>';
        }
        echo '</table><br>';
    }
}

$sql = 'SELECT * FROM ' . $_POST['tableName'] . ';';
$tableName = $_POST['tableName'];
//print_r($tableName);
echo '<table>';
echo '<tr>';
for ($i = 0; $i < count($array1); $i++) {
    echo '<td>';
    echo $array1[$i][0];
    echo '</td>';
}
echo '</tr>';
foreach ($pdo->query($sql) as $rows) {
    echo '<tr>';
    for ($i = 0; $i < count($rows) / 2; $i++) {
        echo '<td>';
        echo $rows[$i];
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';
?>

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
<body><form action="delete.php" method="post">
    <legend>Удалить поле из таблицы</legend>
    <input type="hidden" placeholder="Имя таблицы" name="delTable" value="<?php echo $tableName;?>">
    <input type="text" placeholder="Имя поля" name="delValue">
    <input type="submit" name="delete" value="Удалить">
</form>

<form action="changeName.php" method="post">
    <legend>Изменить имя поля в таблице</legend>
    <input type="hidden" name="changeTable" value="<?php echo $tableName;?>">
    <input type="text" placeholder="Имя изменяемого поля" name="changeName1">
    <input type="text" placeholder="Имя нового поля" name="changeName2">
    <input type="submit" name="changeName" value="Изменить">
</form>
<a href="showTables.php">Назад</a>
</body>
</html>
