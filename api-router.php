<?php
require_once './libs/Router.php';
require_once './app/controllers/ApiFilmController.php';



$router = new Router();

//películas
$router->addRoute('films', 'GET', 'ApiFilmController', 'getFilms');
$router->addRoute('films/:ID', 'GET', 'ApiFilmController', 'getFilm');
$router->addRoute('films', 'POST', 'ApiFilmController', 'addFilm');
$router->addRoute('films/:ID', 'PUT', 'ApiFilmController', 'editFilm');
$router->addRoute('films/:ID', 'DELETE', 'ApiFilmController', 'deleteFilm');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
