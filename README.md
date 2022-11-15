# API REST PARA EL RECURSO DE PELÍCULAS

Una sencilla API REST para el manejo de CRUD con las películas de PeliKino.
## Importar la base de datos
- Importarla desde phpMyAdmin -> database/películas.sql
- Aclaración: En la base de datos, dentro de la tabla usuarios agregué una nueva columna llamada "usuario".

## Consumir la API REST utilizando Postman
- El endpoint de la API es: http://localhost/TPE2-WEB2/api/films

## PAGINACIÓN:

No es necesario poner el limit para que ande ya que este tiene un valor por default.
- Mostrar la colección paginada -> http://localhost/TPE2-WEB2/api/films?page=numnatural&limit=numnatural

   - Ejemplos: 
   
               - http://localhost/TPE2-WEB2/api/films?page=2
               
               - http://localhost/TPE2-WEB2/api/films?page=2&limit=4
               
- La paginación anda para cualquier petición GET que se solicite.

## Detalles de las variables GET

      - sortby -> Campo por el cual se va ordenar la colección.
      - order -> Orden que va a tener la colección con el sortby elegido.
      - section -> El campo que se va a filtrar.
      - value -> El valor del campo que se quiere filtrar.
      - page -> Numero de la página en la que se encuentra.
      - limit -> Es la cantiaad de películas máxima que puede tener la página.
     
# Detalles de los endpoints de cada acción

## GET:

Por default, el campo asignado en sortby es "id_pelicula" y el order "asc".
- Mostrar todas las películas -> http://localhost/TPE2-WEB2/api/films
- Mostrar una colección o película filtrada por alguno de sus campos -> http://localhost/TPE2-WEB2/api/films?section=campo&value=valordelcampo

      - Ejemplo: http://localhost/TPE2-WEB2/api/films?section=genero&value=drama
- Mostrar una colección que se pueda ordenar por cualquier campo -> http://localhost/TPE2-WEB2/api/films?sortby=campo&order=asc-desc

      - Ejemplo: http://localhost/TPE2-WEB2/api/films?sortby=id_genero_fk&order=desc
- Ordenar una colección sin especificar el orden -> http://localhost/TPE2-WEB2/api/films?sortby=campo 

       - Ejemplo: http://localhost/TPE2-WEB2/api/films?sortby=nombre
- Ordenar una colección sin especificar el campo -> http://localhost/TPE2-WEB2/api/films?order=asc-desc

       - Ejemplo: http://localhost/TPE2-WEB2/api/films?order=asc
  
- Filtrar, ordenar y paginar combinados -> http://localhost/TPE2-WEB2/api/films?section=campo&value=valordelcampo&sortby=campo&order=asc-desc&page=numnatural

       - Ejemplo: http://localhost/TPE2-WEB2/api/films?section=genero&value=crimen&sortby=id_pelicula&order=desc&page=1
- Filtrar, elegir campo y no poner el order (por defecto es ascendente) -> http://localhost/TPE2-WEB2/api/films?section=campo&value=valordelcampo&sortby=campo

       - Ejemplo: http://localhost/TPE2-WEB2/api/films?section=id_pelicula&value=25&sortby=duracion
- Filtrar, elegir el orden y no poner el campo (por defecto es id_pelicula) -> http://localhost/TPE2-WEB2/api/films?section=campo&value=valordelcampo&order=asc-desc

      - Ejemplo: http://localhost/TPE2-WEB2/api/films?section=director&value=andrew%20adamson&order=asc
- Obtener el token de autenticación -> http://localhost/TPE2-WEB2/api/auth/token  
      
      Aclaración: Al logearnos incorrectamente no obtendremos el token y el status code será "401 Unauthorized".
      Si cualquiera de estas solicitudes sale bien, el status code será "200 OK", de lo contrario será "400 Bad Request" (Salvo en la autenticación).

## GET (Búsqueda por ID):

- Mostrar una película con cierta id -> http://localhost/TPE2-WEB2/api/films/:ID

      - Ejemplo: http://localhost/TPE2-WEB2/api/films/24
Si la solicitud sale bien y la id existe, el status code será "200 OK", de lo contrario será "404 Not found".

## POST: 

Es necesario estar logeado para usar este método.
- Crear una película nueva -> http://localhost/TPE2-WEB2/api/films 

      Aclaración: Es necesario agregar: nombre, descripción, fecha, duración, director, id_genero_fk e imagen. Si no se llenan todos los campos, el status code será "400 Bad Request", si el usuario no se encuentra logeado el status code será "401 Unauthorized".
      Si la solicitud sale bien, el status code sera "201 Created", de lo contrario, será "400 Bad Request".

## PUT:

Es necesario estar logeado para usar este método.
- Editar una película -> http://localhost/TPE2-WEB2/api/films/:ID 

      Aclaración: Se puede editar cualquiera de los campos mencionados en el método POST. Salvo la imagen, no se puede dejar ninguno de esos campos vacíos, de lo contrario el status code será "400 Bad Request", si se intenta editar una pelicula en la que cuya id no exista, el status code será "404 Not found", y si el usuario no se encuentra logeado el status code será "401 Unauthorized".
      Si la solicitud sale bien, el status code sera "200 OK", de lo contrario, será "400 Bad Request".

## DELETE 

- Borrar una película -> http://localhost/TPE2-WEB2/api/films/:ID    
                                                                                                    
      Aclaración: Si se intenta borrar una película en la que cuya id no exista, el status code será "404 Not found".
      Si la solicitud sale bien, el status code sera "200 OK".

## Detalles a tener en cuenta

      - Cuando el campo que se detalla en section o sortby no existe, o cuando no se detalla un numero natural de página/limit, se seguirá mostrando el json sin hacer ningún cambio (solo con el order por defecto).
      - Cuando el valor de campo que se detalla en value no existe o cuando la página que se detalla no tiene una coleccion para mostrar, se mostrará un arreglo vacío.
      - Cuando el valor del order no es ni ASC o DESC, saldrá un error con el status code "400 Bad Request".
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
