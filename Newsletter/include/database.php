<?php
define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","newsletter");

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_SERVER.';port=3306';

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

$db_conn = NULL;

try{
    $db_conn = new PDO($dsn,DB_USER,DB_PASS);
}catch(PDOException $e){
    echo $e->getMessage();
}
?>