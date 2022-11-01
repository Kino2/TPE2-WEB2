<?php
require_once './app/models/genres.model.php';
require_once './app/views/api.view.php';

class ApiGenreController{
    private $model;
    private $view;

    private $data;

    public function __construct(){
        $this->model = new GenresModel();
        $this->view = new APIView();

        $this->data = file_get_contents("php://input");
    }
    private function getData(){
        return json_decode($this->data);
    }
    public function getGenres() {
        $genres = $this->model->getGenres();
        return $this->view->response($genres, 200);
    }
    public function getGenresASC() {
        $genres = $this->model->getGenresASC();
        return $this->view->response($genres, 200);
    }
    public function getGenresDESC() {
        $genres = $this->model->getGenresDESC();
        return $this->view->response($genres, 200);
    }
    public function getGenre($params = null){
        $id = $params[':ID'];
        $genre = $this->model->getGenre($id);
        if ($genre) {
            $this->view->response($genre, 200);
        } else {
            $this->view->response("El género con el id = $id no existe", 404);
        }
    }
    public function insertGenre($params = null){
        $genre = $this->getData();

        if (empty($genre->genero)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertGenre($genre->genero);
            $genre = $this->model->getGenre($id);
            $this->view->response("Género creado con éxito!", 201);
        }
    }
    public function updateGenre($params = null){
        $id = $params[':ID'];
        $genre = $this->model->getGenre($id);

        if ($genre) {
            $body = $this->getData();
            $genre = $body->genero;
            $this->model->editGenre($genre, $id);
            $this->view->response("Género con el id = $id actualizado con éxito", 200);
        } else {
            $this->view->response("Genre id = $id not found", 404);
        }
    }
    public function deleteGenre($params = null){
        $id = $params[':ID'];

        $genre = $this->model->getGenre($id);
        if ($genre) {
            $this->model->deleteGenre($id);
            $this->view->response("El género fue borrado con éxito", 200);
        } else {
            $this->view->response("El género con el id = $id no existe", 404);
        }
    }
}
