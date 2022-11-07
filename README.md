TRABAJO PRACTICO ESPECIAL PARTE 2:

API

Endpoints Generados para la tabla Personaje:

--------------------------------------------------------------------------------------------------------------------

Devuelve todos los personajes(items) 

GET   api/personages    

--------------------------------------------------------------------------------------------------------------------
ORDENAMIENTO:

Devuelve todos los personajes(items) ordenados por un campo de alguna columna

GET   api/personages?sort=NOMBREDECOLUMNA

Los nombres de columnas a elegir son : id_personaje - nombre_p - apellido - clase - id_raza - nombre_r - faccion 

Devuelve todos los personajes(items) ordenados por nombre de los personajes, de forma ascendente

Algunos Ejemplos:
GET   api/personages?sort=nombre_p
GET   api/personages?sort=nombre_p&order=asc

Devuelve todos los personajes(items) ordenados por la clase de los personajes, de forma descendente

ejemplos:
GET   api/personages?sort=clase&order=desc

--------------------------------------------------------------------------------------------------------------------
PAGINACION:

Devuelve, de todos los personajes(items), una página con un determino tamaño que se le puede indicar y que por defecto es limit=4

GET   api/personages?pag=NUMERODEPAGINA

Devuelve, de todos los personajes(items), una página con un tamaño de pagina igual a 4 (lo toma por defecto)

ejemplos:
GET   api/personages?pag=2
GET   api/personages?pag=3

Devuelve, de todos los personajes(items), una página con un tamaño de pagina determino

ejemplos:
GET   api/personages?pag=1&limit=8
GET   api/personages?pag=3&limit=2

--------------------------------------------------------------------------------------------------------------------
FILTRADO:

Devuelve todos los personajes(items) filtrados por un valor de una columna dada

GET   api/personages?nombredecolumna=VALORAFILTRAR

Los nombres de columnas a elegir son : id_personaje - nombre_p - apellido - clase - id_raza - nombre_r - faccion 

Algunos Ejemplos:
GET   api/personages?id_personaje=2
GET   api/personages?clase=Guerrero
GET   api/personages?id_raza=2
GET   api/personages?faccion=Alianza

Aclaracion: no se puede filtrar por mas de un campo a la vez

--------------------------------------------------------------------------------------------------------------------

Se permite cualquier combinacion de paginación , ordenamiento y filtrado posible

Algunos Ejemplos son:

GET   api/personages?
GET   api/personages?
GET   api/personages?

No importa el orden de las condiciones de las que se pongan, dan el mismo resultado:

GET   api/personages?faccion=horda&sort=id_personaje&order=desc&pag=2&limit=2
GET   api/personages?order=desc&sort=id_personaje&pag=2&limit=2&faccion=horda

--------------------------------------------------------------------------------------------------------------------

Devuelve un personaje(item) determinado por un ID 

GET   api/personage/:ID

Algunos Ejemplos:

GET   api/personage/1
GET   api/personage/13
GET   api/personage/5

--------------------------------------------------------------------------------------------------------------------

Servicio para agregar un personaje(item) 

POST   api/personage

*los datos del personaje a agregar se enbian por el body del request, correspondiente a un json

Algunos Ejemplos:

POST   api/personage

        {
            "nombre_p": "Malfurion",
            "apellido": "Tempestira",
            "clase": "Druida",
            "id_raza": 6
        }

         {
            "nombre_p": "Sylvanas",
            "apellido": "Brisaveloz",
            "clase": "Arquera",
            "id_raza": 6
        }

--------------------------------------------------------------------------------------------------------------------

Servicio para borrar un personaje(item) 

POST   api/personage/:ID

Algunos Ejemplos:

DELETE   api/personage/1
DELETE   api/personage/13
DELETE   api/personage/5

--------------------------------------------------------------------------------------------------------------------

Endpoints Generados para la tabla Raza:

--------------------------------------------------------------------------------------------------------------------

Devuelve todos las razas(categorias) 

GET   api/races

--------------------------------------------------------------------------------------------------------------------
ORDENAMIENTO:

Devuelve todos las razas(categorias) ordenados por un campo de alguna columna

GET   api/races?sort=NOMBREDECOLUMNA

Los nombres de columnas a elegir son : id_raza - nombre - faccion

Devuelve todos las razas(categorias) ordenados por nombre de raza, de forma ascendente

Algunos Ejemplos:
GET   api/races?sort=nombre
GET   api/races?sort=nombre&order=asc

Devuelve todos las razas(categorias) ordenados por id de raza, de forma descendente

ejemplos:
GET   api/races?sort=id_raza&order=desc

--------------------------------------------------------------------------------------------------------------------
PAGINACION:

Devuelve, de todos las razas(categorias), una página con un determino tamaño que se le puede indicar y que por defecto es limit=4

GET   api/races?pag=NUMERODEPAGINA

Devuelve, de todos las razas(categorias), una página con un tamaño de pagina igual a 4 (lo toma por defecto)

ejemplos:
GET   api/races?pag=2
GET   api/races?pag=3

Devuelve, de todos las razas(categorias), una página con un tamaño de pagina determino

ejemplos:
GET   api/races?pag=1&limit=8
GET   api/races?pag=3&limit=2

--------------------------------------------------------------------------------------------------------------------
FILTRADO:

Devuelve todos las razas(categorias) filtrados por un valor de una columna dada

GET   api/races?nombredecolumna=VALORAFILTRAR

Los nombres de columnas a elegir son : id_raza - nombre - faccion

Algunos Ejemplos:
GET   api/races?id_raza=2
GET   api/races?nombre=Elfo
GET   api/races?faccion=Alianza

Aclaracion: no se puede filtrar por mas de un campo a la vez

--------------------------------------------------------------------------------------------------------------------

Se permite cualquier combinacion de paginación , ordenamiento y filtrado posible

Algunos Ejemplos son:

GET   api/races?
GET   api/races?
GET   api/races?

No importa el orden de las condiciones de las que se pongan, dan el mismo resultado:

GET   api/races?
GET   api/races?

--------------------------------------------------------------------------------------------------------------------

Devuelve una raza(categoria) determinado por un ID 

GET   api/race/:ID

Algunos Ejemplos:

GET   api/race/1
GET   api/race/3
GET   api/race/5

--------------------------------------------------------------------------------------------------------------------

Servicio para agregar un personaje(item) 

POST   api/race

*los datos de la raza a agregar se envian por el body del request, correspondiente a un json

Algunos Ejemplos:

POST   api/race

        {
            "nombre": "Centauros",
            "faccion": "Horda"
        }

         {
            "nombre_p": "Goglin",
            "faccion": "Alianza"
        }

--------------------------------------------------------------------------------------------------------------------

Servicio para borrar un personaje(item) 

POST   api/race/:ID

Algunos Ejemplos:

DELETE   api/race/1
DELETE   api/race/3
DELETE   api/race/5

--------------------------------------------------------------------------------------------------------------------

falta hacer:
    token,
    acomodar primera parte,
    llenar bbdd,
    importar bbdd,
    mejorar los errores 400 200 500