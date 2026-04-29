<?php
require_once __DIR__ . '/../../src/utils/Session.php';

// Chamada de function que destroi a sessão e volta usuário para login
Session::destroy();
header('Location: /PROJAE-TCC/public');
exit();
