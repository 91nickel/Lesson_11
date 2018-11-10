<?php
$pdo = new pdo("mysql:host=localhost;dbname=nkuznetsov", "nkuznetsov", "neto1907");
$request = 'CREATE TABLE `Lesson11_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` int(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  `test1` tinyint NOT NULL,
  `test2` varchar(20) NOT NULL,
  `test3` int NOT NULL
)';
$pdo->exec($request);
?>
