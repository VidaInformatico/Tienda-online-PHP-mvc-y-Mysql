<?php
class Categorias extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['nombre_usuario'])) {
            header('Location: '. BASE_URL . 'admin');
            exit;
        }
    }
    public function index()
    {
        $data['title'] = 'categorias';
        $this->views->getView('admin/categorias', "index", $data);
    }
    public function listar()
    {
        $data = $this->model->getCategorias(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="d-flex">
            <button class="btn btn-primary" type="button" onclick="editCat(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="eliminarCat(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
        </div>';
        }
        echo json_encode($data);
        die();
    }

    public function registrar()
    {
        if (isset($_POST['categoria'])) {
            $categoria = $_POST['categoria'];
            $id = $_POST['id'];
            if (empty($_POST['categoria'])) {
                $respuesta = array('msg' => 'todo los campos son requeridos', 'icono' => 'warning');
            } else {               
                if (empty($id)) {
                    $result = $this->model->verificarCategoria($categoria);
                    if (empty($result)) {
                        $data = $this->model->registrar($categoria);
                        if ($data > 0) {
                            $respuesta = array('msg' => 'categoria registrado', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'error al registrar', 'icono' => 'error');
                        }
                    } else {
                        $respuesta = array('msg' => 'correo ya existe', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar($categoria, $id);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'categoria modificado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'error al modificar', 'icono' => 'error');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    //eliminar cat
    public function delete($idCat)
    {
        if (is_numeric($idCat)) {
            $data = $this->model->eliminar($idCat);
            if ($data == 1) {
                $respuesta = array('msg' => 'categoria dado de baja', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'error al eliminar', 'icono' => 'error');
            }
        } else {
            $respuesta = array('msg' => 'error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }
    //editar cat
    public function edit($idCat)
    {
        if (is_numeric($idCat)) {
            $data = $this->model->getCatoria($idCat);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
