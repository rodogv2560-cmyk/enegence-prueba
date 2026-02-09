Prueba técnica ENEGENCE – Estados y Municipios de México (COPOMEX)

Este proyecto corresponde a la prueba técnica solicitada para ENEGENCE. La aplicación implementa el consumo de la API de COPOMEX para la obtención de los estados y municipios de México, así como su persistencia y consulta mediante una base de datos MySQL. 

La solución está desarrollada en PHP, utilizando PDO para el acceso a datos y Bootstrap para la interfaz gráfica, con un enfoque en claridad, separación de responsabilidades y buenas prácticas de desarrollo.

Funcionalidad principal

La aplicación consume la API pública de COPOMEX para obtener el listado de los 32 estados de México. Los estados pueden sincronizarse y almacenarse en una base de datos MySQL mediante un proceso idempotente, evitando duplicados.

Desde la vista principal se muestra el listado de estados con funcionalidades de búsqueda, paginación y ordenamiento. Al seleccionar un estado, se realiza una consulta dinámica a la API de COPOMEX para obtener y mostrar los municipios correspondientes a dicho estado.

La interfaz está pensada para que, al ingresar a la aplicación, el evaluador pueda visualizar directamente el listado de estados y navegar hacia los municipios sin pasos adicionales.

Tecnologías utilizadas

El backend está desarrollado en PHP 8 utilizando PDO para la conexión a MySQL.
La base de datos utilizada es MySQL.
La API externa consumida es COPOMEX.
La interfaz gráfica está construida con Bootstrap y DataTables.
El proyecto se encuentra desplegado en Railway.

Estructura del proyecto

El directorio public contiene los archivos accesibles desde el navegador, incluyendo las vistas principales de estados y municipios, así como el punto de entrada de la aplicación.

El directorio src contiene la lógica de negocio, incluyendo la conexión a la base de datos y el cliente para consumir la API de COPOMEX.

El archivo .env.example muestra las variables de entorno necesarias para la configuración del proyecto.

Configuración

Para ejecutar el proyecto de manera local es necesario contar con PHP 8 y MySQL. Se deben configurar las variables de entorno correspondientes a la base de datos y a la API de COPOMEX, tomando como referencia el archivo .env.example.

Las variables requeridas incluyen las credenciales de la base de datos y el token de acceso a la API de COPOMEX.

Demo

La aplicación se encuentra desplegada y disponible en el siguiente enlace:

https://enegence-prueba-production.up.railway.app/estados.php

Desde esta URL es posible visualizar el listado de estados y consultar los municipios por estado.

