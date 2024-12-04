<?php
class BaseDeDatos
{
    private $db;
public function conectar(){
    include "conf.env";
    try{
       $this->db=new PDO($dsn, $usuario, $password);
       print "Funciono";
    }catch (PDOException $e) {
        echo "Error (" . $e->getCode() . ") al abrir " .
            "la base de datos: " . $e->getMessage();
    }
    
}

public function consulta($sql){
    try {
        $consulta = $this->db->query($sql);
        echo "<br>";
        return $consulta;
    } catch (PDOException $e) {
        echo "Error (" . $e->getCode() . ") al abrir " .
            "la base de datos: " . $e->getMessage();
    }
    return;
}

}