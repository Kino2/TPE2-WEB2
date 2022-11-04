<?php
class FilmsModel{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=películas;charset=utf8', 'root', '');
    }
    function getFilmsByGenre($id) {
        $query = $this->db->prepare("SELECT a.*, b.* FROM peliculas a INNER JOIN generos b ON a.id_genero_fk = b.id_genero WHERE id_genero_fk = ?");
        $query->execute([$id]);
        $films = $query->fetchAll(PDO::FETCH_OBJ);
        return $films;
    }
    function getFilms($start_where, $size_pages, $sort = null, $order = null){
        if ($sort && $order) {
                $query = $this->db->prepare("SELECT a.*, b.* FROM peliculas a INNER JOIN generos b ON a.id_genero_fk = b.id_genero ORDER BY $sort $order LIMIT $start_where,$size_pages");
                $query->execute();
        } else {
            $query = $this->db->prepare("SELECT a.*, b.* FROM peliculas a INNER JOIN generos b ON a.id_genero_fk = b.id_genero  LIMIT $start_where,$size_pages");
            $query->execute();
        }
        $films = $query->fetchAll(PDO::FETCH_OBJ);
        return $films;
    }
    function filterFields($filter){
        $query = $this->db->prepare("SELECT $filter FROM peliculas a INNER JOIN generos b ON a.id_genero_fk = b.id_genero");
        $query->execute();
        $films = $query->fetchAll(PDO::FETCH_OBJ);
        return $films;
    }
    function getFilm($id){
        $query = $this->db->prepare("SELECT* FROM peliculas WHERE id_pelicula = ?");
        $query->execute([$id]);
        $films = $query->fetch(PDO::FETCH_OBJ);
        return $films;
    }
    function insertFilm($name, $description, $date, $duration, $director, $genre, $image){
        $pathImg = $this->uploadImage($image);
        $query = $this->db->prepare("INSERT INTO peliculas (nombre, descripcion, fecha, duracion, imagen, director, id_genero_fk)VALUES(?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$name, $description, $date, $duration, $pathImg, $director, $genre]);
        return $this->db->lastInsertId();
    }
    function editFilm($name, $description, $date, $duration, $director, $genre, $id, $image = null)
    {
        if ($image) {
            $pathImg = $this->uploadImage($image);
            $query = $this->db->prepare("UPDATE peliculas SET nombre = ?, descripcion = ?, fecha = ?, duracion = ?, imagen = ?, id_genero_fk = ?, director = ? WHERE id_pelicula =?");
            $query->execute([$name, $description, $date, $duration, $pathImg, $genre, $director, $id]);
        } else {
            $query = $this->db->prepare("UPDATE peliculas SET nombre = ?, descripcion = ?, fecha = ?, duracion = ?, id_genero_fk = ?, director = ? WHERE id_pelicula =?");
            $query->execute([$name, $description, $date, $duration, $genre, $director, $id]);
        }
    }
    function deleteFilm($id)
    {
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id_pelicula = ?');
        $query->execute([$id]);
    }
    private function uploadImage($image)
    {
        $target = 'img/films/' . uniqid() . '.jpg';
        move_uploaded_file($image, $target);
        return $target;
    }
}
