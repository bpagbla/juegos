<?php
class BaseDeDatos
{
    private $db;
public function conectar(){
    include "conf.env";
    try{
       $this->db=new PDO($dsn, $usuario, $password);
    }catch (PDOException $e) {
        echo "Error (" . $e->getCode() . ") al abrir " .
            "la base de datos: " . $e->getMessage();
    }
    
}

public function consulta($sql){
    try {
        $consulta = $this->db->query($sql);
        return $consulta;
    } catch (PDOException $e) {
        echo "Error (" . $e->getCode() . ") al abrir " .
            "la base de datos: " . $e->getMessage();
    }
    return;
}

}