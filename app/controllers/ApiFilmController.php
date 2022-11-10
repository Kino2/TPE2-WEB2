<?php
require_once './app/models/films.model.php';
require_once './app/helpers/ApiAuthHelper.php';
require_once './app/views/api.view.php';

class ApiFilmController {

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

    public function getFilms(){
        $sortBy = $this->checkSortBy($_GET["sortby"]);
        $sortByDefault = "id_pelicula";
        $orderDefault = "asc";
        $size_pages = 10;
        $page = 1;
        if (isset($_GET["page"])){
            $page = $this->ConvertNatural($_GET["page"], $page);
        }
        $start_where = ($page - 1) * $size_pages;
        try {
            if (!empty($sortBy) && !empty($_GET["order"])) {
            $data = $this->model->getFilms($start_where, $size_pages, $sortBy, $_GET["order"]);
            }  else if (!empty($sortBy)){
            $data = $this->model->getFilms($start_where, $size_pages, $sortBy, $orderDefault);
            } else if (!empty($_GET["order"])) {
            $data = $this->model->getFilms($start_where, $size_pages, $sortByDefault, $_GET["order"]);
            } else if(!empty($_GET["section"]) && !empty($_GET["element"])){
            $section = $_GET["section"];
            $element = $_GET["element"];
            $data = $this->model->filterByFields($section, $element);
            } 
            else {
            $data = $this->model->getFilms($start_where, $size_pages);
            }
            if($data){
                $this->view->response($data, 200);
            }
            } catch (Exception) {
            $this->view->response("Error: El servidor no pudo interpretar la solicitud dada una sintaxis invalida", 400);
        }
    }
    public function checkSortBy($params){
        $fields = array(
            'id_pelicula'=>'id_pelicula',
            'nombre' => 'nombre',
            'descripcion'=>'descripcion',
            'fecha' => 'fecha',
            'duracion' => 'duracion',
            'imagen' => 'imagen',
            'id_genero_fk' => 'id_genero_fk',
            'director' => 'director'
        );
        if(isset($fields[$params])){
            return $params;
        }else{
            return null;
        }
    }

    public function getFilm($params = null) {
        $id = $params[':ID'];
        $film = $this->model->getFilm($id);
        if ($film) {
            $this->view->response($film, 200);
        } else {
            $this->view->response("La pelicula con el id = $id no existe", 404);
        }
    }
    public function addFilm(){
        $film = $this->getData();
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }

        if (empty($film->nombre) || empty($film->descripcion) || empty($film->fecha) || empty($film->duracion) || empty($film->director)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertFilm($film->nombre, $film->descripcion, $film->fecha, $film->duracion, $film->director, $film->id_genero_fk, $film->imagen);
            $film = $this->model->getFilm($id);
            $this->view->response("Pelicula creada con exito", 201);
        }
    }
    public function editFilm($params = null) {
        $id = $params[':ID'];
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logeado", 401);
            return;
        }
        $film = $this->model->getFilm($id);

        if ($film) {
            $data = $this->getData();
            $name = $data->nombre;
            $description = $data->descripcion;
            $date = $data->fecha;
            $duration = $data->duracion;
            $director = $data->director;
            $genre = $data->id_genero_fk;
            $image = $data->imagen;
            $this->model->editFilm($name, $description, $date, $duration, $director, $genre, $id, $image);
            $this->view->response("Película con el id = $id actualizada con éxito", 200);
        } else {
            $this->view->response("Film id = $id not found", 404);
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
    public function ConvertNatural($param, $defaultParam){
        $result = intval($param);
        if ($result > 0) {
            $result = $param;
        } else {
            $result = $defaultParam;
        }
        return $result;
    }
}
