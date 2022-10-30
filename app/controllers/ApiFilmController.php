<?php
require_once './app/models/films.model.php';
require_once './app/views/api.view.php';

class ApiFilmController
{

    private $model;
    private $view;

    private $data;

    public function __construct()
    {
        $this->model = new FilmsModel();
        $this->view = new APIView();

        $this->data = file_get_contents("php://input");
    }
    private function getData()
    {
        return json_decode($this->data);
    }

    public function getFilms()
    {
        $films = $this->model->getFilms();
        return $this->view->response($films, 200);
    }
    public function getFilm($params = null)
    {
        $id = $params[':ID'];
        $film = $this->model->getFilm($id);
        if ($film) {
            $this->view->response($film, 200);
        } else {
            $this->view->response("La película con el id = $id no existe", 404);
        }
    }
    public function insertFilm($params = null)
    {
        $film = $this->getData();

        if (empty($film->nombre) || empty($film->descripcion) || empty($film->fecha) || empty($film->duracion) || empty($film->director)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertFilm($film->nombre, $film->descripcion, $film->fecha, $film->duracion, $film->director, $film->id_genero_fk, $film->imagen);
            $film = $this->model->getFilm($id);
            $this->view->response("Película creada con éxito", 201);
        }
    }
    public function updateFilm($params = null)
    {
        $id = $params[':ID'];
        $film = $this->model->getFilm($id);

        if ($film) {
            $body = $this->getData();
            $name = $body->nombre;
            $description = $body->descripcion;
            $date = $body->fecha;
            $duration = $body->duracion;
            $director = $body->director;
            $genre = $body->id_genero_fk;
            $image = $body->imagen;
            $this->model->editFilm($name, $description, $date, $duration, $director, $genre, $id, $image);
            $this->view->response("Película con el id = $id actualizada con éxito", 200);
        } else {
            $this->view->response("Film id = $id not found", 404);
        }
    }
    public function deleteFilm($params = null)
    {
        $id = $params[':ID'];

        $film = $this->model->getFilm($id);
        if ($film) {
            $this->model->deleteFilm($id);
            $this->view->response("La película fue borrada con éxito", 200);
        } else {
            $this->view->response("La película con el id = $id no existe", 404);
        }
    }
}
