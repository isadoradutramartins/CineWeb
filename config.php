
<?php
$host = '200.19.1.18'; // Host do banco de dados
$dbname = 'isadoramartins'; // Nome do banco de dados
$username = 'isadoramartins'; // Nome de usuário do banco de dados
$password = '123456'; // Senha do banco de dados

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>
