<?php
class Carrito
{
    private static $juegos = [];

    function __construct()
    {
        if (isset($_SESSION['carrito'])) {
            self::$juegos = $_SESSION['carrito'];
        }
    }

    public static function setCarrito($juegos)
    {
        self::$juegos = $_SESSION['carrito'];
        self::$juegos = $juegos;
        // Save carrito to the session
        $_SESSION['carrito'] = self::$juegos;
    }

    public static function meterJuegoCarrito($idJuego, $nombreJuego)
    {
        self::$juegos = $_SESSION['carrito'];
        self::$juegos[$idJuego] = $nombreJuego; //Se añade el juego al carrito
        $_SESSION['carrito'] = self::$juegos;
    }

    public static function sacarJuegoCarrito($idJuego)
    {
        self::$juegos = $_SESSION['carrito'];
        unset(self::$juegos[$idJuego]); //se quita el juego del array productos
        $_SESSION['carrito'] = self::$juegos;
    }

    public static function getCarrito()
    {
        self::$juegos = $_SESSION['carrito'];
        return self::$juegos;

    }

    public function mostrarCarrito($id)
    {


    }

}