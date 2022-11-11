<?php
class FilmsModel{
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=películas;charset=utf8', 'root', '');
    }
    function getFilms($beginning, $pageSize, $sort= "id_pelicula", $order= "asc"){
        $query = $this->db->prepare("SELECT a.*, b.genero FROM peliculas a INNER JOIN generos b ON a.id_genero_fk = b.id_genero ORDER BY $sort $order LIMIT $beginning, $pageSize ");
        $query->execute();
        $films = $query->fetchAll(PDO::FETCH_OBJ);
        return $films;
    }
    function getFilm($id){
        $query = $this->db->prepare("SELECT a.*, b.genero FROM peliculas a INNER JOIN generos b ON a.id_genero_fk = b.id_genero WHERE id_pelicula = ? ");
        $query->execute([$id]);
        $films = $query->fetch(PDO::FETCH_OBJ);
        return $films;
    }   
    function filterByFields($section, $element){
        $query = $this->db->prepare("SELECT a.*, b.genero FROM peliculas a INNER JOIN generos b ON a.id_genero_fk = b.id_genero WHERE $section = ? ");
        $query->execute([$element]);
        $films = $query->fetchAll(PDO::FETCH_OBJ);
        return $films;
    }
    function insertFilm($name, $description, $date, $duration, $director, $genre, $image){
            $query = $this->db->prepare("INSERT INTO peliculas (nombre, descripcion, fecha, duracion, imagen, director, id_genero_fk) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $query->execute([$name, $description, $date, $duration, $image, $director, $genre]);
            return $this->db->lastInsertId();
    }
    function editFilm($name, $description, $date, $duration, $director, $genre, $id, $image = null){
        if ($image) {
            $query = $this->db->prepare("UPDATE peliculas SET nombre = ?, descripcion = ?, fecha = ?, duracion = ?, imagen = ?, id_genero_fk = ?, director = ? WHERE id_pelicula = ? ");
            $query->execute([$name, $description, $date, $duration, $image, $genre, $director, $id]);
        } else {
            $query = $this->db->prepare("UPDATE peliculas SET nombre = ?, descripcion = ?, fecha = ?, duracion = ?, id_genero_fk = ?, director = ? WHERE id_pelicula = ? ");
            $query->execute([$name, $description, $date, $duration, $genre, $director, $id]);
        }
    }
    function deleteFilm($id){
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id_pelicula = ?');
        $query->execute([$id]);
    }
}
