<?php
require_once 'src/config/config.php';

// Chamada de function que destroi a sessão e volta usuário para login
Session::destroy();
header('Location: login.php');
exit();
?>