<?php
require_once './libs/Router.php';
require_once './app/controllers/ApiFilmController.php';
require_once './app/controllers/ApiGenreController.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
//películas
$router->addRoute('films', 'GET', 'ApiFilmController', 'getFilms');
$router->addRoute('films/:ID', 'GET', 'ApiFilmController', 'getFilm');
$router->addRoute('films', 'POST', 'ApiFilmController', 'insertFilm');
$router->addRoute('films/:ID', 'PUT', 'ApiFilmController', 'updateFilm');
$router->addRoute('films/:ID', 'DELETE', 'ApiFilmController', 'deleteFilm');
//géneros
$router->addRoute('genres', 'GET', 'ApiGenreController', 'getGenres');
$router->addRoute('genres/:ID', 'GET', 'ApiGenreController', 'getGenre');
$router->addRoute('genres', 'POST', 'ApiGenreController', 'insertGenre');
$router->addRoute('genres/:ID', 'PUT', 'ApiGenreController', 'updateGenre');
$router->addRoute('genres/:ID', 'DELETE', 'ApiGenreController', 'deleteGenre');

/*
$router->addRoute('tasks', 'POST', 'TaskApiController', 'insertTask'); 
*/
// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
