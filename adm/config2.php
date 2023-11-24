<?php
$host = '200.19.1.18'; 
$dbname = 'isadoramartins'; 
$username = 'isadoramartins'; 
$password = '123456'; 

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>
