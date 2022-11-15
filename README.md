# API REST PARA EL RECURSO DE PELÍCULAS
Una sencilla API REST para el manejo de CRUD con las películas de PelíKino
## Importar la base de datos
- Importarla desde phpMyAdmin -> database/películas.sql
- Aclaración: En la base de datos, dentro de la tabla usuarios agregué una nueva columna llamada "usuario".
## Consumir la API REST utilizando Postman
- El endpoint de la API es: http://localhost/TPE2-WEB2/api/films
## Detalles de las variables
- sortby -> Campo por el cual se va ordenar la colección.
- order -> Orden que va a tener la colección con el sortby elegido.
- section -> El campo que se va a filtrar.
- value -> El valor del campo que se quiere filtrar.
- page -> Numero de la página en la que se encuentra.
## Detalles de los endpoints de cada acción
**PAGINACIÓN:**
- Mostrar todas las películas con paginación -> http://localhost/TPE2-WEB2/api/films?page=numentero

**GET:**
**Por default, el campo asignado en sortby es "id_pelicula" y el orden ascendente.**
- Mostrar todas las películas -> http://localhost/TPE2-WEB2/api/films
- Mostrar una colección filtrada por alguno de sus campos -> http://localhost/TPE2-WEB2/api/films?section=campo&value=valordelcampo
- Mostrar una colección que se pueda ordenar por cualquier campo -> http://localhost/TPE2-WEB2/api/films?sortby=campo&order=asc-desc
- Ordenar una colección sin especificar el orden -> http://localhost/TPE2-WEB2/api/films?sortby=campo 
- Ordenar una colección sin especificar el campo -> http://localhost/TPE2-WEB2/api/films?order=asc-desc
- Filtrar, ordenar y paginar combinados -> http://localhost/TPE2-WEB2/api/films?section=campo&value=valordelcampo&sortby=campo&order=asc-desc&page=numentero
- Filtrar, elegir campo y no poner el order (por defecto es ascendente) -> http://localhost/TPE2-WEB2/api/films?section=campo&value=valordelcampo&sortby=campo
- Filtrar, elegir el orden y no poner el campo (por defecto es id_pelicula) -> http://localhost/TPE2-WEB2/api/films?section=campo&value=valordelcampo&order=asc-desc
- Obtener el token de autenticación -> http://localhost/TPE2-WEB2/api/auth/token -> Aclaración: Al logearnos correctamente obtendremos el token el status code será "401 Unauthorized".

Si cualquiera de estas solicitudes sale bien, el status code será "200 OK", de lo contrario será "400 Bad Request" (Salvo en la autenticación).
**GET (Búsqueda por ID):**
- Mostrar una película con cierto id -> http://localhost/TPE2-WEB2/api/films/:ID
Si la solicitud sale bien, el status code será "200 OK", de lo contrario será "

**POST:**
**Es necesario estar logeado para usar este método**
- Crear una película nueva -> http://localhost/TPE2-WEB2/api/films -> Aclaración: Es necesario agregar: nombre, descripción, fecha, duración, director, id_genero_fk e imagen. Si no se llenan todos los campos, el status code será "400 Bad Request", si el usuario no se encuentra logeado el status code será "401 Unauthorized".
Si la solicitud sale bien, el status code sera "201 Created", de lo contrario, será "400 Bad Request".

**PUT:**
**Es necesario estar logeado para usar este método**
- Editar una película -> http://localhost/TPE2-WEB2/api/films/:ID -> Aclaración: Se puede editar cualquiera de los campos mencionados en el método POST. No se puede dejar ninguno de esos campos vacíos, de lo contrario el status code será "400 Bad Request", si se intenta editar una pelicula en la que cuya id no exista, el status code será "404 Not found", y si el usuario no se encuentra logeado el status code será "401 Unauthorized".
Si la solicitud sale bien, el status code sera "200 OK", de lo contrario, será "400 Bad Request".

**DELETE**
- Borrar una película -> http://localhost/TPE2-WEB2/api/films/:ID -> Aclaración: Si se intenta borrar una película en la que cuya id no exista, el status code será "404 Not found".
Si la solicitud sale bien, el status code sera "200 OK".

## Otros detalles
A continuación detallaré algunos datos importantes a la hora de hacer el CRUD:
- El usuario correcto para usar el POST y PUT es el que se encuentra en la tabla usuarios de la base de datos. El nombre es: Kino y su Contraseña es: 91218
- Las id de los distintos géneros a la hora de hacer POST o PUT son:
    id_genero_fk = 1 -> Género = Acción
    id_genero_fk = 2 -> Género = Terror
    id_genero_fk = 4 -> Género = Crimen
    id_genero_fk = 5 -> Género = Fantasía
    id_genero_fk = 6 -> Género = Drama
    id_genero_fk = 7 -> Género = Suspenso
    id_genero_fk = 44 -> Género = Comedia
    id_genero_fk = 49 -> Género = Infantil
