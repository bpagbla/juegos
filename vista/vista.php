<?php

class Vista
{
    public static function mostrarLanding(): void
    {
        include_once "../frm/landing.php";
    }

    public static function mostrarLogin($loginAttempt): void
    {
        include_once "../frm/login.php";
    }

    public static function mostrarPrincipal($games) {
        include_once "../frm/principal.php";
    }

    public static function mostrarRegistro($allPosts,$added,$passwdBien) {
        include_once "../frm/registro.php";
    }

}