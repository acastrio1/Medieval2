<?php

require_once 'db.php';

class producto {
    private $id_producto;
    private $nombre;
    private $descripcion;
    private $clave;
    private $categoria;
    private $imagenSmall;
    private $imagenBig;
    private $precio;
    private $mostrar_main;
    private $db;

    
    public function __construct(){
        $this->db=Database::connect();
    }

    public function getIDProducto(){
        return $this->id_producto;
    }
    public function setIDProducto($id_producto){
        $this->id_producto = $id_producto;
    }
    
    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getClave(){
        return $this->clave;
    }

    public function setClave($clave){
        $this->clave = $clave;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function getImagenSmall(){
        return $this->imagenSmall;
    }

    public function setImagenSmall($imagenSmall){
        $this->imagenSmall = $imagenSmall;
    }

    public function getImagenBig(){
        return $this->imagenBig;
    }

    public function setImagenBig($imagenBig){
        $this->imagenBig = $imagenBig;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }
    public function getMostrarMain(){
        return $this->mostrar_main;
    }

    public function setMostrarMain($mostrar_main){
        $this->mostrar_main = $mostrar_main;
    }

    
    public function searchAll(){
        $sql = "SELECT * FROM productos";
        $searchAll=$this->db->query($sql);
        return $searchAll;
    }

    public function search(){
        $sql = "SELECT * FROM productos WHERE nombre_producto='{$this->getNombre()}'";
        $search=$this->db->query($sql);
        $busqueda = mysqli_fetch_assoc($search);
        return $busqueda;
    }

    public function search_cat(){
        $sql = "SELECT * FROM productos WHERE id_categoria='{$this->getCategoria()}'";
        $search=$this->db->query($sql);
        return $search;
    }

    public function search_id(){
        $sql = "SELECT * FROM productos WHERE id_producto='{$this->getIDProducto()}'";
        $search=$this->db->query($sql);
        $busqueda = mysqli_fetch_assoc($search);
        return $busqueda;
    }

    public function save(){
        //Variable con el sql necesario para ingresar una nueva entrada a la DB
        $sql="INSERT INTO productos VALUES (NULL,'{$this->getNombre()}','{$this->getDescripcion()}','{$this->getClave()}','{$this->getCategoria()}','{$this->getImagenSmall()}','{$this->getImagenBig()}','{$this->getPrecio()}','{$this->getMostrarMain()}')";
        //Hace el query a la DB
        $save=$this->db->query($sql);
        $result=false;//Inicializa la variable que identifica si se realizó la operación
        if($save){
            $result=true;
        }
        return $result;
    }

    public function update($id){
        $sql="UPDATE productos SET precio_producto='{$this->getPrecio()}',mostrar_main='{$this->getMostrarMain()}' WHERE id_producto = '$id' ";
        $saveupdate=$this->db->query($sql);
        return $saveupdate;
    }

    public function delete($id){
        $sql= "DELETE FROM productos WHERE id_producto = '$id'";
        $deleted = $this->db->query($sql);
        return $deleted;
    }
    public function search_main(){//Busca los que se mostraran en el main page
        $sql = "SELECT * FROM productos WHERE mostrar_main = '1'";
        $search=$this->db->query($sql);
        return $search;
    }
}
