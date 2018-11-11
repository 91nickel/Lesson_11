<?php
//var_dump($_POST);
$pdo = new pdo("mysql:host=localhost;dbname=nkuznetsov", "nkuznetsov", "neto1907");

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
}

$sql = 'SELECT * FROM ' . $_POST['tableName'].';';
//print_r($sql);
echo '<table>';
foreach ($pdo->query($sql) as $rows) {
    echo '<tr>';
    for ($i = 0; $i<count($rows)/2; $i++) {
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
<body>
<a href="showTables.php">Назад</a>
</body>
</html>
