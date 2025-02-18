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
    /**
     * Función para establecer el carrito con los ID de los juegos que se pasen en un array como parametro
     * @param array $juegos
     * 
     * @return void
     */
    public function setCarrito($juegos)
    {
        $this->juegos = $juegos;
        // Save the carrito to the session
        $_SESSION['carrito'] = $this->juegos;
    }

    // Add a game to the carrito
    /**
     * Función para añadir un juego al carrito. Se almacena el id, el nombre y el precio
     * @param int $idJuego
     * @param string $nombreJuego
     * @param int $precio
     * 
     * @return void
     */
    public function meterJuegoCarrito($idJuego, $nombreJuego, $precio)
    {
        $this->juegos[$idJuego] = [$nombreJuego, $precio]; // Add the game to the carrito
        $_SESSION['carrito'] = $this->juegos;  // Save the updated carrito to session
    }

    // Remove a game from the carrito
    /**
     * Función para eliminar un juego del carrito
     * @param int $idJuego
     * 
     * @return void
     */
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
