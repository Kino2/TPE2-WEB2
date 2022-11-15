-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 17:42:16
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `películas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `fecha` date NOT NULL,
  `duracion` time NOT NULL,
  `imagen` varchar(50) CHARACTER SET latin1 NOT NULL,
  `id_genero_fk` int(11) NOT NULL,
  `director` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `nombre`, `descripcion`, `fecha`, `duracion`, `imagen`, `id_genero_fk`, `director`) VALUES
(9, 'Pulp Fiction', 'Las vidas de dos mafiosos, un boxeador, la esposa de un gánster y un par de bandidos se entrelazan en cuatro historias de violencia y redención.', '1995-02-16', '02:34:00', 'img/films/6346dfed27ea4.jpg', 4, 'Quentin Tarantino'),
(10, 'El padrino ', 'El envejecido patriarca de una dinastía del crimen organizado en la ciudad de Nueva York de la posguerra transfiere el control de su imperio clandestino a su reacio hijo menor.', '1972-09-20', '02:55:00', 'img/films/6346e20c8ebf7.jpg', 4, 'Francis Ford Coppola'),
(11, 'El padrino II', 'El Padrino II retoma la historia de la familia Corleone en el punto al cual había llegado la primera parte, pero con una vuelta de tuerca: mientras sigue el ascenso de Michael en el mundo del crimen durante los años 50, reconstruye los primeros años del padre de Michael, Vito, desde que escapa, aún niño, de la violenta Sicilia hasta que comienza a dar sus primeros pasos como líder mafioso en Nueva', '1974-12-26', '03:22:00', 'img/films/634b5ec00f8b0.jpg', 4, 'Francis Ford Coppola'),
(12, 'El padrino III', 'En medio de tratar de legitimar sus negocios en la ciudad de Nueva York e Italia en 1979, el anciano mafioso Don Michael Corleone busca confesar sus pecados, mientras toma a su sobrino Vincent Mancini bajo su protección.', '1991-05-16', '02:42:00', 'img/films/6346e414d64b8.jpg', 4, 'Francis Ford Coppola'),
(13, 'Scarface', 'En el Miami de 1980, un decidido inmigrante cubano se hace con un cártel de la droga y sucumbe a la codicia.', '1984-02-09', '02:50:00', 'img/films/6346e540bfc4c.jpg', 4, 'Brian De Palma'),
(16, 'El señor de los anillos: las dos torres', 'Mientras Frodo y Sam se acercan a Mordor con la ayuda del astuto Gollum, la comunidad dividida se enfrenta al nuevo aliado de Sauron, Saruman, y a sus hordas de Isengard.', '2002-12-16', '02:59:00', 'img/films/6346e6569c5eb.jpg', 5, 'Peter Jackson'),
(17, 'El señor de los anillos: la comunidad del anillo', 'Un hobbit de la Comarca y ocho compañeros emprenden un viaje para destruir el poderoso Anillo Único y salvar la Tierra Media del Señor Oscuro Sauron.', '2002-01-31', '02:58:00', 'img/films/6346e6e7576ad.jpg', 5, 'Peter Jackson'),
(18, 'El Señor de los Anillos: el retorno del Rey', 'Gandalf y Aragorn lideran el mundo de los hombres contra la armada de Sauron para distraer su atención de Frodo y Sam, quienes se aproximan al Monte del Destino con el Anillo Único.', '2004-01-01', '03:30:00', 'img/films/6346e725a43b3.jpg', 5, 'Peter Jackson'),
(19, 'La cacería', 'Un profesor vive una vida solitaria mientras lidia con la batalla por la custodia de su hijo. Su suerte parece mejorar cuando encuentra el amor, pero pronto vera su vida echa añicos a causa de una pequeña mentira piadosa.', '2013-06-13', '01:55:00', 'img/films/634847d009d80.jpg', 6, 'Thomas Vinterberg'),
(20, 'En busca de la felicidad', 'Un vendedor en apuros se queda con la custodia de su hijo cuando está a punto de comenzar una carrera profesional que le cambiará la vida.', '2007-02-01', '01:57:00', 'img/films/634848670f6c1.jpg', 6, 'Gabriele Muccino'),
(21, 'El sexto sentido', 'Un niño que se comunica con los espíritus busca la ayuda de un descorazonado psicólogo infantil.', '1999-10-07', '01:47:00', 'img/films/63484a4988358.jpg', 7, 'M. Night Shyamalan'),
(22, 'El secreto de sus ojos', 'Un asesor legal jubilado escribe una novela con la esperanza de cerrar uno de sus antiguos casos de homicidio, que sigue sin resolver, y superar el amor no correspondido que sentía por su jefa. Décadas después, ambos recuerdos le siguen persiguiendo.', '2009-08-13', '02:09:00', 'img/films/6346e5fce29a8.jpg', 4, 'Juan José Campanella'),
(24, 'Spider-Man: No Way Home', 'Con la identidad de Spider-Man ahora revelada, Peter recurre al Doctor Strange en busca de ayuda. Algo sale mal y el multiverso se convierte en la mayor amenaza. Ahora Peter debe descubrir qué significa realmente ser Spider-Man.', '2021-12-17', '02:28:00', 'img/films/634b5e871b9ff.jpg', 1, 'Jon Watts'),
(25, 'Mortal Kombat', 'Mortal Kombat es la nueva adaptación cinematográfica de la famosa saga de videojuegos. La acción sigue a Cole Young, un luchador de MMA acostumbrado a pelear a cambio de dinero, y quien desconoce su importante ascendencia y la valiosa herencia que está a punto de recibir.', '2021-04-23', '01:50:00', 'img/films/6346d913962e6.jpg', 1, 'Simon McQuoid'),
(28, 'El abogado del diablo', 'A un abogado de Florida, excepcionalmente hábil, le ofrecen un trabajo en un bufete neoyorquino de alto nivel con un jefe de alto nivel: la mayor oportunidad de su carrera hasta la fecha.', '1998-01-01', '02:24:00', 'img/films/6346df14db748.jpg', 2, 'Taylor Hackford'),
(29, 'Harry Potter y el prisionero de Azkaban', 'Harry Potter, Ron y Hermione regresan al Colegio Hogwarts de Magia y Hechicería para cursar su tercer año de estudios, donde se adentran en el misterio que rodea a un preso fugado que supone una peligrosa amenaza para el joven mago.', '2004-06-03', '02:22:00', 'img/films/6346e78dbf479.jpg', 5, 'Alfonso Cuarón'),
(30, 'El expreso polar', 'En Nochebuena, un niño se embarca en una aventura mágica hacia el polo norte en el Polar Express, mientras aprende sobre la amistad, la valentía y el espíritu de la Navidad.', '2004-12-09', '01:40:00', 'img/films/6346e89a363fc.jpg', 5, 'Robert Zemeckis'),
(31, 'La isla siniestra', 'En 1954, un marshal estadounidense investiga la desaparición de un asesino que se ha escapado de un hospital para criminales dementes.', '2010-02-18', '02:18:00', 'img/films/634b5f6fa2ae3.jpg', 7, 'Martin Scorsese'),
(32, 'El vengador', 'Un hombre frustrado decide hacerse cargo de la justicia en sus propias manos después de que un acuerdo de culpabilidad libere a uno de los asesinos de su familia. Apunta no solo al asesino sino también al fiscal de distrito y otros involucrados en el trato.', '2010-02-11', '01:49:00', 'img/films/63484aff3bfbc.jpg', 7, 'F. Gary Gray'),
(33, 'Talentos ocultos', 'La historia de un equipo de matemáticas afroamericanas y el papel fundamental que desempeñaron en la NASA durante los primeros años del programa espacial de los Estados Unidos.', '2017-01-06', '02:07:00', 'img/films/634b5f422bfa9.jpg', 6, 'Theodore Melfi'),
(35, 'Taxi driver', 'Un veterano con problemas de salud mental trabaja como taxista en Nueva York, donde su percepción de la decadencia a su alrededor alimenta su deseo de violencia.', '1976-02-08', '01:54:00', 'img/films/634849469a464.jpg', 6, 'Martin Scorsese'),
(36, 'Forrest Gump', 'Las presidencias de Kennedy y Johnson, los acontecimientos de Vietnam, el Watergate y otros eventos históricos se desarrollan a través de la perspectiva de un hombre de Alabama con un coeficiente intelectual de 75.', '1994-08-06', '02:22:00', 'img/films/634849fcc16e1.jpg', 6, 'Robert Zemeckis'),
(39, 'Batman: el caballero de la Noche', 'Cuando la amenaza conocida como el Joker causa estragos y el caos en Gotham City, Batman debe aceptar una de las mayores pruebas psicológicas y físicas para luchar contra la injusticia.', '2008-07-17', '02:32:00', 'img/films/6346db222fa85.jpg', 1, 'Cristopher Nolan'),
(74, 'Nadie', 'Hutch Mansell, un hombre de familia normal, lidia con los remordimientos y las consecuencias familiares que se prosiguen a su decisión de no entablar conflicto cuando unos ladrones entran a su casa de noche.', '2021-03-26', '01:32:00', 'img/films/6349d7cb71a80.jpg', 1, 'Ilya Naishuller'),
(75, '1917', 'Dos jóvenes soldados ingleses tienen una misión imposible durante la Primera Guerra Mundial: entregar un mensaje tras las líneas enemigas para evitar que sus compañeros caigan en una trampa.', '2019-12-25', '02:00:00', 'img/films/6349da2018629.jpg', 1, 'Sam Mendes'),
(76, 'Scream 5', 'Una mujer regresa a su ciudad natal para tratar de averiguar quién está cometiendo unos crímenes atroces.', '2022-01-14', '01:54:00', 'img/films/6349dde1a36f6.jpg', 2, 'Matt Bettinelli-Olpin '),
(77, 'El exorcista', 'Una adolescente es poseída por una entidad malévola y su madre obtiene la ayuda de dos curas para que la liberen.', '1974-08-15', '02:12:00', 'img/films/6349df4b5e571.jpg', 2, 'William Friedkin'),
(78, 'It', 'Varios niños de una pequeña ciudad del estado de Maine se alían para combatir a una entidad diabólica que adopta la forma de un payaso y desde hace mucho tiempo emerge cada 27 años para saciarse de sangre infantil.', '2017-09-21', '02:15:00', 'img/films/6349e0a07fee4.jpg', 2, 'Andrés Muschietti'),
(79, 'Superbad', 'Dos estudiantes de secundaria codependientes se ven obligados a lidiar con la ansiedad de su separación cuando su plan de organizar una fiesta empapada de alcohol fracasa.', '2007-11-22', '01:53:00', 'img/films/6349e4061ce7b.jpg', 44, 'Greg Mottola'),
(80, 'El lobo de Wall Street', 'Basado en la historia real de Jordan Belfort, desde su ascenso a convertirse en un adinerado agente de bolsa viviendo la gran vida hasta su caída, que involucra el crimen, la corrupción y el gobierno federal.', '2014-01-02', '03:00:00', 'img/films/6349e5bb45bc5.jpg', 44, 'Martin Scorsese'),
(81, 'Mi pobre angelito', 'Un travieso niño de ocho años debe proteger su casa de un par de ladrones cuando accidentalmente su familia lo deja solo en casa durante las vacaciones de Navidad.', '1991-01-10', '01:43:00', 'img/films/6349e6be07174.jpg', 44, 'Chris Columbus'),
(82, 'Matilda', 'Una niña dotada de un agudo intelecto y de poderes psíquicos utiliza ambos para enfrentarse a su tosca y distante familia y liberar a su amable profesora de su sádica directora.', '1997-01-09', '01:38:00', 'img/films/6349e761d54d6.jpg', 44, 'Danny DeVito'),
(83, 'Juego de gemelas', 'Annie y Hallie son gemelas idénticas separadas al nacer y criadas cada una por uno de sus padres. Cuando se conocen en un campamento de verano, forjan un plan para volver a juntar a sus padres.', '1999-01-28', '02:08:00', 'img/films/6349e83c0fb06.jpg', 44, 'Nancy Meyers'),
(92, 'No respires', 'Unos jóvenes ladrones creen haber encontrado la oportunidad de cometer el robo perfecto. Su objetivo será un ciego solitario, poseedor de miles de dólares ocultos. Pero tan pronto como entran en su casa serán conscientes de su error, pues se encontrarán atrapados y luchando por sobrevivir contra un psicópata con sus propios y temibles secretos.', '2016-09-08', '01:28:00', 'img/films/634b621fca968.jpg', 2, 'Fede Alvarez'),
(94, 'Stuart Little', 'La familia Little adopta a un encantador joven ratón llamado Stuart, pero el gato de la familia quiere deshacerse de él.', '1999-12-17', '01:24:00', 'img/films/634c7ec47ab16.jpg', 49, ' Rob Minkoff'),
(95, 'Shrek', 'Un malvado señor exilia a las criaturas de los cuentos de hadas al pantano de un ogro gruñón, que debe emprender una búsqueda y rescatar a una princesa para el señor con el fin de recuperar sus tierras.', '2001-07-19', '01:30:00', 'img/films/634c7f85af0f4.jpg', 49, 'Andrew Adamson'),
(96, 'Toy Story', 'Un vaquero de juguete se encuentra celoso y amenazado cuando un nuevo juguete, un guardián espacial, se convierte en el favorito del niño al que pertenecen.', '1996-03-14', '01:21:00', 'img/films/634c8115f1c92.jpg', 49, ' John Lasseter'),
(97, 'Cars', 'Un coche de carreras llamado Rayo McQueen se encuentra en Radiador Springs, donde descubre el verdadero significado de la amistad y la familia.', '2006-06-29', '01:57:00', 'img/films/634c81d9e7c28.jpg', 49, ' John Lasseter'),
(98, 'Ratatouille', 'Una rata que sabe cocinar establece una inusual alianza con un joven trabajador de la cocina de un famoso restaurante de París.', '2007-07-28', '01:51:00', 'img/films/6366b5cfe8fcd.jpg', 49, 'Brad Bird'),
(99, 'Parásitos', 'La familia Ki-taek, todos desempleados, se ve envuelta en un incidente con la rica y glamurosa familia Parks.', '2019-05-30', '02:12:00', 'img/films/634c83c959b55.jpg', 7, 'Bong Joon-ho'),
(100, 'Llamas de venganza', 'Una joven trata de entender cómo obtuvo misteriosamente el poder de prender fuego a las cosas con su mente.', '2022-05-13', '01:35:00', 'img/films/634c88eee0df9.jpg', 7, ' Keith Thomas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`),
  ADD KEY `id_genero_fk` (`id_genero_fk`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`id_genero_fk`) REFERENCES `generos` (`id_genero`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
