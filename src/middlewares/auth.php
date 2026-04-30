<?php
session_start();

function verificarLogin()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

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