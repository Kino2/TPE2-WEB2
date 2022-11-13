<?php

require_once './app/models/ApiFilmModel.php';
require_once './app/helpers/ApiAuthHelper.php';
require_once './app/views/ApiView.php';

class ApiFilmController{

    private $model;
    private $view;
    private $authHelper;
    private $data;

    public function __construct(){
        $this->model = new FilmsModel();
        $this->view = new APIView();
        $this->authHelper = new AuthHelper();

        $this->data = file_get_contents("php://input");
    }
    private function getData(){
        return json_decode($this->data);
    }

    public function getFilms($params = null){
        $sortByDefault = "id_pelicula";
        $orderDefault = "asc";
        $pageSize = 10;
        $page = 1;
        if(isset($_GET["sortby"])){
            $sortBy = $this->Sanitize($_GET["sortby"]);
        }
        if(isset($_GET["section"])){
            $section = $this->Sanitize($_GET["section"]);
        }
        if (isset($_GET["page"])) {
            $page = $this->transformNatural($_GET["page"], $page);
        }
        $beginning = ($page - 1) * $pageSize;
        try {
            if (!empty($sortBy) && !empty($_GET["order"])) {
                $films = $this->model->getFilms($beginning, $pageSize, $sortBy, $_GET["order"]);
            } else if (!empty($sortBy)) {
                $films = $this->model->getFilms($beginning, $pageSize, $sortBy, $orderDefault);
            } else if (!empty($_GET["order"])) {
                $films = $this->model->getFilms($beginning, $pageSize, $sortByDefault, $_GET["order"]);
            } else if (!empty($section) && !empty($_GET["value"])) {
                $films = $this->model->filterByFields($section, $_GET["value"], $beginning, $pageSize);
            } else {
                $films = $this->model->getFilms($beginning, $pageSize);
            }
            if ($films) {
                $this->view->response($films, 200);
            }
        } catch (Exception) {
            $this->view->response("Error: El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 400);
        }
    }
    public function getFilm($params = null){
        $id = $params[':ID'];
        $film = $this->model->getFilm($id);
        if ($film) {
            $this->view->response($film, 200);
        } else {
            $this->view->response("La pelicula con el id = $id no existe", 404);
        }
    }
    
    public function addFilm($params = null){
        if (!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estas logeado", 401);
            return;
        }
        $film = $this->getData();
        try {
            if (empty($film->nombre) || empty($film->descripcion) || empty($film->fecha) || empty($film->duracion) || empty($film->director) || empty($film->id_genero_fk) || empty($film->imagen)) {
                $this->view->response("Faltan completar campos", 400);
            } else {
                $id = $this->model->insertFilm($film->nombre, $film->descripcion, $film->fecha, $film->duracion, $film->director, $film->id_genero_fk, $film->imagen);
                $film = $this->model->getFilm($id);
                $this->view->response("Pelicula creada con exito", 201);
            }
        } catch (Exception) {
            $this->view->response("Error: El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 400);
        }
    }
    public function editFilm($params = null){
        if (!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estas logeado", 401);
            return;
        }
        $id = $params[':ID'];
        $film = $this->model->getFilm($id);
        try {
            if ($film) {
                $data = $this->getData();
                if (empty($data->nombre) || empty($data->descripcion) || empty($data->fecha) || empty($data->duracion) || empty($data->director) || empty($data->id_genero_fk)) {
                    $this->view->response("Faltan completar campos", 400);
                } else {
                    if (!empty($data->imagen)) {
                        $this->model->editFilm($data->nombre, $data->descripcion, $data->fecha, $data->duracion, $data->director, $data->id_genero_fk, $id, $data->imagen);
                        $this->view->response("Película con el id = $id actualizada con éxito", 200);
                    } else {
                        $this->model->editFilm($data->nombre, $data->descripcion, $data->fecha, $data->duracion, $data->director, $data->id_genero_fk, $id);
                        $this->view->response("Película con el id = $id actualizada con éxito", 200);
                    }
                }
            }
        } catch (Exception) {
            $this->view->response("Error: El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 400);
        }
    }
    public function deleteFilm($params = null){
        $id = $params[':ID'];
        $film = $this->model->getFilm($id);
        if ($film) {
            $this->model->deleteFilm($id);
            $this->view->response("La película fue borrada con éxito", 200);
        } else {
            $this->view->response("La película con el id = $id no existe", 404);
        }
    }
    public function Sanitize($params){
        $fields = array(
            'id_pelicula' => 'id_pelicula',
            'nombre' => 'nombre',
            'descripcion' => 'descripcion',
            'fecha' => 'fecha',
            'duracion' => 'duracion',
            'imagen' => 'imagen',
            'id_genero_fk' => 'id_genero_fk',
            'genero' => 'genero',
            'director' => 'director'
        );
        if (isset($fields[$params])) {
            return $params;
        } else {
            return null;
        }
    }
    public function transformNatural($param, $defaultParam){
        $result = intval($param);
        if ($result > 0) {
            $result = $param;
        } else {
            $result = $defaultParam;
        }
        return $result;
    }
}
