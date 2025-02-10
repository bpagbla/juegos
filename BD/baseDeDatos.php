<?php
class BaseDeDatos
{
    private $db;

    //funcion para conectar a la base de datos
    public function conectar()
    {
        include "conf.env";
        try {
            $this->db = new PDO($dsn, $usuario, $password);
        } catch (PDOException $e) {
            echo "Error (" . $e->getCode() . ") al abrir " .
                "la base de datos: " . $e->getMessage();
        }

    }

    //funcion para hacer consultas con un query sql
    /**
     * @param String $sql
     * @param array $array
     * @return null
     */
    public function consulta(string $sql, array $array=array())
    {
        try {
            $consulta = $this->db->prepare($sql);
            $consulta->execute($array);
            return $consulta->fetchAll();
        } catch (PDOException $e) {
            echo "Error (" . $e->getCode() . ") al abrir " .
                "la base de datos: " . $e->getMessage();
        }
        return null;
    }

    //funcion para insertar datos en la base de daots
    public function insert($sql,$array) {
        $stmt= $this->db->prepare($sql);
        return $stmt->execute($array);
    }

    public function update($sql,$array) {
        return $this->insert($sql,$array);
    }

    public function delete($sql,$array) {
        return $this->insert($sql,$array);
    }

    public function cerrar()
    {

        $this->db = null;

    }

}