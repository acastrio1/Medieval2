<?php
require_once 'db.php';
class pedido {

    private $id_pedido;
    private $numero_pedido;
    private $id_usuario;
    private $id_producto;
    private $Qty_producto;
    private $direccion;
    private $valor_producto;
    private $total_producto;
    private $db;
    

    public function __construct(){
        $this->db=Database::connect();
    }

    public function getIDPedido(){
        return $this->id_pedido;
    }

    public function setIDPedido($id_pedido){
        $this->id_pedido = $id_pedido;
    }

    public function getNumeroPedido(){
        return $this->numero_pedido;
    }

    public function setNumeroPedido($numero_pedido){
        $this->numero_pedido = $numero_pedido;
    }


    public function getIDUsuario(){
        return $this->id_usuario;
    }

    public function setIDUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getIDProducto(){
        return $this->id_producto;
    }

    public function setIDProducto($id_producto){
        $this->id_producto = $id_producto;
    }

    public function getQtyProducto(){
        return $this->Qty_producto;
    }

    public function setQtyProducto($Qty_producto){
        $this->Qty_producto = $Qty_producto;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function getValorProducto(){
        return $this->valor_producto;
    }

    public function setValorProducto($valor_producto){
        $this->valor_producto = $valor_producto;
    }

    public function getTotalProducto(){
        return $this->total_producto;
    }

    public function setTotalProducto($total_producto){
        $this->total_producto = $total_producto;
    }

    public function getPedidoEntregado(){
        return $this->pedido_entregado;
    }

    public function setPedidoEntregado($pedido_entregado){
        $this->pedido_entregado = $pedido_entregado;
    }

    public function search(){//Busca por numero de pedido
        $sql = "SELECT pedidos.id_pedido, pedidos.numero_pedido, pedidos.id_usuario, pedidos.Qty_producto, pedidos.direccion, pedidos.valor_producto, pedidos.Total_producto, productos.nombre_producto
        FROM pedidos INNER JOIN productos ON pedidos.id_producto = productos.id_producto WHERE pedidos.numero_pedido='{$this->getNumeroPedido()}'";
        $search=$this->db->query($sql);
        return $search;
    }

    public function searchAll(){//Busca todos los pedidos
        $sql = "SELECT * FROM pedidos WHERE numero_pedido = '{$this->getNumeroPedido()}'";
        $searchAll=$this->db->query($sql);
        return $searchAll;
    }

    public function save(){
        //Variable con el sql necesario para ingresar una nueva entrada a la DB
        $sql="INSERT INTO pedidos VALUES (NULL,'{$this->getNumeroPedido()}','{$this->getIDUsuario()}','{$this->getIDProducto()}','{$this->getQtyProducto()}','0','{$this->getValorProducto()}','{$this->getTotalProducto()}','0','0')";
        //Hace el query a la DB
        $save=$this->db->query($sql);
        $result=false;//Inicializa la variable que identifica si se realizó la operación
        if($save){
            $result=true;
        }
        return $result;
    }

    public function update($id){
        $sql="UPDATE pedidos SET Qty_producto='{$this->getQtyProducto()}' WHERE id_pedido = '$id' ";
        $saveupdate=$this->db->query($sql);
        return $saveupdate;
    }

    public function delete($id){
        $sql= "DELETE FROM pedidos WHERE id_pedido = $id";
        $deleted = $this->db->query($sql);
        return $deleted;
    }

    public function update_direccion($id){
        $sql="UPDATE pedidos SET direccion='{$this->getDireccion()}', pedido_confirmado='1' WHERE id_pedido = '$id' ";
        $saveupdate=$this->db->query($sql);
        return $saveupdate;
    }

    public function AllPedidos(){
        $sql="SELECT DISTINCT numero_pedido, direccion, Pedido_entregado FROM pedidos WHERE pedido_confirmado='1'";
        $allPedidos=$this->db->query($sql);
        return $allPedidos;
    }

    public function update_entregado(){
        $sql="UPDATE pedidos SET Pedido_entregado='1' WHERE numero_pedido = '{$this->getNumeroPedido()}' ";
        $saveupdate=$this->db->query($sql);
        return $saveupdate;
    }

}

?>