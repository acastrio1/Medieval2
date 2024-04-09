<?php
require_once 'db.php';
class usuario {

    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    public $fecha;
    private $db;
    private $userType;

    public function __construct(){
        $this->db=Database::connect();
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }


    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getUserType(){
        return $this->userType;
    }

    public function setUserType($userType){
        $this->userType = $userType;
    }

    public function search(){
        $sql = "SELECT * FROM usuarios WHERE email='{$this->getEmail()}' LIMIT 1";
        $search=$this->db->query($sql);
        $busqueda = mysqli_fetch_assoc($search);
        return $busqueda;
    }

    public function search_name(){
        $sql = "SELECT * FROM usuarios WHERE nombre='{$this->getNombre()}'";
        $search_name=$this->db->query($sql);
        return $search_name;
    }

    public function searchAll(){
        $sql = "SELECT * FROM usuarios";
        $searchAll=$this->db->query($sql);
        return $searchAll;
    }

    public function save(){
        //Variable con el sql necesario para ingresar una nueva entrada a la DB
        $sql="INSERT INTO usuarios VALUES (NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','{$this->getFecha()}','{$this->getUserType()}');";
        //Hace el query a la DB
        $save=$this->db->query($sql);
        $result=false;//Inicializa la variable que identifica si se realizó la operación
        if($save){
            $result=true;
        }
        return $result;
    }

    public function login(){
        $sql="SELECT * FROM usuarios WHERE email='{$this->getEmail()}' AND password='{$this->getPassword()}'";
        $login=$this->db->query($sql);
        return $login;
    }

    public function update($id){
        $sql="UPDATE usuarios SET nombre='{$this->getNombre()}', apellidos = '{$this->getApellidos()}', email = '{$this->getEmail()}', password = '{$this->getPassword()}', user_type = '{$this->getUserType()}'  WHERE id = '$id' ";
        $saveupdate=$this->db->query($sql);
        return $saveupdate;
    }

    public function delete($id){
        $sql= "DELETE FROM usuarios WHERE `usuarios`.`id` = $id";
        $deleted = $this->db->query($sql);
        return $deleted;
    }
}
?>