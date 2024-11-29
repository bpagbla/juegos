<?php
class BaseDeDatos
{
    private $db;
public function conectar(){
    include "../bd/conf.env";
    try{
       $this->db=new PDO($dsn, $usuario, $password); 
    }catch (PDOException $e) {
        echo "Error (" . $e->getCode() . ") al abrir " .
            "la base de datos: " . $e->getMessage();
    }
    
}


//ESTA NO ESTÁ BIEN ES COPYPASTE
public function consulta($sql){
    try {
        $consulta = $this->db->query($sql);
        echo "<br>";
        foreach ($consulta as $row) {
            echo "código: " . $row["codigo"] . "<br>";
            echo "nombre: " . $row["nombre"] . "<br>";
            echo "nombre corto: " . $row["nomcor"] . "<br>";
            echo "precio: " . $row["precio"] . "<br>";
            echo "unidades: " . $row["uds"] . "<br>";
            echo "----- <br>";
        }
    } catch (PDOException $e) {
        echo "Error (" . $e->getCode() . ") al abrir " .
            "la base de datos: " . $e->getMessage();
    }
}

}