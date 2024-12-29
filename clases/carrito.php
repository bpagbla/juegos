<?php
class Carrito
{
    private $juegos = [];

    function __construct()
    {
        // Load the carrito from session if it exists
        if (isset($_SESSION['carrito'])) {
            $this->juegos = $_SESSION['carrito'];
        }
    }

    // Set the carrito (overwrite the current carrito)
    public function setCarrito($juegos)
    {
        $this->juegos = $juegos;
        // Save the carrito to the session
        $_SESSION['carrito'] = $this->juegos;
    }

    // Add a game to the carrito
    public function meterJuegoCarrito($idJuego, $nombreJuego)
    {
        $this->juegos[$idJuego] = $nombreJuego; // Add the game to the carrito
        $_SESSION['carrito'] = $this->juegos;  // Save the updated carrito to session
    }

    // Remove a game from the carrito
    public function sacarJuegoCarrito($idJuego)
    {
        unset($this->juegos[$idJuego]); // Remove the game from the carrito
        $_SESSION['carrito'] = $this->juegos;  // Save the updated carrito to session
    }

    // Get the current carrito
    public function getCarrito()
    {
        return $this->juegos;
    }
}
