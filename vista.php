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

    public static function mostrarPrincipal($games,$prestados=array(), $show=array(), $gen=array(), $sist=array()) {
        $page = "principal";
        include_once "frm/templates/base.php";
    }

    public static function mostrarRegistro($allPosts,$added,$passwdBien) {
        include_once "frm/registro.php";
    }

    public static function mostrarAdminUsuarios($userError, $users, $reqUser=array(), $cards=array()) {
        $page = "adm-usuarios";
        include_once "frm/templates/base.php";
    }

    public static function mostrarAdminJuegos($games, $generos, $sistemas, $companias) {
        $page = "adm-juegos";
        include_once "frm/templates/base.php";
    }

    public static function mostrarAdminGeneros($generos) {
        $page = "adm-generos";
        include_once "frm/templates/base.php";
    }

    public static function mostrarAdminSistemas($sistemas) {
        $page = "adm-sistemas";
        include_once "frm/templates/base.php";
    }

    public static function mostrarAdminEmpresa($companies, $games='') {
        $page = "adm-company";
        include_once "frm/templates/base.php";
    }

    public static function mostrarJuegos($games, $show=array(), $gen=array(), $sist=array()) {
        $page = "juegos";
        include_once "frm/templates/base.php";
    }

    public static function mostrarAjustes($userData,$cards=array()) {
        $page = "ajustes";
        include_once "frm/templates/base.php";
    }

    public static function mostrarCheckout($cards=array()) {
        include_once "frm/checkout.php";
    }

    public static function mostrar404() {
        include_once "frm/404.php";
    }

    public static function showAPIGames($json) {
        include_once "frm/api.php";
    }

    public static function mostrarJugar($ruta) {
        include_once "frm/jugar.php";
    }


}