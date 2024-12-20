<?php

class Vista
{
    public static function mostrarLanding(): void
    {
        include_once "frm/landing.php";
    }

    public static function mostrarLogin($loginAttempt): void
    {
        include_once "frm/login.php";
    }

    public static function mostrarPrincipal($games) {
        $page = "principal";
        include_once "frm/templates/base.php";
    }

    public static function mostrarRegistro($allPosts,$added,$passwdBien) {
        include_once "frm/registro.php";
    }

    public static function mostrarAdminUsuarios($games) {
        $page = "adm-usuarios";
        include_once "frm/templates/base.php";
    }

    public static function mostrarAdminJuegos($games) {
        $page = "adm-juegos";
        include_once "frm/templates/base.php";
    }

    public static function mostrarAdminGeneros($games) {
        $page = "adm-generos";
        include_once "frm/templates/base.php";
    }

    public static function mostrarAdminSistemas($games) {
        $page = "adm-sistemas";
        include_once "frm/templates/base.php";
    }

}