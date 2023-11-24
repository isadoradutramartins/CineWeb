<?php
session_start(); 

// apaga todas as variáveis de sessão
session_unset();
session_destroy();

// redireciona para a página inicial
header("Location: ..//index.php");
exit();
?>
