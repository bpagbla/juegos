<?php
class Carrito
{
    private static $juegos = [];

    function __construct()
    {


    }

    public static function setCarrito($juegos)
    {
        self::$juegos = $juegos;
    }

    public static function meterJuegoCarrito($idJuego, $nombreJuego)
    {
        self::$juegos[$idJuego] = $nombreJuego; //Se añade el juego al carrito
    }

    public static function sacarJuegoCarrito($idJuego)
    {
        unset(self::$juegos[$idJuego]); //se quita el juego del array productos
    }

    public static function getCarrito()
    {

        return self::$juegos;

    }

    public function mostrarCarrito($id)
    {


    }

}