<?php
require_once __DIR__ . '/../utils/Session.php';

session_start();

function verificarLogin()
{
    Session::start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../../public/index.php");
        exit();
    }
}

function verificarTipo($tipo)
{
    verificarLogin();

    if ($_SESSION['user_tipo'] !== $tipo) {
        header("Location: ../../public/index.php");
        exit();
    }
}
