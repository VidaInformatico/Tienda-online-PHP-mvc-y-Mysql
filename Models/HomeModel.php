<?php
class HomeModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        return $this->selectAll($sql);
    }
    public function getProductos($id_categoria)
    {
        $sql = "SELECT id, nombre, precio, cantidad, imagen FROM productos WHERE id_categoria = $id_categoria AND estado = 1 ORDER BY id DESC";
        return $this->selectAll($sql);
    }
}
 
?>