<?php
class Carrito
{
    private $juegos = array();

    function __construct()
    {


    }

    public function cargaCarrito($id)
    {


    }

    public function meterJuegoCarrito($idJuego, $nombreJuego)
    {
        if (isset($_POST["juegoCompra$idJuego"])) { //si se ha dado a comprar en algun juego
            $_SESSION["carrito"][$idJuego] = $nombreJuego; //Se añade el juego al carrito
            
        }
    }

    public function guardaCarrito($id)
    {


    }

    public function mostrarCarrito($id)
    {


    }

}