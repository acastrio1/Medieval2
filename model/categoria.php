<?php

require_once 'db.php';

class categoria {
    private $cat;

    public function __construct(){
        $this->db=Database::connect();
    }

    public function getCat(){
        return $this->cat;
    }

    public function setCat($cat){
        $this->cat = $cat;
    }

    public function searchAll(){
        $sql = "SELECT * FROM categoria";
        $searchAll=$this->db->query($sql);
        return $searchAll;
    }

    public function search(){
        $sql = "SELECT * FROM categoria WHERE categoria='{$this->getCat()}' LIMIT 1";
        $search=$this->db->query($sql);
        $busqueda = mysqli_fetch_assoc($search);
        return $busqueda;
    }

    public function save(){
        //Variable con el sql necesario para ingresar una nueva entrada a la DB
        $sql="INSERT INTO categoria VALUES (NULL,'{$this->getCat()}')";
        //Hace el query a la DB
        $save=$this->db->query($sql);
        $result=false;//Inicializa la variable que identifica si se realizó la operación
        if($save){
            $result=true;
        }
        return $result;
    }

    public function update($id){
        $sql="UPDATE categoria SET categoria='{$this->getCat()}' WHERE id = '$id' ";
        $saveupdate=$this->db->query($sql);
        return $saveupdate;
    }

    public function delete($id){
        $sql= "DELETE FROM categoria WHERE `categoria`.`id` = $id";
        $deleted = $this->db->query($sql);
        return $deleted;
    }
}

