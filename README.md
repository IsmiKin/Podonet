# Podonet
=======

Trabajo de Fin de Grado para la Escuela Técnica Superior de Ingeniería Informática (ETSII) de la Universidad Málaga (UMA).  Plataforma web para la gestión de la Unidad Podológica de Málaga.

### Instalacion

##### Pasos previos
* Instalar MySQL Server (5.~)
  ```bash
  $ sudo apt-get install mysql-server
  ```
  + Crear un esquema de Base de Datos llamado "podonet"

* Instalar nodejs y node package manager (actualmente viene incluido en nodejs)
  ```bash
  $ sudo apt-get install -y nodejs
  ```
* Instalar composer

 ```bash
  $ curl -sS https://getcomposer.org/installer | php
  $ mv composer.phar /usr/local/bin/composer
  ```
* Instalar bower
```bash
  $ npm install -g bower
```

##### Instalando
*  Clonar proyecto

    ```shell
    $ git clone https://github.com/IsmiKin/Podonet
    ```
*  Lanzar composer para obtener dependencias
```shell
    $ composer install
```

* Lanzar bower para obtener dependencias (CSS&JS) 
```shell
    $ bower install
```
* Configurar el fichero de parametros : app/config/parameters.yml.
   Sustituye los campos por los correspondientes de tu base de datos.
```yaml
parameters:
   database_driver: pdo_mysql
   database_host: 127.0.0.1
   database_port: null
   database_name: podonet
   database_user: usuariobd
   database_password: passworbd
   mailer_transport: smtp
   mailer_host: 127.0.0.1
   mailer_user: null
   mailer_password: null
   locale: es
   secret: ThisTokenIsNotSoSecretChangeIt
```
* Sincronizar entidades del proyecto con la base de datos
```shell
   $ php app/console doctrine:schema:update --force 
```

* Arranca el servidor
```shell
   $ php app/console server:start
```
Si tienes problemas en algun paso consulta este [hilo](https://github.com/javiereguiluz/Cupon/issues/94)

### Licencia
La licencia de este proyecto pertenece a la **Univeridad de Málaga**.

### Autores
- Javier Ismael Ors Nuñez [@ismikin](https://github.com/IsmiKin)
- Alberto Puche Velasco [@ostiauncaballo](https://github.com/ostiauncaballo)



