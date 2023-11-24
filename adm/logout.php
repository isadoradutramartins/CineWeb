<?php
session_start(); // Inicia a sessão

// Destroi todas as variáveis de sessão
session_unset();
session_destroy();

// Redireciona para a página de login ou qualquer outra página desejada
header("Location: ..//index.php");
exit();
?>
